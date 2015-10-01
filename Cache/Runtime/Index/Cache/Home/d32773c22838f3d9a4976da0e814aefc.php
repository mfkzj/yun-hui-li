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
              <div class="col-md-2 navcell">
              <a href="tencent://message/?uin=<?php echo ($QQ["content"]); ?>&Site=&Menu=yes">服务QQ</a></div>
              <div class="col-md-2 navcell"><a href="" onclick="AddFavorite(window.location,document.title)" href="javascript:void(0)">收藏BOOKMARK+</a></div>
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
              <?php if(is_array($scroll_shop)): foreach($scroll_shop as $k=>$data): ?><li><img src="/taobaoke<?php echo ($data["pic_adr"]); ?>"/></li><?php endforeach; endif; ?>
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
                      <?php if(is_array($classification)): foreach($classification as $key=>$data): ?><li><a href="<?php echo U('Production/Womancloth');?>?classify=<?php echo ($data["id"]); ?>"><?php echo ($data["name"]); ?></a></li><?php endforeach; endif; ?>
                      <li role="separator" class="divider"></li>
                      <li><a href="<?php echo U('Production/Womancloth');?>?classify=all">全部</a></li>
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
              <?php if(is_array($scroll_production)): foreach($scroll_production as $k=>$vo): if($key == 0): ?><li data-target="#carousel-example-generic" data-slide-to="<?php echo ($key); ?>" class="active"></li>
                <?php else: ?>
                  <li data-target="#carousel-example-generic" data-slide-to="<?php echo ($key); ?>"></li><?php endif; endforeach; endif; ?>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" role="listbox">
              <?php if(is_array($scroll_production)): foreach($scroll_production as $key=>$data): if($key == 0): ?><div class="item active">
                    <img src="/taobaoke<?php echo ($data["pic_adr"]); ?>" style="width:100%;padding:0px;"/>
                  </div>
                <?php else: ?>
                  <div class="item">
                    <img src="/taobaoke<?php echo ($data["pic_adr"]); ?>" style="width:100%;padding:0px;"/>
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
        <div class="col-md-1">
        </div>
      </div>
    </div>

    <div class="container1" style="padding-top:10px;">
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
                <?php if(is_array($production)): foreach($production as $key=>$data): ?><div class="col-md-4">
                <a class="ef" href="<?php echo ($data["url"]); ?>"> <div class="J_super_item item-mod  super-item-start"><img style="display: block;" class="img lazy" alt="<?php echo ($data["name"]); ?>" src="<?php echo ($data["cover"]); ?>"><div class="J_item_notice msg-soon"></div><h4 class="title"><?php echo ($data["name"]); ?></h4><div class="money desc"><p class="price">                        ¥<strong><?php echo ($data["price_now"]); ?></strong><del>¥<?php echo ($data["price_original"]); ?></del></p><p class="fl clearfix"><strong>-<?php echo ($data["deduction"]); ?></strong><i class="i-gmhf">购买后返<span><?php echo ($data["rebate"]); ?>%</span></i></p></div><a class="mod-btn J_item_link J_item_btn ht J_nodelog" href="javascript:void(0);" data-href="http://fun.51fanli.com/goshop/go?id=712&amp;go=http%3A%2F%2Fdetail.tmall.com%2Fitem.htm%3Fid%3D520670825497&amp;pid=520670825497&amp;lc=shouye_brand" target="_blank">马上抢</a></div>
                </a>
                </div><?php endforeach; endif; ?>
                
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
  var totalPage = <?php echo ($perPage); ?>;
  var totalRecords = <?php echo ($count); ?>;
  var pageNo = getParameter('p');
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
    hrefFormer : 'Womancloth',
    //链接尾部
    hrefLatter : '.html',
    getLink : function(n){
      return this.hrefFormer + this.hrefLatter + "?p="+n +"&classify=<?php echo ($classify_id); ?>";
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

  <div class="container2" style="margin-top:10px;">
    <div class="row">
      <div class="col-md-1">
      </div>
      <div class="col-md-10">
        <div class="row">
          <div class="footer_server_list">
          <dl>
              <dt>购物指南</dt>
                <dd>
                 <a href="http://fanxian.egou.com/memberRegister.do" target="_blank">免费注册</a>
                 <a href="http://fanxian.egou.com/help/shang_yi.html" target="_blank">返利指导</a>
                 <a href="http://fanxian.egou.com/help/nafanxian.html#fx22" target="_blank">提现指导</a>
                </dd>
            </dl>
          <dl>
              <dt>常用服务</dt>
                <dd>
                 <a href="http://fanxian.egou.com/myegoutraceorder.do" target="_blank">跟单查询</a>
                 <a href="http://fanxian.egou.com/help/" target="_blank">网站帮助</a>
                 <a href="http://bbs.egou.com/forum-16-1.html" target="_blank">建议疑问</a>
                </dd>
            </dl>
          <dl>
              <dt>商家服务</dt>
                <dd>
                 <a href="http://zhaoshang.egou.com/temai/" target="_blank">商家入驻</a>
                 <a href="http://fanxian.egou.com/help/advertisement.html" target="_blank">广告合作</a>
                 <a href="http://fanxian.egou.com/help/links.html" target="_blank">友情链接</a>
                </dd>
            </dl>
          <dl>
              <dt>关于易购</dt>
                <dd>
                 <a href="http://fanxian.egou.com/help/aboutegou.html" target="_blank">了解易购</a>
                 <a href="http://fanxian.egou.com/help/zhaopin.html" target="_blank">加入易购</a>
                 <a href="http://fanxian.egou.com/help/contactus.html" target="_blank">联系我们</a>
                </dd>
            </dl>
          <dl class="two">
              <dt>关注我们</dt>
                <dd>
                 <a href="http://weibo.com/wwwegoucom/home" target="_blank">新浪微博</a>
                 <a href="http://user.qzone.qq.com/1494014167/2" target="_blank">QQ空间</a>
                 <a href="javascript:alert('请扫描下方的二维码，谢谢！');">官方微信</a>
                </dd>
            </dl>
            <dl class="last">
              <dd><p class="font16">400-0060-666</p><p class="date">周一至周日 09:00-18:00<br>（仅收市话费）</p><p class="online"><a href="http://fanxian.egou.com/kefu.htm" target="_blank"></a></p></dd>
            </dl>
        </div>
        </div>
      </div>
      <div class="col-md-1">
      </div>
    </div>
  </div>
  
  <footer>
    <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
        <div class="middle">
          <a href="#">条款与细则</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#">隐私政策</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><?php echo ($beian); ?></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="#"><?php echo ($banquan); ?></a>
        </div>
      </div>
      <div class="col-md-3">
      </div>
    </div>
  </footer>


  </body>
</html>