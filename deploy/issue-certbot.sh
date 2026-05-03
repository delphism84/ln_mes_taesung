#!/usr/bin/env bash
# ts.dair.co.kr Let's Encrypt (webroot). 추가 SAN: "$@" 로 -d 도메인 전달
set -euo pipefail
ROOT="${TSMES_ROOT:-/lunar/ln_mes/ts/ln_mes_taesung}"
EMAIL="${TSMES_SSL_EMAIL:-admin@dair.co.kr}"
mkdir -p "$ROOT/.well-known/acme-challenge"

if [[ $# -gt 0 ]]; then
  exec certbot certonly --webroot -w "$ROOT" -d ts.dair.co.kr "$@" \
    --non-interactive --agree-tos -m "$EMAIL"
else
  exec certbot certonly --webroot -w "$ROOT" -d ts.dair.co.kr \
    --non-interactive --agree-tos -m "$EMAIL"
fi
