FROM php:8.1-cli

WORKDIR /var/www/html

COPY ./game /var/www/html

EXPOSE 10000

CMD ["php", "-S", "0.0.0.0:10000"]
