FROM fedora:latest
LABEL org.opencontainers.image.source="https://github.com/mscherer/matomo-openshift"
ENV MATOMO_VERSION 4.15.1
# git-lfs is needed, per 
RUN dnf install -y --setopt=install_weak_deps=False --best -y php-fpm php-mysqlnd git git-lfs && dnf clean all
WORKDIR /srv
RUN git clone --depth 1 https://github.com/matomo-org/matomo.git 
EXPOSE 8080
COPY init.sh /usr/local/bin/init.sh
CMD ["/usr/bin/bash", "/usr/local/bin/init.sh"]

