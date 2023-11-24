#!/bin/bash
cd /srv/matomo/
# TODO do the init if not present
php /usr/local/bin/install.php

php-fpm -F
