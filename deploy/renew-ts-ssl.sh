#!/usr/bin/env bash
# ts.dair.co.kr 인증서 강제 갱신 후 nginx reload
set -euo pipefail
ROOT="${TSMES_ROOT:-/lunar/ln_mes/ts/ln_mes_taesung}"
EMAIL="${TSMES_SSL_EMAIL:-admin@dair.co.kr}"
mkdir -p "$ROOT/.well-known/acme-challenge"

certbot certonly --webroot -w "$ROOT" -d ts.dair.co.kr \
  --force-renewal --non-interactive --agree-tos -m "$EMAIL"

nginx -t
systemctl reload nginx
echo "OK: curl -sI https://ts.dair.co.kr/"
