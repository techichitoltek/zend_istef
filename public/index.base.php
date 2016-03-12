<?php
/**
* Default index.php file
* All other {module}/index.php files should include this one
 *
 * @category public
 * @package public
 * @copyright RCWEB
 */

//error_reporting(E_ALL ^E_STRICT);

$timePerfBegin = microtime(true);

// define the application path constant
define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));
define('ROOT_PATH', realpath(dirname(__FILE__) . '/..'));
define('TMP_PATH', realpath(ROOT_PATH . '/tmp'));

$paths = array(
    realpath(dirname(__FILE__) . '/../library'),
    realpath(dirname(__FILE__) . '/../libraryIncubator'),
    get_include_path(),
);

set_include_path(implode(PATH_SEPARATOR, $paths));

require APPLICATION_PATH . '/Bootstrap.php';

$bootstrap = new Bootstrap();

Zend_Registry::set('Bootstrap', $bootstrap);
Zend_Registry::set('timePerfBegin', $timePerfBegin);

$bootstrap->runApp();

