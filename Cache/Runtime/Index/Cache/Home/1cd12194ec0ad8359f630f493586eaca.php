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

    <title>单品推介</title>

    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="/taobaoke/Public/Index/bootstrap/css/bootstrap.min.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
    <link rel="stylesheet" href="/taobaoke/Public/Index/bootstrap/css/bootstrap-theme.min.css">

    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="/taobaoke/Public/Index/bootstrap/js/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="/taobaoke/Public/Index/bootstrap/js/bootstrap.min.js"></script>

    <script src="/taobaoke/Public/Index/js/scroll.js"></script>
    <link href="/taobaoke/Public/Index/css/production.css" rel="stylesheet">

    <script type="text/javascript" src="/taobaoke/Public/Index/js/kkpager.min.js"></script>
    <link rel="stylesheet" type="text/css" href="/taobaoke/Public/Index/css/kkpager_orange.css" />

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
    </script>
  </head>
  <body>
    <nav>
      <div class="container1">
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-2 sign"><?php echo ($title); ?></div>
              <a href="<?php echo U('Production/index');?>"><div class="col-md-1 active">单品推介</div></a>
              <a href="<?php echo U('Shop/index');?>"><div class="col-md-1 choice">店铺推荐</div></a>
              <div class="col-md-4 navcell"></div>
              <div class="col-md-2 navcell right"><a href="">收藏BOOKMARK+</a></div>
              <div class="col-md-3 navcell right"><a href="">服务QQ:XXXXXXXXX</a></div>
            </div>
          </div>
        </div>
        <div class="col-md-1">
        </div>
      </div>
    </nav>

    <div class="container1">
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div class="marquee"> 
            <ul>
              <li><img src="/taobaoke/Public/Index/img/scroll1.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll2.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll3.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll4.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll5.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll6.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll7.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll1.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll2.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll3.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll4.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll5.png"/></li>
              <li><img src="/taobaoke/Public/Index/img/scroll6.png"/></li>
            </ul>
          </div>
        </div>
        <div class="col-md-1">
        </div>
      </div>

      <div class="container1">
        <div class="row">
          <div class="col-md-1">
          </div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-2">
                <img src="/taobaoke/Public/Index/img/logo.png" />
              </div>
              <div class="col-md-3">
              </div>
              <div class="col-md-2">
                <img src="/taobaoke/Public/Index/img/adv1.png" style="width:100%;padding:0px;" />
              </div>
              <div class="col-md-2">
              </div>
              <div class="col-md-3">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="输入内容...">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">搜索</button>
                  </span>
                </div><!-- /input-group -->
              </div>
            </div>
          </div>
          <div class="col-md-1">
          </div>
        </div>
      </div>
    </div>

    <div class="container1">
      <div class="row">
        <div class="col-md-12">
          <div class="navigation">
            <div class="row">
              <div class="col-md-1">
              </div>
              <div class="col-md-10">
                <div class="col-md-1">
                  <a href="<?php echo U('Index/index');?>">首页</a>
                </div>
                <div class="col-md-1">
                  <div class="btn-group">
                    <a href=""  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">分类<span class="caret"></span></a>

                    <ul class="dropdown-menu">
                      <li><a href="#">分类a</a></li>
                      <li><a href="#">分类b</a></li>
                      <li><a href="#">分类c</a></li>
                      <li role="separator" class="divider"></li>
                      <li><a href="#">分类d</a></li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-1" style="padding:0px">
                  <a href="">男士服装</a>
                </div>
                <div class="col-md-1" style="padding:0px">
                  <a href="">女士服装</a>
                </div>
                <div class="col-md-1">
                  <a href="">鞋</a>
                </div>
              </div>
              <div class="col-md-1">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="container1">
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <div class="item active">
                <img src="/taobaoke/Public/Index/img/ad2.png" style="width:100%;padding:0px;">
              </div>
              <div class="item">
                <img src="/taobaoke/Public/Index/img/ad2.png" style="width:100%;padding:0px;">
              </div>
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
        <div class="col-md-1">
        </div>
      </div>
    </div>

    <div class="container1" style="margin-top:10px;">
      <div class="row">
        <div class="col-md-1">
        </div>
        <div class="col-md-10">
          <div class="row">
            <div class="col-md-12">
              <div class="row">
