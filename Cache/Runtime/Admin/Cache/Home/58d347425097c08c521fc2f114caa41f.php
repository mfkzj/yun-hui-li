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

    <!-- bootstrapValidator JS -->
    <!--
    <script type="text/javascript" src="/taobaoke/Public/Js/bootstrapValidator/dist/js/bootstrapValidator.js"></script>
    <link rel="stylesheet" href="/taobaoke/Public/Css/bootstrapValidator/bootstrapValidator.css"/>-->

    <!-- Font-awesome core CSS -->
    <link href="/taobaoke/Public/Admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <link href="/taobaoke/Public/Admin/Css/Homepage.css" rel="stylesheet">
    
    <style type="text/css">
        code{
            font-size: 110%;
        }
    </style>

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
                修改作品展示图片
            </h1>
        </div>
    </div>
    <!-- 导航 -->
    <div class="row">
        <div class="col-md-12">
            <ol class="breadcrumb">
              <li><a href="<?php echo U('Homepage/index');?>">首页模块</a></li>
              <li class="active">修改男士服装封面图片</li>
            </ol>
        </div>
    </div>
    <form class="form-signin" enctype="multipart/form-data" role="form" action="<?php echo U('Homepage/alter_man_cloth_picture_handle');?>" method='post' id="form">
    <!-- 主体 -->
    <div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
              <tbody>
                <tr>
                  <td>当前图片:</td>
                  <td><a href="#" onclick="callmyModal_1('/taobaoke<?php echo ($picture["pic_adr"]); ?>');"><img src="/taobaoke<?php echo ($picture["pic_adr"]); ?>" class="img-thumbnail" style="height:200px;width:200px;float:left;"/></a></td>
                </tr>
                <tr>
                  <td>上传新的图片:</td>
                  <td><input name="file" type="file" class="form-control"></td>
                </tr>
                <tr>
                    <td>上传预览:</td>
                    <td id="imput"><p id="altput" >上传后才可预览，请选择文件。</p></td>
                </tr>
              </tbody>
            </table>
            <input id="img" name="img" value="0" type="hidden" >
            <input name="id" value="<?php echo ($picture["id"]); ?>" type="hidden" >
            <div style="float:right;"><button type="submit" class="btn btn-primary">提 交</button></div>
        </div>
    </div>
    </form>
    <!-- 说明 -->
    <div class="row">
        <div class="col-md-12">
            <div class="bs-callout bs-callout-info" id="callout-alerts-dismiss-plugin">
                <h4>说明</h4>
                <p>修改作品展示图片</p>
            </div>
        </div>
    </div>
</div>
</body>
</html>