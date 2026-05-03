# ln_mes_taesung — 배포·개발 환경 설정

이 문서는 현재 기준(**도메인 `ts.dair.co.kr`**, **HTTPS 전용**, **nginx + Docker PHP-FPM**, **MariaDB**)으로 서버를 다시 맞출 때 참고합니다.

---

## 1. 구성 요약

| 구분 | 내용 |
|------|------|
| 공개 URL | `https://ts.dair.co.kr/` |
| TLS | Let’s Encrypt — `/etc/letsencrypt/live/ts.dair.co.kr/` |
| 웹 서버 | 호스트 **nginx** → PHP는 **Docker `php:5.6-fpm`** (`127.0.0.1:19090`) |
| 소스 반영 | Compose 볼륨 **`.:/lunar/ln_mes/ts/ln_mes_taesung:rw`** — 저장 즉시 반영 |
| DB | Docker **MariaDB** 컨테이너 `lunar-mariadb` (같은 Docker 네트워크에서 `lunar-mariadb:3306`) |
| DB 비밀 | **`config/db.secret.php`** 또는 **`.env.db`** (저장소에 올리지 않음) |

---

## 2. 사전 준비

### 2.1 MariaDB (별도 compose)

저장소 바깥 예시: `/lunar/docker-mariadb/docker-compose.yml`

- 컨테이너 이름: `lunar-mariadb`
- Docker 네트워크 이름: **`docker-mariadb_default`** (외부 네트워크로 dev compose에서 참조)
- 호스트에서 DB 클라이언트 접속 시 포트 예: **13306** → 컨테이너 3306

```bash
cd /lunar/docker-mariadb && docker compose up -d
```

### 2.2 DNS

- `ts.dair.co.kr` **A 레코드** → 서버 공인 IP

---

## 3. 이 저장소 클론 후 (앱 디렉터리)

```bash
cd /path/to/ln_mes_taesung
```

**중요:** nginx `root`·Docker 마운트 경로가 **같은 절대 경로**여야 `SCRIPT_FILENAME`이 맞습니다.  
다른 경로에 두면 `docker-compose.dev.yml`의 `volumes` 타깃과 `deploy/nginx/ts-dair.conf`의 `root`를 **동일하게** 수정하세요.

---

## 4. DB 자격증명

### 방법 A — Docker 개발용 (권장)

```bash
cp .env.db.example .env.db
# 편집: MES_DB_HOST, MES_DB_NAME, MES_DB_USER, MES_DB_PASSWORD
```

`.env.db`는 `.gitignore`에 있어 **커밋하지 않습니다.**

### 방법 B — `config/db.secret.php`

```bash
cp config/db.secret.example.php config/db.secret.php
# 배열 값 수정
```

역시 `.gitignore` 처리됨.

`connection.php` / `connection2.php` → `config/connection.inc.php` → `config/bootstrap_db.php` 순으로 로드합니다.

---

## 5. PHP-FPM 컨테이너 (개발·본 서버 공통으로 사용 중인 패턴)

```bash
docker compose -f docker-compose.dev.yml up --build -d
```

- 이미지: `docker/Dockerfile.dev` (`php:5.6-fpm` + `mysql` 확장)
- 포트: **`127.0.0.1:19090:9000`** (호스트 nginx만 붙도록 로컬호스트 바인딩)
- 네트워크: `docker-mariadb_default` 에 조인 → `MES_DB_HOST=lunar-mariadb:3306` (`.env.db.example` 참고)

---

## 6. nginx (호스트)

### 6.1 설정 파일

- 저장소 내: **`deploy/nginx/ts-dair.conf`**
- 활성화 예:

```bash
sudo ln -sf /path/to/ln_mes_taesung/deploy/nginx/ts-dair.conf /etc/nginx/sites-enabled/ts-dair.conf
sudo nginx -t && sudo systemctl reload nginx
```

### 6.2 동작

- **80**: `/.well-known/acme-challenge/` 만 파일 서빙, 나머지 **308 → HTTPS**
- **443**: Let’s Encrypt + PHP는 **FastCGI** → `127.0.0.1:19090`
- **`/config/`** HTTP 직접 접근 **차단** (비밀 설정 보호)

### 6.3 TLS 발급·갱신

```bash
# 최초 또는 도메인 추가 시 (웹루트는 프로젝트 루트)
sudo certbot certonly --webroot -w /path/to/ln_mes_taesung -d ts.dair.co.kr \
  --agree-tos -m your@email.com

# 스크립트
sudo ./deploy/issue-certbot.sh
sudo ./deploy/renew-ts-ssl.sh
```

인증서 경로가 바뀌면 `ts-dair.conf`의 `ssl_certificate` / `ssl_certificate_key`를 맞춘 뒤 `nginx -t` 후 reload 합니다.

---

## 7. 방화벽 (UFW 예시)

MariaDB를 호스트 포트로 열어둔 경우에만 해당:

```bash
sudo ufw allow 13306/tcp comment 'MariaDB'
```

---

## 8. 접속 확인

```bash
curl -sI http://ts.dair.co.kr/    # 308 Location: https://...
curl -sI https://ts.dair.co.kr/login.php
```

브라우저: `https://ts.dair.co.kr/`

---

## 9. 알려진 제한

- **nginx는 Apache `.htaccess`를 읽지 않습니다.** 확장자 없는 URL 등이 필요하면 `ts-dair.conf`에 `rewrite` 규칙을 추가해야 합니다.
- PHP **5.6** + 레거시 **`mysql_*`** API 전제입니다.

---

## 10. 관련 경로 빠른 참조

| 경로 | 설명 |
|------|------|
| `deploy/nginx/ts-dair.conf` | 가상호스트 (ts.dair.co.kr) |
| `docker-compose.dev.yml` | PHP-FPM 개발 컨테이너 |
| `docker/Dockerfile.dev` | FPM 이미지 빌드 |
| `config/bootstrap_db.php` | DB 상수 로드 |
| `deploy/issue-certbot.sh` / `deploy/renew-ts-ssl.sh` | 인증서 스크립트 |
| `backups/_mysql_full_dump.php` | DB 덤프 (bootstrap 사용) |

---

## 11. 이전 도메인 (`tsmes.dair.co.kr`)

더 이상 이 앱용으로 사용하지 않습니다. 인증·nginx 매핑은 **`ts.dair.co.kr`** 기준으로 통일했습니다.
