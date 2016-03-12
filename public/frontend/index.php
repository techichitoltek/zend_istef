<?php
/**
 * Default entry point for the frontend
 *
 * @category public
 * @package public
 * @subpackage public_frontend
 * @copyright RCWEB
 */

// holds the name of the current module
define('CURRENT_MODULE', 'frontend');
/*$config = new Zend_Config_Ini(
	APPLICATION_PATH  . 'application/configs/application.ini', APPLICATION_ENV
);
$baseUrl = $config->baseHttp;
define('BASE_URL',$baseUrl);*/

require './../index.base.php';
