#!/usr/bin/env bash
set -e

rm -f /var/www/html/public/storage
php /var/www/html/artisan storage:link
