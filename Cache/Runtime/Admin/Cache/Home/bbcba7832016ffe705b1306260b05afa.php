<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <title></title>
    <link rel="icon" href="/taobaoke/Public/Uploads/img/logo.png">
    <!-- Bootstrap core CSS -->
    <link href="/taobaoke/Public/Admin/Css/bootstrap.min.css" rel="stylesheet">
    <script src="/taobaoke/Public/Admin/Js/jquery.min.js"></script>
    <script src="/taobaoke/Public/Admin/Js/bootstrap.min.js"></script>
    <script src="/taobaoke/Public/Admin/Js/docs.min.js"></script>
    <script src="/taobaoke/Public/Admin/Js/ie10-viewport-bug-workaround.js"></script>

    <!-- Font-awesome core CSS -->
    <link href="/taobaoke/Public/Admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/taobaoke/Public/Admin/Css/Webinfo.css" rel="stylesheet">

    <script type="text/javascript">  
        $(document).ready(function() 
        {  
            window.top.window.iFrameHeight();
            window.top.window.callApplicationCount();
        });

        function callmyModal_1(u){
            window.top.window.myModalImage(u);
        }
    </script>
    
</head>
<body>

<div id="page-wrapper" >
    <div class="row">
        <div class="col-md-12">        
            <h1 class="page-header">
                首页模块
            </h1>
        </div>
    </div>
    <!-- 轮换 -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-double-angle-left"></i>
                    幻灯片
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8" style="padding-top:8px;">
                            <p>幻灯片可以添加无数张，但是打开首页加载速度会受影响，建议3张以内。</p>
                        </div>
                        <div class="col-md-4">
                            <div style="float:right;"><a href="<?php echo U('Homepage/add');?>" style="width:100px;" type="button" class="btn btn-primary">添 加</a></div>
                        </div>
                    </div>
                </div>  
                <table class="table table-hover">
                    <thead>
                        <tr>
                          <th class="col-md-2"><div align="center">序号</div></th>
                          <th class="col-md-3"><div align="center">图片</div></th>
                          <th class="col-md-3"><div align="center">排序</div></th>
                          <th class="col-md-2"><div align="center">操作</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($scroll)): foreach($scroll as $key=>$data): ?><tr>
                            <th scope="row">
                                <div align="center">
                                    <div style="padding-top:15px;"><?php echo ($key+1); ?></div>
                                </div>
                            </th>
                            <td>
                                <div align="center">
                                    <a href="#" onclick="callmyModal_1('/taobaoke<?php echo ($data["pic_adr"]); ?>');">
                                        <img src="/taobaoke<?php echo ($data["pic_adr"]); ?>" class="img-rounded" style="height:50px;">
                                    </a>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <div style="width:200px;padding-top:6px;">
                                        <?php if($key == 0): ?><a href="<?php echo U('Homepage/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=down" class="btn btn-default"><i class="icon-angle-down"></i></a>
                                        <?php elseif($key == count($scroll)-1): ?>
                                            <a href="<?php echo U('Homepage/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=up" class="btn btn-default"><i class="icon-angle-up"></i></a>
                                        <?php else: ?>
                                            <a href="<?php echo U('Homepage/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=up" class="btn btn-default"><i class="icon-angle-up"></i></a>
                                            <a href="<?php echo U('Homepage/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=down" class="btn btn-default"><i class="icon-angle-down"></i></a><?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <div style="width:200px;padding-top:10px;">
                                        <a href="<?php echo U('Homepage/alter');?>?id=<?php echo ($data["id"]); ?>" class="btn btn-success">修 改</a>
                                        <a href="<?php echo U('Homepage/delete_handle');?>?id=<?php echo ($data["id"]); ?>" type="button" class="btn btn-danger">删 除</a>
                                    </div>
                                </div>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>       
            </div>
        </div>
    </div>
    <!-- 男士服装封面 -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-star-empty"></i>
                    男士服装封面
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="/taobaoke<?php echo ($man_cloth_picture); ?>" class="img-rounded" style="width:100%;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo U('Homepage/alter_man_cloth_picture');?>" type="button" style="margin-top:8px;width:100%;" class="btn btn-success">修 改 图 片</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 女士服装封面 -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-star-empty"></i>
                    女士服装封面
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="/taobaoke<?php echo ($woman_cloth_picture); ?>" class="img-rounded" style="width:100%;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo U('Homepage/alter_woman_cloth_picture');?>" type="button" style="margin-top:8px;width:100%;" class="btn btn-success">修 改 图 片</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- 鞋类封面 -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-star-empty"></i>
                    鞋类封面
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <img src="/taobaoke<?php echo ($shoe_picture); ?>" class="img-rounded" style="width:100%;">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="<?php echo U('Homepage/alter_shoe_picture');?>" type="button" style="margin-top:8px;width:100%;" class="btn btn-success">修 改 图 片</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>