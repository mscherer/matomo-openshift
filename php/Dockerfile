FROM registry.fedoraproject.org/fedora:latest
LABEL org.opencontainers.image.source="https://github.com/mscherer/matomo-openshift"
ENV MATOMO_VERSION 4.15.1
RUN dnf install -y --setopt=install_weak_deps=False --best -y php-cli php-fpm php-mysqlnd  php-xml php-gd && dnf clean all
WORKDIR /srv
RUN cd /tmp/ && curl -L https://github.com/matomo-org/matomo/releases/download/$MATOMO_VERSION/matomo-$MATOMO_VERSION.tar.gz > matomo.tar.gz && tar -xf matomo.tar.gz && mv matomo /srv && rm -Rf /tmp/matomo.tar.gz
EXPOSE 9000
COPY php-fpm.conf /etc/php-fpm.conf
RUN mv /srv/matomo/config /srv/matomo/config_upstream
#COPY config.ini.php /src/matomo/config/config.ini.php
#COPY UnattendedInstallation /srv/matomo/plugins/UnattendedInstallation 
COPY init.sh /usr/local/bin/init.sh
CMD ["/usr/bin/bash", "/usr/local/bin/init.sh"]
