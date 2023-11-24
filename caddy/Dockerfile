# we get the binary from Fedora to avoid using DockerHub, due to limitation
# around IP
FROM fedora:latest AS caddy
RUN dnf install -y --setopt=install_weak_deps=False --best -y gettext-envsubst caddy && dnf clean all
COPY Caddyfile.tmpl /srv/Caddyfile.tmpl 
# TODO
ENV UPSTREAM tcp://php-fpm:port
RUN envsubst < /srv/Caddyfile.tmpl > /srv/Caddyfile

FROM scratch
EXPOSE 8080
COPY --from=caddy /usr/bin/caddy /bin/caddy
COPY --from=caddy /srv/Caddyfile /srv/Caddyfile
WORKDIR /srv
CMD ["/bin/caddy"]
