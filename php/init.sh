#!/bin/bash
cd /srv/matomo/
# TODO do the init if not present
php ./install.php

php-fpm
