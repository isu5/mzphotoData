<?php
/*
 * APP数据处理类
 * 作  者：永乐开发
 * 日  期：2017.7.31
 * 邮  箱：web@isu5.cn
 * 博  客：http://www.isu5.cn
 */
namespace Org\Nx;

class Response{
	


	/**
	* 综合方法 默认json方法调用
	* @param integer $code 状态码
	* @param string $msg 提示信息
	* @param string $data 数据
	* return string
	*
	*/
	public static function show($code,$msg,$data=[],$type=''){
		if (!is_numeric($code)) {
			return '';
		}

		$type = $_GET['format'] ? $_GET['format'] : '';
		
		$result = array(
			'code' => $code,
			'msg' => $msg,
			'data' => $data
			);

		if ($type=='json') {
			//json形式
			self::returnJson($code,$msg,$data);
			exit;
		}elseif ($type=='array') {
			//数组形式
			var_dump($return);
		}elseif ($type=='xml') {
			self::xmlEncode($code,$msg,$data);
			exit;
		}else{
			//TODO
		}
	}
	
	public function getPram(){
		
	}
	
	/**
	* 按json数据传输
	* @param integer $code 状态码
	* @param string $msg 提示信息
	* @param string $data 数据
	* return string
	*
	*/
	public static function returnJson($code,$msg,$data=[],$type='json'){
		if (!is_numeric($code)) {
			return '';
		}
		$result = array(
			'code' => $code,
			'msg' => $msg,
			'data' => $data
			);
		echo json_encode($result);
		exit;
	}
	
	/**
	* 按xml数据传输
	* @param integer $code 状态码
	* @param string $msg 提示信息
	* @param string $data 数据
	* return string
	*
	*/
	
	public static function xmlEncode($code,$msg,$data=[]){
		if (!is_numeric($code)) {
			return '';
		}
		$result = array(
			'code' => $code,
			'msg' => $msg,
			'data' => $data
			);
		header("Content-Type:text/xml");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .="<root>"; //根节点

		$xml .=self::xmlToEncode($result);

		$xml .="</root>";

		echo $xml;

	}

	public static function xmlToEncode($data){
		$xml = $attr = "";
		foreach ($data as $key => $value) {
			# code...
			//如果key值为数字
			if (is_numeric($key)) {
				$attr = " id='{$key}'";
				$key = "item";
			}


			$xml .="<{$key}{$attr}>";
			//递归直到字符串为止
			$xml .= is_array($value)?self::xmlToEncode($value):$value;

			$xml .="</{$key}>";

		}
		return $xml;
	}

	
}