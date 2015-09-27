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

        function callmyModalText(id){
            $.getJSON("<?php echo U('Strength/get_achievement_status');?>?id="+id, function (data, status, xhr) {
                window.top.window.myModalText(data);
            });
        }
    </script>
    
</head>
<body>

<div id="page-wrapper" >
    <div class="row">
        <div class="col-md-12">        
            <h1 class="page-header">
                男士服装模块
            </h1>
        </div>
    </div>
    <!-- 明星师资 -->
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="icon-group"></i>
                    分类
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8" style="padding-top:8px;">
                            <p>商品分类，并非店铺分类。</p>
                        </div>
                        <div class="col-md-4">
                            <div style="float:right;"><a href="<?php echo U('Manclothsort/add_classification');?>" style="width:100px;"type="button" class="btn btn-primary">添加分类</a></div>
                        </div>
                    </div>
                </div>  
                <table class="table table-hover" style="border-bottom:1px solid #DDD;">
                    <thead>
                        <tr>
                          <th class="col-md-3"><div align="center">序号</div></th>
                          <th class="col-md-3"><div align="center">名称</div></th>
                          <th class="col-md-3"><div align="center">排序</div></th>
                          <th class="col-md-3"><div align="center">操作</div></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if(is_array($classification)): foreach($classification as $key=>$data): ?><tr>
                            <th scope="row">
                                <div align="center">
                                    <div style="padding-top:15px;"><?php echo ($key+1); ?></div>
                                </div>
                            </th>
                            <td>
                                <div align="center">
                                    <div style="padding-top:15px;"><?php echo ($data["name"]); ?></div>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <div style="width:200px;padding-top:6px;">
                                        <?php if($key == 0): ?><a href="<?php echo U('Manclothsort/sort_classification_handle');?>?id=<?php echo ($data["id"]); ?>&type=down"class="btn btn-default"><i class="icon-angle-down"></i></a>
                                        <?php elseif($key == count($classification)-1): ?>
                                            <a href="<?php echo U('Manclothsort/sort_classification_handle');?>?id=<?php echo ($data["id"]); ?>&type=up"class="btn btn-default"><i class="icon-angle-up"></i></a>
                                        <?php else: ?>
                                            <a href="<?php echo U('Manclothsort/sort_classification_handle');?>?id=<?php echo ($data["id"]); ?>&type=up"class="btn btn-default"><i class="icon-angle-up"></i></a>
                                            <a href="<?php echo U('Manclothsort/sort_classification_handle');?>?id=<?php echo ($data["id"]); ?>&type=down"class="btn btn-default"><i class="icon-angle-down"></i></a><?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <div style="width:200px;padding-top:10px;">
                                        <a href="<?php echo U('Manclothsort/alter_classification');?>?id=<?php echo ($data["id"]); ?>" type="button" class="btn btn-success">修 改</a>
                                        <a href="<?php echo U('Manclothsort/delete_classification_handle');?>?id=<?php echo ($data["id"]); ?>" type="button" class="btn btn-danger">删 除</a>
                                    </div>
                                </div>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>

</body>
</html>