<?php
/**
*   +----------------------------------------------------------------------
*   | Author: ONLY <491518132@qq.com>
*	+----------------------------------------------------------------------
*   | Creater Time : 2013-6-16
*   +----------------------------------------------------------------------
*   | Link ( http://www.phpyrb.com  http://www.cloudsskill.com )
*   +----------------------------------------------------------------------
**/

	define('APP_NAME', 'Admin');
	define('APP_PATH', 'Admin/');
	define('APP_DEBUG', true);
	define('ROOT_PATH',dirname(__FILE__).'/');
	define('RUNTIME_PATH', ROOT_PATH.APP_NAME.'/Cache/');
	
	require ROOT_PATH.'ThinkPHP/ThinkPHP.php';