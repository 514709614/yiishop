<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/base.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/global.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/header.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/login.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/footer.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/address.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/home.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/index.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/bottomnav.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/footer.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/list.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/goods.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/common.css" type="text/css">
    <link rel="stylesheet" href="<?=Yii::getAlias('@web').'/'?>style/cart.css" type="text/css">
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/jquery-1.8.3.min.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/cart1.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/cart22.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/header.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/home.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/index.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/list.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/jqzoom-core.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/goods.js"></script>
    <script type="text/javascript" src="<?=Yii::getAlias('@web').'/'?>js/address.js"></script>
    <script type="text/javascript">
        $(function(){
            $('.jqzoom').jqzoom({
                zoomType: 'standard',
                lens:true,
                preloadImages: false,
                alwaysOn:false,
                title:false,
                zoomWidth:400,
                zoomHeight:400
            });
        })
    </script>
</head>
<body>
<!-- 顶部导航 start -->
<div class="topnav">
    <div class="topnav_bd w990 bc">
        <div class="topnav_left">

        </div>
        <div class="topnav_right fr">
            <ul>
<!--                <li>您好，欢迎来到京西！[<a href="login.html">登录</a>] [<a href="register.html">免费注册</a>] </li>-->
                <?php
                if (Yii::$app->user->getId()){
//                    var_dump(Yii::$app->identity->username);exit;
                    echo '<li>'.Yii::$app->user->getId()."，欢迎来到京西！ </li>";
                }else{
                 echo   "<li>您好，欢迎来到京西！[<a href='login'>登录</a>] [<a href='register.html'>免费注册</a>] </li>";
                }
                ?>
                <li class="line">|</li>
                <li>我的订单</li>
                <li class="line">|</li>
                <li>客户服务</li>

            </ul>
        </div>
    </div>
</div>
<!-- 顶部导航 end -->

<div style="clear:both;"></div>

<!-- 页面头部 start -->
<!--<div class="header w990 bc mt15">-->
<!--    <div class="logo w990">-->
<!--        <h2 class="fl"><a href="index.html"><img src="--><?//=Yii::getAlias('@web').'/'?><!--images/logo.png" alt="京西商城"></a></h2>-->
<!--    </div>-->
<!--</div>-->
<!-- 页面头部 end -->