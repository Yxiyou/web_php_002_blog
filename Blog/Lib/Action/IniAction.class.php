<?php
/**
*   +----------------------------------------------------------------------
*   | Author: ONLY <491518132@qq.com>
*	+----------------------------------------------------------------------
*   | Creater Time : 2013-6-13
*   +----------------------------------------------------------------------
*   | Link ( http://www.phpyrb.com  http://www.cloudsskill.com )
*   +----------------------------------------------------------------------
**/

	class IniAction extends Action {
		protected $Article , $Categroys , $Comment , $uid;
		function _initialize () {
			import('ORG.Cookie');
			import('ORG.Image');
			import('ORG.Page');
			import('Com.Article');
			
			$this->Article = new Article();
			$this->Categroys = M('Cate');
			$this->Comment = M('Comment');
			
			$this->uid = 1;
			$cate = $this->Article->catetonum($this->uid);
			$meau = $this->Article->categroys($cate, 2);
			$taglist = $this->Article->tag($this->uid);
			$taglist = $this->Article->categroys($taglist,12);
			$top10 = $this->Article->top10($this->uid,'10','id,title,hots');
			$tagsids = round(count($taglist)/2);

			$this->assign('tagcount',$tagsids);
			$this->assign('taglist',$taglist);
			$this->assign('top10',$top10);
			$this->assign('meau',$meau);
		}
		
	}