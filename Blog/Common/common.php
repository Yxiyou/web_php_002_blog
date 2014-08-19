<?php
/**
*  +----------------------------------------------------------------------------------------------+
*   | Author: ONLY <491518132@qq.com>
*	+----------------------------------------------------------------------------------------------+
*   | Creater Time : 2013-6-8 	
*  +----------------------------------------------------------------------------------------------+
*    Link :		http://www.phpyrb.com
*					http://www.cloudsskill.com 
*					http://www.goshopx.com  
*					http://www.shopingj.com 	     
*  +----------------------------------------------------------------------------------------------+
**/

//*************************************************************/
/**
 * 转换字节数为其他单位
*/
function sizecount($filesize) {
	if ($filesize >= 1073741824) {
		$filesize = round($filesize / 1073741824 * 100) / 100 .' GB';
	} elseif ($filesize >= 1048576) {
		$filesize = round($filesize / 1048576 * 100) / 100 .' MB';
	} elseif($filesize >= 1024) {
		$filesize = round($filesize / 1024 * 100) / 100 . ' KB';
	} else {
		$filesize = $filesize.' Bytes';
	}
	return $filesize;
}
//删除目录函数
function deldir($dirname){
	if(file_exists($dirname)){
		$dir = opendir($dirname);
		while($filename = readdir($dir)){
		 if($filename != "." && $filename != ".."){
		 	$file = $dirname."/".$filename;
		 	if(is_dir($file)){
		 		deldir($file); //使用递归删除子目录
		 	}else{
			  @unlink($file);
		 	}
		 }
		}
		closedir($dir);
		rmdir($dirname);
	}
}
//判断文件夹是否为空，空则返回真
function empty_dir($directory){

	$handle = opendir($directory);
	while (($file = readdir($handle)) !== false){

		if ($file != "." && $file != ".."){

			closedir($handle);
			return false;
		}
	}
	closedir($handle);
	return true;
}


//返回目录的大小
function dirSize($directory) {
	$dir_size=0;

	if($dir_handle=@opendir($directory)) {
		while($filename=readdir($dir_handle)) {
			if($filename!="." && $filename!="..") {
				$subFile=$directory."/".$filename;
				if(is_dir($subFile))
					$dir_size+=dirSize($subFile);
				if(is_file($subFile))
					$dir_size+=filesize($subFile);
			}
		}
		closedir($dir_handle);
		return $dir_size;
	}
}
//返回彩色的字符
function color_txt($str){

	if(function_exists('iconv_strlen')) {
		$len  = iconv_strlen($str);
	}else if(function_exists('mb_strlen')) {
		$len = mb_strlen($str);
	}
	$colorTxt = '';
	for($i=0; $i<$len; $i++) {
		$colorTxt .=  '<span style="color:'.rand_color().'">'.msubstr($str,$i,1,'utf-8','').'</span>';
	}

	return $colorTxt;
}
//随机获取颜色
function rcolor() {
	$rand = rand(0,255);
	return sprintf("%02X","$rand");
}
function rand_color(){

	return '#'.rcolor().rcolor().rcolor();
}
function getTitleSize($count){

	$size = (ceil($count/10)+11).'px';
	return $size;
}

//截取字符串
function msubstr($str, $start=0, $length, $charset="utf-8", $suffix=true){
	if(function_exists("mb_substr")) {
		if($suffix) {
			 
			if($str==mb_substr($str, $start, $length, $charset)) {

				return mb_substr($str, $start, $length, $charset);
			}
			else {

				return mb_substr($str, $start, $length, $charset)."...";
			}
		}
		else  {

			return mb_substr($str, $start, $length, $charset);
		}
	}
	elseif(function_exists('iconv_substr')) {
		if($suffix) {
			 
			if($str==iconv_substr($str,$start,$length,$charset))  {

				return iconv_substr($str,$start,$length,$charset);
			}
			else {

				return iconv_substr($str,$start,$length,$charset)."...";
			}
		}
		else {

			return iconv_substr($str,$start,$length,$charset);
		}
	}
	$re['utf-8']   = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|[\xe0-\xef][\x80-\xbf]{2}|[\xf0-\xff][\x80-\xbf]{3}/";
	$re['gb2312'] = "/[\x01-\x7f]|[\xb0-\xf7][\xa0-\xfe]/";
	$re['gbk']    = "/[\x01-\x7f]|[\x81-\xfe][\x40-\xfe]/";
	$re['big5']   = "/[\x01-\x7f]|[\x81-\xfe]([\x40-\x7e]|\xa1-\xfe])/";
	preg_match_all($re[$charset], $str, $match);
	$slice = join("",array_slice($match[0], $start, $length));
	if($suffix) return $slice."…";
	return $slice;
}
function is_badword($string) {
	$badwords = array("\\",'&',' ',"'",'"','/','*',',','<','>',"\r","\t","\n","#");
	foreach($badwords as $value){
		if(strpos($string, $value) !== FALSE) {
			return TRUE;
		}
	}
	return FALSE;
}


