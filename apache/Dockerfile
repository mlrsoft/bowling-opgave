FROM httpd:2.4.33-alpine

RUN apk update; \
    apk upgrade;

# Copy apache vhost file to proxy php requests to php-fpm container
COPY bowling.apache.conf /usr/local/apache2/conf/bowling.apache.conf
RUN echo "Include /usr/local/apache2/conf/bowling.apache.conf" \
    >> /usr/local/apache2/conf/httpd.conf
