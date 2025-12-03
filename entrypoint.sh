#!/bin/bash
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true
exec apache2-foreground