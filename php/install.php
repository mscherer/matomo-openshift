<?php
# adapted from https://github.com/mscherer/ansible-role-matomo/blob/main/files/deploy_piwik.php
# written by the same author as this file

define('PIWIK_INCLUDE_PATH', '/srv/matomo');
define('PIWIK_USER_PATH',    '/srv/matomo');

include('core/Loader.php');
include('libs/upgradephp/upgrade.php');

include("plugins/Installation/Controller.php");

use Piwik\DbHelper;
use Piwik\Db\Adapter;
use Piwik\Db;
use Piwik\Plugin\ControllerAdmin;
use Piwik\Plugins\Installation;
use Piwik\Config;
use Piwik\Common;
use Piwik\Access;

$dbInfos = array(
    'host'          => getenv('DB_HOST'),
    'username'      => getenv('DB_USER'),
    'password'      => getenv('DB_PASS'),
    'dbname'        => getenv('DB_NAME'),
    'tables_prefix' => '',
    'adapter'       => 'PDO\MYSQL',
    'port'          => getenv('DB_PORT'),
    'schema'        => 'Mysql',
    'type'          => 'InnoDB',
);

# TODO is it needed ?
$c = new Piwik\Plugins\Installation\Controller();

Db::createDatabaseObject($dbInfos);
DbHelper::createTables();
DbHelper::createAnonymousUser();

// TODO make a function
$config = Config::getInstance();
$config->General['salt'] = Common::generateUniqId();
$config->database = $dbInfos;
$config->forceSave();

use Piwik\Plugins\UsersManager\API as APIUsersManager;
use Piwik\Piwik;

Access::doAsSuperUser(function () {
	// TODO do not hardcode
	$login = 'root';

	// TODO should be a console command
	$api = APIUsersManager::getInstance();
	$api->addUser($login, 'rootpw','root@localhost.com');
	$api->setSuperUserAccess($login, true);

});
