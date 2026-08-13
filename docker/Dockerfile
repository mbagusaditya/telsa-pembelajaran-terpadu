FROM dunglas/frankenphp:php8.4-alpine

ARG UID=1000
ARG GID=1000

WORKDIR /app

# Install PHP extensions
RUN install-php-extensions \
    pcntl \
    zip \
    bcmath \
    intl \
    # imagick \
    pdo_mysql \
    redis \
    gd \
    opcache

# Install bun, git, and netcat (for wait-for-db)
RUN apk add --no-cache git netcat-openbsd curl unzip bash

RUN curl -fsSL https://bun.sh/install | bash

ENV PATH="/root/.bun/bin:$PATH"

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Pre-install Node deps so the node_modules volume gets Alpine/musl native bindings
COPY package.json bun.lock ./

RUN bun install --frozen-lockfile

# set id for www-data
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

# Set entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Ensure storage and bootstrap/cache exist and have correct permissions
RUN mkdir -p storage bootstrap/cache && \
    chown -R www-data:www-data /app && \
    chmod -R 775 storage bootstrap/cache

# Set default environment variables for Octane
ENV OCTANE_SERVER=frankenphp
ENV WATCH_MODE=true

# Use root to allow entrypoint to fix permissions on mounted volumes
USER root

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]

# Default command for development
CMD ["--watch", "--workers=1"]
