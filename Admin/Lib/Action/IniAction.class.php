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

	class IniAction extends Action {
		protected $Article , $Categroys , $Comment , $User, $uid;
        function _initialize () {
            $this->uid = $_SESSION['uid'];
            if(! $this->uid){
                $this->redirect('Login/index');
            }
            // 			import('ORG.Cookie');
            // 			import('ORG.Image');
            import('ORG.Page');
            import('Com.Article');

            $this->Article = new Article();
            //			$this->image = new Image();
        }
    }
