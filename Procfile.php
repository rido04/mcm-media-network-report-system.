web: php -S 0.0.0.0:${PORT} -t public
web: php artisan serve --host=0.0.0.0 --port=${PORT}
php artisan migrate --force && php artisan key:generate && php artisan storage:link && php artisan serve --host=0.0.0.0 --port=${PORT}
