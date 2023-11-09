FROM fedora:latest
LABEL org.opencontainers.image.source="https://github.com/mscherer/matomo-openshift"
ENV MATOMO_VERSION 4.15.1
# git-lfs is needed, per 
RUN dnf install -y --setopt=install_weak_deps=False --best -y php-fpm php-mysqlnd  && dnf clean all
WORKDIR /srv
RUN cd /tmp/ && curl -L https://github.com/matomo-org/matomo/releases/download/$MATOMO_VERSION/matomo-$MATOMO_VERSION.tar.gz > matomo.tar.gz && tar -xf matomo.tar.gz && mv matomo /srv && rm -Rf /tmp/matomo.tar.gz
EXPOSE 8080
COPY init.sh /usr/local/bin/init.sh
CMD ["/usr/bin/bash", "/usr/local/bin/init.sh"]

