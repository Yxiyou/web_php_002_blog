<?php
/**
*   +----------------------------------------------------------------------
*   | Author: ONLY <491518132@qq.com>
*	+----------------------------------------------------------------------
*   | Creater Time : 2013-6-15
*   +----------------------------------------------------------------------
*   | Link ( http://www.phpyrb.com  http://www.cloudsskill.com )
*   +----------------------------------------------------------------------
**/

	class Article {
		protected $cates,$uid;
		protected $Debug;
		
		function __construct($uid = 1,$_debug = false) {
			$this->uid = $uid;
			$this->Debug = $_debug;
			$this->cates = array();
		}
		
		/**
		 * 根据用户ID返回评论多的文章ID
		 * @param string $_uid 用户
		 * @param int $_num 条数
		 * @return array $topart 
		 */
		function commtent10 ($_uid ,$_num = '10') {
			$model = M('Article');
			$topart = $model->where(array('uid',$_uid))->order('hots DESC')->limit($_num)->select();
			if($this->Debug){
				dump($this->Article->getLastSql());
			}
			return $topart;
		}
		
		/**
		 * 根据用户ID返回热门文章ID
		 * @param string $_uid 用户
		 * @param int $_num 条数
		 * @param string $_field 字段
		 * @return array $topart
		 */
		function top10 ($_uid ,$_num = '10',$_field = '*') {
			$model = M('Article');
			$where['uid'] = $_uid ? $_uid : $this->uid;
			$where['status'] = '1';
			$topart = $model->field($_field)->where($where)->order('hots DESC')->limit($_num)->select();
			if($this->Debug){
				dump($this->Article->getLastSql());
			}
			foreach ($topart as $k => $v){
				$topart[$k]['commcount'] = $this->commcount($v['id']);
				$temp = $this->cateinfo($v['cateid']);
				$topart[$k]['cate'] = $temp['0']['name'];
				$topart[$k]['tags'] = $this->taginfo($v['tags']);
			}
			return $topart;
        }
        
        /**
         * 返回用户最新的文章
         * @param int $uid 
         * @param string $_limit 条数
         * @param return $new10 
         **/
        function new10 ($_uid,$_limit='10'){
            $model = M('Article');
            $where['uid'] = $_uid ? $_uid : $this->uid;
            $where['status'] = '1';
            $new10 = $model->where($where)->order('uptime DESC')->limit($_limit)->select();
            if($this->Debug){
                echo $model->getLastSql();
            }
			foreach ($new10 as $k => $v){
				$new10[$k]['commcount'] = $this->commcount($v['id']);
				$temp = $this->cateinfo($v['cateid']);
				$new10[$k]['cate'] = $temp['0']['name'];
				$new10[$k]['tags'] = $this->taginfo($v['tags']);
			}
			return $new10;
        }
	    
		/**
		 * 返回分类下的文章ID
		 * @param int $_cateid
		 * @param int $_uid
		 * @return array $catrart
		 */
		function catetoart ($_cateid ,$_uid) {
			$model = M('Article');
			$_cateid ? $where['cateid'] = $_cateid : $this->_message(FALSE, '请传入分类ID！',__LINE__);
			$_uid ? $where['uid'] = $_uid : $this->_message(FALSE, '请传入用户ID！',__LINE__);
			$where['status'] = 1;
			$cateart = $model->field('id')->where($where)->select();
			if($this->Debug){
				dump($this->Article->getLastSql());
			}
			$cateart = $this->_arr2to1($cateart);
			return $cateart;
		}
		
		/**
		 * 返回分类下的文章数
		 * @param int $_uid
		 * @return array $catecount
		 */
		function catetonum ($_uid) {
			$model = M('Article');
			$where['uid'] = $_uid;
			$where['status'] = 1;
			$catecount = $this->cate($_uid);
			foreach ($catecount as $k => &$v){
				$where['uid'] = $_uid;
				$where['cateid'] = $v['id'];
				$where['status'] = 1;
				$count = $model->where($where)->count('id');
				$v['count'] = $count;
			}
			return $catecount;
		}
		
		/**
		 * 返回分类信息
		 * @param int $_cateid
		 * @return string $name
		 */
		function cateinfo ($_cateid,$_field = 'name') {
			$model = M('Cate');
			$where['id'] = is_array($_cateid) ? array('IN',implode(',', $_cateid)) : $_cateid;
			$cateinfo = $model->field($_field)->where($where)->select();
			return $cateinfo;
		}
		
		/**
		 * 返回用户的分类
		 * @param int $_uid
		 * @return array $cate
		 */
		function cate ($_uid,$_limit = '',$_type = '1') {
			$model = M('Cate');
			$where['uid'] = $_uid;
			$where['id'] = array('NEQ',5);
			$_type ? $where['type'] = $_type : false;
			$cate = $model->where($where)->limit($_limit)->select();
			if($this->Debug){
				dump($this->Categroy->getLastSql());
			}
			return $cate;
		}
		
		/**
		 * 返回用户的标签
		 * @param int $_uid
		 * @return array $cate
		 */
		function tag ($_uid,$_limit = '') {
			$model = M('Cate');
			$where['uid'] = $_uid;
			$where['type'] = '2';
			$tag = $model->where($where)->limit($_limit)->select();
			if($this->Debug){
				dump($this->Categroy->getLastSql());
			}
			$this->cates = array();
			return $tag;
		}

        /**
         * 返回标签信息
         * @param array $_ids
         * @return array $tag 
         * */
		function taginfo ($_ids){
			$model = M('Cate');
//			$where['id'] = array('IN',$_ids);
 			$where['id'] = is_array($_ids) ? array('IN',implode(',', $_ids)) : $_ids; 
			$tags = $model->field('id,name')->where($where)->select();
// 			echo $model->getLastSql();
			return $tags;
		}
		/**
		 * 统计条数
		 * @param string $_model 表名
		 * @param string $_felid 字段
		 * @param array $_where 条件
		 * @return array $count
		 */
		function count($_model,$_where = array(),$_felid = 'id'){
			$model = M("$_model");
			$where = $_where;
			$count = $model->where($where)->count('id');
			if($this->Debug){
				dump($model->getlastsql());
			}
			return $count;
		}
		
		/**
		 * 返回分类的层次
		 * @param array $_cate
		 * @param int $_pid
		 * @param int $_level
		 * @return array $this->cates
		 */
		function categroys ($_cate,$_pid = 0,$_level = 1) {
			foreach ($_cate as $k => $v){
				if($v['pid'] == $_pid){
					$v['level'] = $_level;
					$this->cates[$v['id']] = $v;
					$this->categroys($_cate, $v['id'],$_level+1);
				}
			}
			return $this->cates;
		}
		
		/**
		 * 返回树形菜单
		 * @param array $_cate
		 * @return array $_cate
		 */
		function catelevel ($_cate) {
			foreach ($_cate as $k => &$v){
				$stra = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;|';
				$strb = '&nbsp;--&nbsp;';
				$strc = '';
				for($i=0;$i<$v['level'];$i++){
					$strc = $strc.$stra;
				}
				$v['name'] = $strc.$strb.$v['name'];
			}
			return $_cate;
		}
		
		/**
		 * 搜索 返回IDS
		 * @param srting $_keyword
		 * @return array $ids
		 */
		function search ($_keyword) {
			$model = M('Article');
			$where['kword']  = array('like',"%$_keyword%");
			$where['title']  = array('like',"%$_keyword%");
			$where['content']  = array('like',"%$_keyword%");
			$where['_logic'] = 'or';
			$ids = $model->field('id')->where($where)->select();
			$ids = $this->_arr2to1($ids);
			return $ids;
		}
        
        /**
         * 搜索相关标签
         * @param int $_tagid
         * @return $artid
         * */        
		function tagsearch($_tagid){
			$model = M('Article');
			$where['_string'] = "find_in_set ($_tagid,tags)";
			$artid = $model->field('id')->where($where)->select();
			$artid = $this->_arr2to1($artid,'id');
			return $artid;
        }

		/**
		 * 返回用户下文章IDS
		 * @param int $_uid
		 * @return array $ids
		 */
		function usertoart ($_uid) {
			$model = M('Article');
			if($_uid){
				$where['uid'] = $_uid;
				$ids = $model->field('id')->where($where)->order('uptime DESC')->select();
				if($this->Debug) {dump($model->getLastSql());}
				$ids = $this->_arr2to1($ids);
				return $ids;
			}else{
				$this->_message(false, '请传入正确ID！',__LINE__);
			}
		}
		
		/**
		 * 根据ID返回文章内容
		 * @param string|array $_id
		 * @return array $artinfo
		 */
		function content ($_id ,$_field = '*') {
			$model = M('Article');
			if($_id){
				$where['id'] = is_array($_id) ? array('IN',implode(',', $_id)) : $_id;
				$artinfo = $model->field($_field)->where($where)->order('uptime DESC')->select();
				if($this->Debug){
					dump($this->Article->getLastSql());
				}
				foreach ($artinfo as $k => &$v){
					$v['commcount'] = $this->commcount($v['id']);
					$temp = $this->cateinfo($v['cateid']);
					$v['cate'] = $temp['0']['name'];
					$v['tagid'] = explode(',', $v['tags']);
					$v['tags'] = $this->taginfo($v['tagid']);
				}
				return $artinfo;
			}else{
				$this->_message(false, '请传入正确ID！',__LINE__);
			}
		}
		 
		/**
		 * 更新点击率
		 * @param 文章ID $_artid
		 * @return array $reid
		 */
		function hots ($_artid) {
			$model = M('Article');
			$where['id'] = $_artid;
			$reid = $model->where($where)->setInc('hots');
			if($this->Debug){
				dump($this->Article->getLastSql());
			}
			return $reid;
		}
		
		/**
		 * 返回文章评论
		 * @param int $_artid
		 * @return array $comment
		 */
		function comment ($_artid) {
			$model = M('Comment');
			$where['artid'] = $_artid;
			$where['status'] = 1;
			$comment = $model->where($where)->select();
			return $comment;
		}
		
		/**
		 * 返回文章评论数
		 * @param int $_artid
		 * @return array commcount
		 */
		function commcount ($_artid) {
			$model = M('Comment');
			$where['artid'] = $_artid;
			$where['status'] = 1;
			$commcount = $model->where($where)->count('id');
			return $commcount;
		}
		
		/**
		 * 添加、修改
		 * @param array $_data 数据
		 * @param string $_model 模型
		 * @param string $_type 动作名
		 */
		function add_updata ($_data, $_model='Article',$_type = 'add',$_checked='false') {
			$model = M("$_model");
			if($_data){
				$reid = $model->create($_data);
				if($reid){
					if($_type == 'add'){
						$reid = $model->add();
						if($this->Debug) dump($model->getLastSql());
						$reid = $this->_message($reid, '添加失败！',__LINE__);
						return $reid;
					}elseif($_type == 'updata'){
						$reid = $model->save();
						if($this->Debug) dump($model->getLastSql());
						$reid = $this->_message($reid, '添加失败！',__LINE__);
						return $reid;
					}else{
						$this->_message(false, '请传入正确的动作！', __LINE__);
					}
				}else{
					$this->_message(false, "创建模型失败！", __LINE__);
				}
			}else{
				$this->_message(false, '没有数据！', __LINE__ );
			}
		}
		
		/**
		 * 根据ID删除数据
		 * @param string|array $_id
		 */
		function delect ($_id) {
			$model = M("Article");
			if($_id){
				$where['id'] = is_array($_id) ? array('IN',implode(',', $_id)) : $_id;
				$reid = $model->where($where)->delete();
				$this->_message($reid, '删除失败！',__LINE__);
			}else{
				$this->_message(false, '请您要删除的ID！',__LINE__);
			}
		}
		
		/**
		 * 返回提示信息
		 * @param multitype $_val
		 * @param json
		 */
		function _message($_val,$_msg,$_line = false){
			if(!$_val || empty($_val) || $_val === 'false'){
				if($this->Debug){
					$errormsg = '错误提示：'.$_msg.'在第'."$_line".'行！';
					exit($errormsg);
				}else{
					return 'false';
					exit;
				}
			}else{
				return 'true';
				exit;
			}
		}
		
		/**
		 * 二维数组返回一维或字符串
		 * @param array $_arr
		 * @param string $_field
		 * @param string $_type 1为数组 2为字符串
		 * @return multitype:array|multitype:string
		 */
		function _arr2to1($_arr,$_field = 'id',$_type = '1'){
			if ( ! $_arr ) return array();
			$arrayids = array();
			foreach ($_arr as $k => $v){
				$arrayids[$k] = $v[$_field];
			}
			if($_type != '1') $arrayids = implode(',',$arrayids);
			return $arrayids;
		}
		

		/**
		 * URL重定向
		 * @param string $url 重定向的URL地址
		 * @param integer $time 重定向的等待时间（秒）
		 * @param string $msg 重定向前的提示信息
		 * @return void
		 */
		function jumpurl($url, $time=0, $msg='') {
			//多行URL地址支持
			$url        = str_replace(array("\n", "\r"), '', $url);
			if (empty($msg))
				$msg    = "系统将在{$time}秒之后自动跳转到{$url}！";
			if (!headers_sent()) {
				// redirect
				if (0 === $time) {
					header('Location: ' . $url);
				} else {
					header("refresh:{$time};url={$url}");
					echo($msg);
				}
				exit();
			} else {
				$str    = "<meta http-equiv='Refresh' content='{$time};URL={$url}'>";
				if ($time != 0)
					$str .= $msg;
				exit($str);
			}
		}
	}
