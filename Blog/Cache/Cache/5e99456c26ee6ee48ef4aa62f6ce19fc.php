<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <title><?php if($info['title'] ) : echo ($info['title']); ?>,<?php endif;?>yxy个人博客</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
   	<meta name="keywords" content="<?php echo ($info['kword']); ?>" />
    <meta name="description" content="<?php echo ($info['description']); ?>" />
    <link href="__PUBLIC__/Css/base.css" rel="stylesheet" type="text/css" />
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/SyntaxHighlighter/styles/shCore.css"/>
	<link type="text/css" rel="stylesheet" href="__PUBLIC__/SyntaxHighlighter/styles/shThemeDefault.css"/>
</head>
<body>
    <div class="header">
        <div class="logo">
            <h1><a href="<?php echo U('Index/index');?>">blog<span> Blog</span></a><small style="font-size:13px;">&nbsp;&nbsp;&nbsp;yxy</small></h1>
        </div>
        <div class="menu_nav">
            <ul>
              <li class="menufrist"><a href="<?php echo U('Index/index');?>">Home</a></li>
			  <?php if(is_array($meau)): $i = 0; $__LIST__ = $meau;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/index',array('cateid'=>$m['id']));?>"><?php echo ($m['name']); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
			  <!--
              <li><a href="support.html">Support</a></li>
              <li><a href="about.html">About Us</a></li>
              <li><a href="blog.html">Blog</a></li>
              <li><a href="contact.html">Contact Us</a></li>
			  -->
            </ul>
            <div class="search">
            	<form method="get" action="<?php echo U('Index/search');?>">
	                <input type="search" name="keyword" style="width:160px;height:36px;line-height:36px;background:none;border:0px;font-size:16px;" />
	                <input type="submit" value=" " style="width:72px;height:25px;margin-left:3px;border:none;background:url(Public/Image/searchbtn.png) no-repeat 0 -1px;"/>
					<input type="hidden" name="m" value="Index">
					<input type="hidden" name="a" value="search">
				</form>
            </div>
        </div>
      <!--<div class="search">-->
        <!--<form id="form" name="form" method="post" action="">-->
          <!--<span>-->
          <!--<input name="q" type="text" class="keywords" id="textfield" maxlength="50" value="Search..." />-->
           <!--</span>-->
          <!--<input name="b" type="image" src="images/search.gif" class="button" />-->
        <!--</form>-->
       <!--</div>-->
   </div>

   <div class="content">
        <div class="left">
        	<?php if(is_array($indexart)): $i = 0; $__LIST__ = $indexart;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$a): $mod = ($i % 2 );++$i;?><div class="article first">
             		<h2 class="h123"><a href="<?php echo U('Article/index',array('artid'=>$a['id']));?>" target="_blank"><?php echo ($a['title']); ?></a></h2>
                    <p class="tag">标 签：
					<?php if(is_array($a['tags'])): $i = 0; $__LIST__ = $a['tags'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><a href="<?php echo U('Article/tagart',array('tagid'=>$t['id']));?>"><span><?php echo ($t['name']); ?></span></a><?php endforeach; endif; else: echo "" ;endif; ?>
					</p>
					<div class="clr"></div>
					<div class="date" style="border:none;box-shadow:none;z-index:-100;">
                    	<!--
                    	<p class="image"><a href="<?php echo U('Index/index');?>"><img alt="PhPyRb博客!马伟博客!" src="/Public/Image/logo.jpg" /></a></p>
                        <p class="time"><a href="<?php echo U('Index/index');?>">Ma Wei</a></p>
						-->
                    </div>
                    <div class="clr"></div>
                    <div class="cont" id="maxart">
                    	<?php echo ($a['content']); ?>
                    </div>
                    <div class="info">
                    	<p>
                    		<span><a href="<?php echo U('Index/index',array('cateid'=>$a['cateid']));?>" target="_blank"><?php echo ($a['cate']); ?></a></span> / 
							<span><a href="<?php echo U('Article/index',array('artid'=>$a['id']));?>" target="_blank">评 论&nbsp;(<?php echo ($a['commcount']); ?>)</a></span> / 
							<span>热度&nbsp;(<?php echo ($a['hots']); ?> ℃)</span> / 
							<span><?php echo (date("Y-m-d",$a['uptime'])); ?></span> / 
							<span><a href="<?php echo U('Article/index',array('artid'=>$a['id']));?>" target="_blank">阅读全文&nbsp;</a></span>
						</p>
					</div>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>
		   <div><div class="clr"></div>
		   </div>
		   <div id="page">
		   		<p><?php echo ($page); ?></p>
		   </div>
        </div>
        <!-- start right -->
			<div class="right">
            <div class="sidebar">
              <h2>文章分类</h2>
              <div class="clr"></div>
              <ul class="sb_menu">
              	<?php if(is_array($meau)): $i = 0; $__LIST__ = $meau;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/index',array('cateid'=>$m['id']));?>"><?php echo ($m['name']); ?></a>&nbsp;(<?php echo ($m['count']); ?>)</li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </div>
            
            <div class="sidebar">
              <h2>热门标签</h2>
              <div class="clr"></div>
			  <ul class="sb_menu two">
			  	<?php if(is_array($taglist)): $i = 0; $__LIST__ = $taglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i; if(($mod) == "0"): ?><li><a href="<?php echo U('Article/tagart',array('tagid'=>$l['id']));?>"><?php echo ($l['name']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </ul>
			  <ul class="sb_menu two">
			  	<?php if(is_array($taglist)): $i = 0; $__LIST__ = $taglist;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$l): $mod = ($i % 2 );++$i; if(($mod) == "1"): ?><li><a href="<?php echo U('Article/tagart',array('tagid'=>$l['id']));?>"><?php echo ($l['name']); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
              </ul>
			</div>  
            <!--
            <div class="sidebar">
              <h2>Sidebar Menu</h2>
              <div class="clr"></div>
              <ul class="sb_menu">
                <li><a href="#">Home</a></li>
                <li><a href="#">TemplateInfo</a></li>
                <li><a href="#">Style Demo</a></li>
                <li><a href="#">Blog</a></li>
                <li><a href="#">Archives</a></li>
                <li><a href="#" title="Website Templates">Web Templates</a></li>
              </ul>
            </div>
			-->
            
             <div class="sidebar">
              <h2>热门文章</h2>
              <div class="clr"></div>
              <ul class="sb_menu">
              	<?php if(is_array($top10)): $i = 0; $__LIST__ = $top10;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$t): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Article/index',array('artid'=>$t['id']));?>"><?php echo ($t['title']); ?></a>&nbsp;(<?php echo ($t['hots']); ?>)</li><?php endforeach; endif; else: echo "" ;endif; ?>
              </ul>
            </div>
           
	</div>	
		<!-- end right -->
	</div>
	<div class="clr"></div>

   <div class="footer">
        <p class="lr">© Copyright <a href="http://www.phpyrb.com">http://www.phpyrb.com http://www.cloudsskill.com</a>.</p>
        <p class="lf">Collect from: <a href="http://www.phpyrb.com" title="yxy博客" target="_blank">yxy博客</a></p>
        <div class="clr"></div>
   </div>
	<script type="text/javascript" src="__PUBLIC__/SyntaxHighlighter/scripts/shCore.js"></script>
	<script type="text/javascript">
		SyntaxHighlighter.config.clipboardSwf = '/Public/SyntaxHighlighter/scripts/clipboard.swf';
		SyntaxHighlighter.all();
	</script>
	<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.9.1.min.js"></script>
    
	<script type="text/javascript" src="__PUBLIC__/SyntaxHighlighter/scripts/shBrushCss.js"></script>
	<script type="text/javascript" src="__PUBLIC__/SyntaxHighlighter/scripts/shBrushJScript.js"></script>
    <script type="text/javascript" src="__PUBLIC__/SyntaxHighlighter/scripts/shBrushPython.js"></script>
    <script type="text/javascript" src="/Public/SyntaxHighlighter/scripts/shBrushSql.js"></script>
    <script type="text/javascript" src="/Public/SyntaxHighlighter/scripts/shBrushBash.js"></script>
    <script type="text/javascript" src="/Public/SyntaxHighlighter/scripts/shBrushPython.js"></script>
    <script type="text/javascript" src="/Public/SyntaxHighlighter/scripts/shBrushPhp.js"></script>
    <div style="display:hidden;">
        <script type="text/javascript">
            var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
            document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F6238436e2f7b68b79f031f095826dc4b' type='text/javascript'%3E%3C/script%3E"));
        </script>
    </div>
</body>	
</html>