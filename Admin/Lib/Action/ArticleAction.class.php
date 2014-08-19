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
		
		function _initialize() {
			parent::_initialize();
			$cate = $this->Article->cate($this->uid);
			$cate = $this->Article->categroys($cate);
			$cate = $this->Article->catelevel($cate);
			$this->assign('cate',$cate);
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
			$this->assign('ative','article');
			$this->display();
		}
		
		/**
		 * 文章编辑页
		 */
		function edit () {
			if($_REQUEST['artid']){
				$art = $this->Article->content($_REQUEST['artid']);
				$this->assign('art',$art['0']);
			}
			$tag = $this->Article->tag($this->uid);
			$this->assign('tag',$tag);
			$this->assign('ative','article');
			$this->assign('active','edit');
			$this->display();
		}
		
		/**
		 * 添加文章、更新文章
		 */
		function add () {
			$data = array();
			$data['uid'] = $_SESSION['uid'];
			$data['cateid'] = $_REQUEST['categorys'];
			$data['title'] = $_REQUEST['artname'];
			$data['author'] = $_REQUEST['author'];
			$data['kword'] = $_REQUEST['keyword'];
			$data['description'] = $_REQUEST['description'];
			$data['content'] = $_REQUEST['content'];
			$data['uptime'] = time();
			$data['tags'] = implode(',',$_REQUEST['tags']);
			$data['status'] = $_REQUEST['status'];
			if($_REQUEST['artid']){
				$data['id'] = $_REQUEST['artid'];
				$reid = $this->Article->add_updata($data,'Article','updata');
				if($reid){
					$this->success('更新成功！',U('Article/index'));
				}else{
					$this->error('更新失败！',U('Article/edit',array('artid'=>$data['id'])));
				}
			}else{
				$data['ctime'] = NOW_TIME;
				$reid = $this->Article->add_updata($data);
				if($reid){
					$this->success('更新成功！',U('Article/index'));
				}else{
					$this->error('更新失败！',U('Article/edit',array('artid'=>$data['id'])));
				}
			}
		}
		
		/**
		 * 删除
		 */
		function delect () {
			$id = $_REQUEST['artid'];
			$this->Article->delect($id);
		}
		
		/**
		 * 分类添加显示页
		 */
		function category () {
			if($_REQUEST['cateid']){
				$cateid = $_REQUEST['cateid'];
				$cateinfo = $this->Article->cateinfo($cateid,'*');
				$this->assign('cateinfo',$cateinfo['0']);
			}
			$tags = $this->Article->tag($this->uid);
			$tags = $this->Article->categroys($tags);
			$tags = $this->Article->catelevel($tags);
			$this->assign('tags',$tags);
			$this->assign('ative','category');
			$this->assign('active','category');
			$this->display();
		}
		
		/**
		 * 添加分类
		 */
		function cateadd(){
			$data = array();
			$data['type'] = $_REQUEST['type'];
			$data['pid'] = $data['type'] == 1 ? $_REQUEST['categorys'] : $_REQUEST['tags'];
			$data['name'] = $_REQUEST['catetagname'];
			$data['uid'] = $this->uid;
			if($_REQUEST['cateid']){
				$data['id'] = $_REQUEST['cateid'];
				$reid = $this->Article->add_updata($data,'Cate','updata');
				if($reid){
					$this->success('更新成功！',U('Article/catelist'));
				}else{
					$this->error('更新失败！',U('Article/category',array('artid'=>$data['id'])));
				}
			}else{
				$reid = $this->Article->add_updata($data,'Cate');
				if($reid){
					$this->success('更新成功！',U('Article/catelist'));
				}else{
					$this->error('更新失败！',U('Article/category',array('artid'=>$data['id'])));
				}
			}
		}
		
		/**
		 * 分类列表
		 */
		function catelist () {
			$count = $this->Article->count('Cate',array('uid'=>$this->uid));
			$page = new Page($count,5);
			$limit = $page -> firstRow . ',' . $page -> listRows;
			$pageshow = $page->show();
			$cateinfo = $this->Article->cate($this->uid,$limit,'');
			$type = array('1'=>'Category','2'=>'Tag');
			$this->assign('page',$pageshow);
			$this->assign('cateinfo',$cateinfo);
			$this->assign('type',$type);
			$this->assign('ative','category');
			$this->assign('active','catelist');
			$this->display();
		}
		
		/**
		 * 标签列表
		 */
		function taglist () {
			$count = $this->Article->count('Cate',array('uid'=>$this->uid,'type'=>2));
			$page = new Page($count,5);
			$limit = $page -> firstRow . ',' . $page -> listRows;
			$pageshow = $page->show();
			$tags = $this->Article->tag($this->uid,$limit);
			$this->assign('page',$pageshow);
			$this->assign('tags',$tags);
			$this->display();
		}
	}