FROM dunglas/frankenphp:php8.4-alpine

ARG UID=1000
ARG GID=1000

WORKDIR /app

# ============================================================
# PHP extensions
# ============================================================

RUN install-php-extensions \
    pcntl \
    zip \
    bcmath \
    intl \
    pdo_mysql \
    redis \
    gd \
    opcache

# ============================================================
# System dependencies
# ============================================================

RUN apk add --no-cache \
    git \
    netcat-openbsd \
    curl \
    unzip \
    bash \
    su-exec

# ============================================================
# Bun
# ============================================================

RUN curl -fsSL https://bun.sh/install | bash \
    && cp -r /root/.bun /opt/bun \
    && chown -R www-data:www-data /opt/bun

ENV PATH="/opt/bun/bin:$PATH"

# ============================================================
# Composer
# ============================================================

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ============================================================
# Create www-data with requested UID/GID
# ============================================================

RUN existing_uid=$(getent passwd ${UID} | cut -d: -f1 || true) \
    && existing_gid=$(getent group ${GID} | cut -d: -f1 || true) \
    && if [ -n "$existing_uid" ] && [ "$existing_uid" != "www-data" ]; then \
         deluser "$existing_uid"; \
       fi \
    && if [ -n "$existing_gid" ] && [ "$existing_gid" != "www-data" ]; then \
         delgroup "$existing_gid"; \
       fi \
    && sed -i "s/^www-data:x:[0-9]*:[0-9]*/www-data:x:${UID}:${GID}/" /etc/passwd \
    && sed -i "s/^www-data:x:[0-9]*/www-data:x:${GID}/" /etc/group

# ============================================================
# Pre-install node dependencies
#
# This creates node_modules inside the image with Alpine/musl
# native bindings. The named Docker volume can then be initialized
# from this directory.
# ============================================================

COPY package.json bun.lock ./

RUN bun install --frozen-lockfile \
    && chown -R www-data:www-data /app/node_modules

# ============================================================
# Application directories
# ============================================================

RUN mkdir -p \
    /app/storage \
    /app/bootstrap/cache \
    /app/vendor \
    && chown -R www-data:www-data \
        /app/storage \
        /app/bootstrap/cache \
        /app/vendor \
    && chmod -R 775 \
        /app/storage \
        /app/bootstrap/cache

# ============================================================
# Entrypoint
# ============================================================

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh

# ============================================================
# Octane
# ============================================================

ENV OCTANE_SERVER=frankenphp
ENV WATCH_MODE=true

# Entrypoint needs root because it must fix ownership of
# Docker named volumes before dropping privileges to www-data.
USER root

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

CMD ["--watch", "--workers=1"]
