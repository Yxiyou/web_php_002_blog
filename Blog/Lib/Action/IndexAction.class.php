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

	class IndexAction extends IniAction {
		function _initialize(){
			parent::_initialize();
			$info['kword'] = "PHP,Pythoy,Ruby,Js,Jquery,HTML5,Css,Ajax,python学习,个人主页,博客,网站建设,PHP建站";
			$info['description'] = "pythob学习,深圳PHP博客,马伟个人博客,python博客";
			$info['title'] = "python学习,马伟博客,python博客,php博客 ";
			$this->assign('info',$info);
		}
		
		function index(){
			$cateid = $_REQUEST['cateid'];
			$indexart = array();
			if($cateid){
				$ids = $this->Article->catetoart($cateid, $this->uid);
				$count = count($ids);
				$page = new Page($count,10);
				$offset = $page -> firstRow;
				$length = $page -> listRows;
				$pageshow = $page->show();
				$ids = array_slice($ids, $offset, $length);
				if($ids){
					$indexart = $this->Article->content($ids);
				}else{
					$indexart = array();
				}
			}else{
				$indexart = $this->Article->new10($this->uid);
			}
			$this->assign('page',$pageshow);
			$this->assign('indexart',$indexart);
			$this->display();
		}
		
		function search () {
			$keyword = $_REQUEST['keyword'];
			$ids = $this->Article->search($keyword);
			$count = count($ids);
			$page = new Page($count,10);
			$offset = $page -> firstRow;
			$length = $page -> listRows;
			$pageshow = $page->show();
			$ids = array_slice($ids, $offset, $length);
			$indexart = $this->Article->content($ids);
			$this->assign('page',$pageshow);
			$this->assign('indexart',$indexart);
			$this->display('index');
		}
		
	}
