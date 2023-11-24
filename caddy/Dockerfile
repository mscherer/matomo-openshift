# we use Fedora rather than the dockerhub binary, due to due to limitation
# around IP
FROM fedora:latest AS caddy
RUN dnf install -y --setopt=install_weak_deps=False --best -y gettext-envsubst caddy && dnf clean all
COPY Caddyfile.tmpl /srv/Caddyfile.tmpl 
# TODO
ENV UPSTREAM tcp://php-fpm:port
RUN envsubst < /srv/Caddyfile.tmpl > /srv/Caddyfile

EXPOSE 8080
WORKDIR /srv
CMD ["/usr/bin/caddy", "run"]
