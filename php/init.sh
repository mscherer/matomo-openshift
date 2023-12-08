#!/bin/bash
set -x
cd /srv/matomo/

if [ ! -f config/global.php ]; then cp config_upstream/global.php config/global.php; fi;

if [ -v MATOMO_AUTOINST ]; then
	if [ ! -f /srv/matomo/config/config.ini.php ]; then
		cp /srv/matomo/config/global.ini.php /srv/matomo/config/config.ini.php
		sed -i -e "s/\[PluginsInstalled\]/\nPlugins\[\] = UnattendedInstall\n\[PluginsInstalled\]\nPluginsInstalled\[\] = UnattendedInstallation\n/" /srv/matomo/config/config.ini.php

		#cat >> /srv/matomo/config/config.ini.php <<EOF
		#[Plugins]
		#Plugins[] = UnattendedInstall
		#[PluginsInstalled]
		#PluginsInstalled[] = UnattendedInstallation
		#EOF

		php ./console plugin:list
		#php ./console plugin:activate UnattendedInstallation
		php ./console plugin:list
		php ./console
	fi;
fi;
php-fpm -F -R
