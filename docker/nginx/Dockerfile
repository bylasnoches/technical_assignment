FROM nginx:1.23

RUN mkdir -p /var/www/public

RUN apt-get update && apt-get install -y \
    vim \
    wget

RUN apt-get clean \
    && rm -rf /tmp/* /var/tmp/* /var/lib/apt/lists/*

RUN rm -f /etc/nginx/nginx.conf /etc/nginx/sites-enabled/* /etc/nginx/conf.d/*
COPY nginx.conf /etc/nginx/
COPY app.conf /etc/nginx/sites-enabled/
COPY general.conf /etc/nginx/conf.d/

WORKDIR /var/www/public

ADD entrypoint.sh /usr/local/bin/

CMD ["entrypoint.sh"]
