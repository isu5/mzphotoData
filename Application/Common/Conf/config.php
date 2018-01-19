<?php
return array(
	//'配置项'=>'配置值'
	
	'DB_TYPE'   => 'mysql', // 数据库类型
	'DB_HOST'   => '127.0.0.1', // 服务器地址
	'DB_NAME'   => 'jeecms', // 数据库名
	'DB_USER'   => 'root', // 用户名
	'DB_PWD'    => 'root', // 密码
	'DB_PORT'   => 3306, // 端口
	'DB_PREFIX' => 'jc_', // 数据库表前缀
	'DB_CHARSET'=>  'utf8',      // 数据库编码默认采用utf8
	
	'TMPL_PARSE_STRING'   		=> 		array(   					// 定义常用路径
		//huicss
		'__LAY__'      	=> 	__ROOT__. '/Public/layui',
	
	),
	
	
);