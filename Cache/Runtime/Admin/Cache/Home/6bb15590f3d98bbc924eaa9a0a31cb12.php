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

    <link href="/taobaoke/Public/Admin/Css/Homepage.css" rel="stylesheet">

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
            $.getJSON("<?php echo U('Shoeshop/get_url');?>?id="+id, function (data, status, xhr) {
                window.top.window.myModalUrl(data);
            });
        }
    </script>
    
</head>
<body>

<div id="page-wrapper" >
    <div class="row">
        <div class="col-md-12">        
            <h1 class="page-header">
                鞋类-店铺推荐
            </h1>
        </div>
    </div>
    <!-- 店铺推荐 -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12" style="margin-bottom:10px;">
                    <div style="float:left;margin-top:-5px;">
                        <h4>总共<?php echo ($count); ?>个推荐</h4>
                    </div>
                    <div style="float:right;"><a href="<?php echo U('Shoeshop/add');?>" style="width:150px;"type="button" class="btn btn-primary">新增店铺推荐</a></div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                  <th class="col-md-1"><div align="center">序号</div></th>
                                  <th class="col-md-3"><div align="center">店名</div></th>
                                  <th class="col-md-2"><div align="center">图片</div></th>
                                  <th class="col-md-2"><div align="center">链接</div></th>
                                  <th class="col-md-2"><div align="center">排序</div></th>
                                  <th class="col-md-2"><div align="center">操作</div></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(is_array($shop)): foreach($shop as $key=>$data): ?><tr>
                                    <th scope="row">
                                        <div align="center" style="padding-top:15px;">
                                            <?php echo ($key+1); ?>
                                        </div>
                                    </th>
                                    <td>
                                        <div align="center" style="padding-top:15px;">
                                            <?php echo ($data["name"]); ?>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center">
                                            <a href="#" onclick="callmyModal_1('/taobaoke<?php echo ($data["pic_adr"]); ?>')">
                                                <img src="/taobaoke<?php echo ($data["pic_adr"]); ?>" class="img-rounded" style="height:50px;">
                                            </a>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center" style="padding-top:6px;">
                                            <a type="button" class="btn btn-default" onclick="callmyModalText('<?php echo ($data["id"]); ?>')">点击查看</a>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center">
                                            <div style="width:200px;padding-top:6px;">
                                                <?php if($key == 0): ?><a href="<?php echo U('Shoeshop/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=down"class="btn btn-default"><i class="icon-angle-down"></i></a>
                                                <?php elseif($key == count($shop)-1): ?>
                                                    <a href="<?php echo U('Shoeshop/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=up"class="btn btn-default"><i class="icon-angle-up"></i></a>
                                                <?php else: ?>
                                                    <a href="<?php echo U('Shoeshop/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=up"class="btn btn-default"><i class="icon-angle-up"></i></a>
                                                    <a href="<?php echo U('Shoeshop/sort_handle');?>?id=<?php echo ($data["id"]); ?>&type=down"class="btn btn-default"><i class="icon-angle-down"></i></a><?php endif; ?>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div align="center">
                                            <div style="width:200px;padding-top:6px;">
                                                <a type="button" class="btn btn-success" href="<?php echo U('Shoeshop/alter');?>?id=<?php echo ($data["id"]); ?>">修 改</a>
                                                <a type="button" class="btn btn-danger" href="<?php echo U('Shoeshop/delete_handle');?>?id=<?php echo ($data["id"]); ?>">删 除</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr><?php endforeach; endif; ?>
                            </tbody>
                        </table>       
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div style="float:right;">
                    <nav>
                      <ul class="pagination">
                        <?php echo ($page); ?>
                     </ul>
                    </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>