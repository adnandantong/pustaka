FROM php:8.1-apache

# Copy semua file ke dalam container
COPY . /var/www/html/

# Aktifkan mod_rewrite (opsional, jika dibutuhkan)
RUN a2enmod rewrite

# Ubah permission (opsional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80
