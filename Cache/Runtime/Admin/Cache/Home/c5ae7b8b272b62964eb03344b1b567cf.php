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
        var url;
        $(document).ready(function(){
            $("input[type=file]").change(function(e){
                var fileInput = $(this)[0];
                var file = fileInput.files[0];
                if(file){
                    var reader = new FileReader();
                    reader.onload=function(e){
                        $("#img").attr("value","1");
                        url = reader.result;
                        if($("#imageInput").length > 0){
                            $("#imageInput").attr("src",reader.result);
                        }else{
                            $("#altput").hide();
                            $("#imput").append('<a href="#" onclick="callmyModal();"><img id="imageInput" class="img-thumbnail" src="'+reader.result+'" style="height:200px;width:200px;float:left;"/></a>');
                            window.parent.window.iFrameHeight();
                        }    

                    }
                    reader.readAsDataURL(file);
                }
            });
        });

        function callmyModal(){
            window.top.window.myModalImage(url);
        }

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
                添加商品分类
            </h1>
        </div>
    </div>
    <!-- 导航 -->
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo U('Shoe/index');?>">鞋类模块</a></li>
              <li class="active">添加分类</li>
            </ol>
        </div>
    </div>
    <form class="form-signin" enctype="multipart/form-data" role="form" action="<?php echo U('Shoe/add_classification_handle');?>" method='post' id="form">
    <!-- 主体 -->
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>名称:</td>
                  <td><input name="name" type="text" class="form-control" style="width:320px;" value="" placeholder="请输入名称"></td>
                </tr>
                <tr>
                  <td>是否置顶：</td>
                  <td><input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>是&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="0">否</td>
                </tr>
              </tbody>
            </table>
            <input name="id" value="" type="hidden" >
            <div style="float:right;"><button type="submit" class="btn btn-primary">提 交</button></div>
        </div>
    </div>
    </form>
    <!-- 说明 -->
    <div class="row">
        <div class="col-md-12">
            <div class="bs-callout bs-callout-info" id="callout-alerts-dismiss-plugin">
                <h4>说明</h4>
                <p>添加商品分类。</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>