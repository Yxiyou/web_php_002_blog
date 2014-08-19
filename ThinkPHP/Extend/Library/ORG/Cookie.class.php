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

class Cookie {
    // 判断Cookie是否存在
    static function is_set($name) {
        return isset($_COOKIE[$name]);
    }

    // 获取某个Cookie值
    static function get($name) {
        $value   = $_COOKIE[$name];
        $value   =  unserialize(base64_decode($value));
        return $value;
    }

    // 设置某个Cookie值
    static function set($name,$value,$expire='',$path='',$domain='') {
        if($expire=='') {
            $expire =   C('COOKIE_EXPIRE');
        }
        if(empty($path)) {
            $path = C('COOKIE_PATH');
        }
        if(empty($domain)) {
            $domain =   C('COOKIE_DOMAIN');
        }
        $expire =   !empty($expire) ? time()+$expire   :  0;
        $value   =  base64_encode(serialize($value));
        setcookie($name, $value,$expire,$path,$domain);
        $_COOKIE[$name]  =   $value;
    }

    // 删除某个Cookie值
    static function delete($name) {
        Cookie::set($name,'',-3600);
        unset($_COOKIE[$name]);
    }

    // 清空Cookie值
    static function clear() {
        unset($_COOKIE);
    }
}