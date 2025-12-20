#!/usr/bin/env bash
set -e

rm -f /var/www/html/public/storage
php /var/www/html/artisan storage:link

echo "Waiting for database to be ready..."

max_attempts=30
attempt=0

while ! mysqladmin ping -h mysql -u "${DB_USERNAME}" -p"${DB_PASSWORD}" --silent; do
    attempt=$((attempt + 1))
    if [ $attempt -ge $max_attempts ]; then
        echo "Database is not available after $max_attempts attempts"
        exit 1
    fi

    echo "Database not ready. Attempt $attempt/$max_attempts. Waiting..."

    sleep 2
done

echo "Database is ready. Running migrations..."
php /var/www/html/artisan migrate --force
