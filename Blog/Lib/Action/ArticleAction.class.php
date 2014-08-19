<?php
/**
*   +----------------------------------------------------------------------
*   | Author: ONLY <491518132@qq.com>
*	+----------------------------------------------------------------------
*   | Creater Time : 2013-6-17
*   +----------------------------------------------------------------------
*   | Link ( http://www.phpyrb.com  http://www.cloudsskill.com )
*   +----------------------------------------------------------------------
**/

	class ArticleAction extends IniAction{
		function _initialize(){
			parent::_initialize();
		}
		
		function index () {
			$artid = $_REQUEST['artid'];
			$this->Article->hots($artid);
			$content = $this->Article->content($artid);
			$this->assign('info',$content['0']);
			$this->display();
		}
		
		function commentadd () {
            $data['name'] = $_REQUEST['name'];
            $data['email'] = $_REQUEST['email'];
            $data['comment'] = $_REQUEST['comment'];
            $reid = $this->Article->add_updata($data,'Comment','add','true');
            if($reid){
                echo '1';
            }else{
                echo '0';
            }
        }
		
		function comment () {
            $artid = $_REQUEST['artid'];
            
		}
		
		function tagart (){
			$tagid = $_REQUEST['tagid'];
			$artids =$this->Article->tagsearch($tagid);
			
			$count = count($artids);
			$page = new Page($count,10);
			$offset = $page -> firstRow;
			$length = $page -> listRows;
			$pageshow = $page->show();
			$ids = array_slice($artids, $offset, $length);
			$article = $this->Article->content($ids);
			
			$this->assign('page',$pageshow);
			$this->assign('article',$article);
			$this->display();
		}
	}
