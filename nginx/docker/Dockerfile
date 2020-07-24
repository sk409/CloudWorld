FROM nginx:1.19

COPY conf.d/default.conf /etc/nginx/conf.d/default.conf

RUN apt-get clean && apt-get update && apt-get install -y spawn-fcgi fcgiwrap git

RUN sed -i 's/www-data/nginx/g' /etc/init.d/fcgiwrap
RUN chown nginx:nginx /etc/init.d/fcgiwrap

CMD /etc/init.d/fcgiwrap start \
    && nginx -g 'daemon off;'