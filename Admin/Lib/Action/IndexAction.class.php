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

	class IndexAction extends IniAction{
		function _initialize(){
			parent::_initialize();
		}
		
		function index() {
			$ids = $this->Article->usertoart($this->uid);
			$count = count($ids);
			$page = new Page($count,10);
			$offset = $page -> firstRow;
			$length = $page -> listRows;
			$pageshow = $page->show();
			$ids = array_slice($ids, $offset, $length);
			if($ids){
				$artlist = $this->Article->content($ids,'id,author,tags,cateid,title,status,uptime');
			}else{
				$artlist = array();
			}
			$status = array('1'=>'Show','0'=>'Hidden');
			$this->assign('page',$pageshow);
			$this->assign('status',$status);
			$this->assign('artlist',$artlist);
			$this->assign('active','index');
			$this->assign('ative','index');
			$this->display();
		}
		
	}
