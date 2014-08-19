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

	class LoginAction extends Action{
		function _initialize(){
		}
		
		function index () {
			$this->display();
		}
		
        function login () {
            $where = array();
            $where['uname'] = $_POST['username'];
            $where['pword'] = sha1($_POST['password']);
            $this->User = M('User');
            $reid = $this->User->field('id')->where($where)->find();
            $_SESSION['uid'] = $reid['id'];
            if($reid){
                $this->redirect('Index/index');
            }else{
            	$this->error('用户名和密码错误！','Login/index');
//                 echo "<script>alert('用户名和密码错误！');window.location.href=''</script>";
                // 				$this->redirect('Login/index');
            }
        }

        function logout() {
			unset($_SESSION['uid']);
			$this->redirect('Login/index');
        }
    }
