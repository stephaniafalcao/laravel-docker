FROM webdevops/php-nginx-dev:8.0

ENV WEB_DOCUMENT_ROOT /app/public

COPY ./entrypoint.sh /opt/docker/provision/entrypoint.d/99-userscript.sh

