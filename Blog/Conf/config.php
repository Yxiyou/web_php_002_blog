<?php
	require 'conf.php';
	$config = array(
		//'配置项'=>'配置值'
			'DEFAULT_THEME'		=> 'Default',
			'DEFAULT_CHARSET' => 'utf-8',
// 			'APP_GROUP_LIST' => 'Home,User', //项目分组设定
// 			'DEFAULT_GROUP'  => 'Home', //默认分组
			'TMPL_FILE_DEPR' => '_',
			'URL_ROUTER_ON' => false,
			'DEFAULT_MODULE'     => 'Index', //默认模块
 			'URL_MODEL'          => '2', //URL模式
            'URL_PATHINFO_DEPR' => '-',
 			'COOKIE_PREFIX'   =>'6000',
 			'COOKIE_NAME'   =>'onblog',
// 			'SESSION_AUTO_START' => true, //是否开启session
// 			'TMPL_ACTION_ERROR' => APP_PATH.'/Tpl/Home/Default/Public/success.html',
// 			'TMPL_ACTION_SUCCESS' =>  APP_PATH.'/Tpl/Home/Default/Public/success.html',
			'LOG_EXCEPTION_RECORD'  => false,    // 是否记录异常信息日志
			'SHOW_PAGE_TRACE'        =>true,   // 显示页面Trace信息
			//'USER_AUTH_TYPE'			=>1,		// 默认认证类型 1 登录认证 2 实时认证
			'AUTH_PWD_ENCODER'          =>'SHA1',	// 用户认证密码加密方式
			'GUEST_AUTH_ON'             =>false,    // 是否开启游客授权访问
// 			'USER_AUTH_GATEWAY'         =>'/Public/login',// 默认认证网关
// 			'NOT_AUTH_MODULE'           =>'Public',	// 默认无需认证模块
// 			'REQUIRE_AUTH_MODULE'       =>'',		// 默认需要认证模块
// 			'NOT_AUTH_ACTION'           =>'',		// 默认无需认证操作
// 			'REQUIRE_AUTH_ACTION'       =>'',		// 默认需要认证操作
			'SHOW_ERROR_MSG'        => true,    // 显示错误信息
			'AUTHKEY'                  => 'ONLY',  //加密后缀
			'SHOW_PAGE_TRACE' =>false,
 	);
	
	$conf = array_merge($DB,$config);
	return $conf;
?>
