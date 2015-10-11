<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/taobaoke/Public/icon.ico">

    <title>首页</title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/taobaoke/Public/Index/bootstrap/css/bootstrap.min.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="/taobaoke/Public/Index/bootstrap/css/bootstrap-theme.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/taobaoke/Public/Index/bootstrap/js/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/taobaoke/Public/Index/bootstrap/js/bootstrap.min.js"></script>

    <script src="/taobaoke/Public/Index/js/reflex.js"></script>
    <script src="/taobaoke/Public/Index/js/scroll.js"></script>
    <link href="/taobaoke/Public/Index/css/index.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script type="text/javascript">
      $(document).ready(function(){
        $('.marquee').kxbdMarquee({
          direction:'left',
          eventA:'mouseenter',
          eventB:'mouseleave'
        });
      });
    
    //加入收藏
    function AddFavorite(sURL, sTitle) {
      sURL = encodeURI(sURL); 
      try{   
        window.external.addFavorite(sURL, sTitle);   
      }catch(e) {   
        try{   
          window.sidebar.addPanel(sTitle, sURL, "");   
        }catch (e){   
          alert("加入收藏失败，请使用Ctrl+D进行添加,或手动在浏览器里进行设置.");
        }   
      }
    }
    </script>
  </head>
  <body>
    <nav>
      <div class="container">
        <div class="col-md-1 col-xs-0 col-sm-1">
        </div>
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-3"><img src="/taobaoke/Uploads/img/logo.png" width="100px" style="margin:0px;padding:3px;float:left;"></div>
            <div class="col-md-3 navcell"></div>
            <div class="col-md-3 navcell">
            <a href="tencent://message/?uin=<?php echo ($QQ["content"]); ?>&Site=&Menu=yes">服务QQ</a></div>
            <div class="col-md-3 navcell"><a href="" onclick="AddFavorite(window.location,document.title)" href="javascript:void(0)">收藏BOOKMARK+</a></div>
          </div>
        </div>
        <div class="col-md-1 col-xs-0 col-sm-1">
        </div>
      </div>
    </nav>

    <div class="container main" role="main">
      <div class="row">
        <div class="col-md-1 col-xs-0 col-sm-1">
        </div>
        <div class="col-md-10 col-xs-12 col-sm-10">
          <div class="row plan">
            <div class="col-md-12">
              <div class="marquee"> 
                <ul>
                  <?php if(is_array($scroll_shop)): foreach($scroll_shop as $k=>$data): ?><li><img src="/taobaoke<?php echo ($data["pic_adr"]); ?>"/></li><?php endforeach; endif; ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="row display">
            <div class="col-md-12 col-xs-12 col-sm-12">
              <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                  <?php if(is_array($scroll_index)): foreach($scroll_index as $k=>$vo): if($key == 0): ?><li data-target="#carousel-example-generic" data-slide-to="<?php echo ($key); ?>" class="active"></li>
                    <?php else: ?>
                      <li data-target="#carousel-example-generic" data-slide-to="<?php echo ($key); ?>"></li><?php endif; endforeach; endif; ?>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                  <?php if(is_array($scroll_index)): foreach($scroll_index as $k=>$data): if($key == 0): ?><div class="item active">
                        <img class="dd" src="/taobaoke<?php echo ($data["pic_adr"]); ?>" />
                      </div>
                    <?php else: ?>
                      <div class="item">
                        <img class="dd" src="<?php echo ($data["pic_adr"]); ?>" />
                      </div><?php endif; endforeach; endif; ?>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                  <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                  <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                  <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                  <span class="sr-only">Next</span>
                </a>
              </div>
            </div>
          </div>
          <div class="row display low">
            <div class="col-md-4 col-xs-4 col-sm-4">
              <a href="<?php echo U('Production/Mancloth');?>">
                <img class="" src="/taobaoke<?php echo ($man_cloth_picture); ?>" />
              </a>
            </div>
            <div class="col-md-4 col-xs-4 col-sm-4">
              <a href="<?php echo U('Production/Womancloth');?>">
                <img class="" src="/taobaoke<?php echo ($woman_cloth_picture); ?>" />
              </a>
            </div>
            <div class="col-md-4 col-xs-4 col-sm-4">
              <a href="<?php echo U('Production/Shoe');?>">
                <img class="" src="/taobaoke<?php echo ($shoe_picture); ?>" />
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-1 col-xs-0 col-sm-1">
        </div>
      </div>
    </div>
  </body>
</html>