<!--                 <div class="col-md-3">
                  <div class="thumbnail framework" style="border:none;padding:0px;">
                    <img src="/taobaoke/Public/Index/img/pic5.png" >
                    <div class="caption">
                      <p>韩都衣舍韩版2015秋款女时尚显瘦纯色背带连衣裙NW5265琴0911</p>
                      <p class="price">￥399</p>
                    </div>
                  </div>
                </div> -->
                <div class="col-md-4">
                <a class="ef" href="#"> <div class="J_super_item item-mod  super-item-start"><img style="display: block;" class="img lazy" alt="15英寸韩版休闲双肩包（2色选）" data-original="http://l2.51fanli.net/super/images/2015/09/5603b4c74de4a.jpg" src="http://l2.51fanli.net/super/images/2015/09/5603b4c74de4a.jpg"><div class="J_item_notice msg-soon"><p>限售800件</p><span><strong>10:00开抢</strong><br>（以拍下时间为准）</span></div><h4 class="title"><span class="red">1.2折/</span>【瑞恩赛】15英寸韩版休闲双肩包（2色选）</h4><div class="money desc"><p class="price">                        ¥<strong>109.00</strong><del>¥379</del></p><p class="fl clearfix"><strong>-65.4</strong><i class="i-gmhf">购买后返<span>60%</span></i></p></div><a class="mod-btn J_item_link J_item_btn ht J_nodelog" href="javascript:void(0);" data-href="http://fun.51fanli.com/goshop/go?id=712&amp;go=http%3A%2F%2Fdetail.tmall.com%2Fitem.htm%3Fid%3D520670825497&amp;pid=520670825497&amp;lc=shouye_brand" target="_blank">马上抢</a></div>
                </a>
                </div>
                <div class="col-md-4">
                <a class="ef" href="#"> <div class="J_super_item item-mod  super-item-start"><img style="display: block;" class="img lazy" alt="15英寸韩版休闲双肩包（2色选）" data-original="http://l2.51fanli.net/super/images/2015/09/5603b4c74de4a.jpg" src="http://l2.51fanli.net/super/images/2015/09/5603b4c74de4a.jpg"><div class="J_item_notice msg-soon"><p>限售800件</p><span><strong>10:00开抢</strong><br>（以拍下时间为准）</span></div><h4 class="title"><span class="red">1.2折/</span>【瑞恩赛】15英寸韩版休闲双肩包（2色选）</h4><div class="money desc"><p class="price">                        ¥<strong>109.00</strong><del>¥379</del></p><p class="fl clearfix"><strong>-65.4</strong><i class="i-gmhf">购买后返<span>60%</span></i></p></div><a class="mod-btn J_item_link J_item_btn ht J_nodelog" href="javascript:void(0);" data-href="http://fun.51fanli.com/goshop/go?id=712&amp;go=http%3A%2F%2Fdetail.tmall.com%2Fitem.htm%3Fid%3D520670825497&amp;pid=520670825497&amp;lc=shouye_brand" target="_blank">马上抢</a></div>
                </a>
                </div>
                <div class="col-md-4">
                <a class="ef" href="#"> <div class="J_super_item item-mod  super-item-start"><img style="display: block;" class="img lazy" alt="15英寸韩版休闲双肩包（2色选）" data-original="http://l2.51fanli.net/super/images/2015/09/5603b4c74de4a.jpg" src="http://l2.51fanli.net/super/images/2015/09/5603b4c74de4a.jpg"><div class="J_item_notice msg-soon"><p>限售800件</p><span><strong>10:00开抢</strong><br>（以拍下时间为准）</span></div><h4 class="title"><span class="red">1.2折/</span>【瑞恩赛】15英寸韩版休闲双肩包（2色选）</h4><div class="money desc"><p class="price">                        ¥<strong>109.00</strong><del>¥379</del></p><p class="fl clearfix"><strong>-65.4</strong><i class="i-gmhf">购买后返<span>60%</span></i></p></div><a class="mod-btn J_item_link J_item_btn ht J_nodelog" href="javascript:void(0);" data-href="http://fun.51fanli.com/goshop/go?id=712&amp;go=http%3A%2F%2Fdetail.tmall.com%2Fitem.htm%3Fid%3D520670825497&amp;pid=520670825497&amp;lc=shouye_brand" target="_blank">马上抢</a></div>
                </a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-1">
        </div>
      </div>
    </div>

    <div class="container" style="margin-top:10px;">
      <div class="row">
        <div class="col-md-6">
        </div>
        <div class="col-md-6">
          <div id="kkpager"></div>
        </div>
      </div>
    </div>
<script type="text/javascript">
function getParameter(name) { 
  var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)"); 
  var r = window.location.search.substr(1).match(reg); 
  if (r!=null) return unescape(r[2]); return null;
}
//init
$(function(){
  var totalPage = 20;
  var totalRecords = 390;
  var pageNo = getParameter('pno');
  if(!pageNo){
    pageNo = 1;
  }
  //生成分页
  //有些参数是可选的，比如lang，若不传有默认值
  kkpager.generPageHtml({
    pno : pageNo,
    //总页码
    total : totalPage,
    //总数据条数
    totalRecords : totalRecords,
    //链接前部
    hrefFormer : 'pager_test_orange_color',
    //链接尾部
    hrefLatter : '.html',
    getLink : function(n){
      return this.hrefFormer + this.hrefLatter + "?pno="+n;
    }
    
    ,lang       : {
      firstPageText     : '首页',
      firstPageTipText    : '首页',
      lastPageText      : '尾页',
      lastPageTipText     : '尾页',
      prePageText       : '上一页',
      prePageTipText      : '上一页',
      nextPageText      : '下一页',
      nextPageTipText     : '下一页',
      totalPageBeforeText   : '共',
      totalPageAfterText    : '页',
      currPageBeforeText    : '当前第',
      currPageAfterText   : '页',
      totalInfoSplitStr   : '/',
      totalRecordsBeforeText  : '共',
      totalRecordsAfterText : '条数据',
      gopageBeforeText    : '&nbsp;转到',
      gopageButtonOkText    : '确定',
      gopageAfterText     : '页',
      buttonTipBeforeText   : '第',
      buttonTipAfterText    : '页'
    }
    
    //,
    //mode : 'click',//默认值是link，可选link或者click
    //click : function(n){
    //  this.selectPage(n);
    //  return false;
    //}
  });
});
</script>

  <!--
  <div class="container1" style="margin-top:10px;">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="col-md-12">
            <img src="./image/ad3.png" style="width:100%" />
          </div>
        </div>
      </div>
      <div class="col-md-1">
      </div>
    </div>
  </div>-->
  
  <footer>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <div class="middle">
          <a href="#">条款与细则</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">隐私政策</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">黔ICP备15003298号</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">adidas版权所有</a>
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>
  </footer>


  </body>
</html>