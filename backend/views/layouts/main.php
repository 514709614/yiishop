<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    //导航
    NavBar::begin([
        'brandLabel' => '后台管理',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => '首页', 'url' => ['goods/index']],
    ];
    $menus = \backend\models\Menu::findAll(['parent_id'=>0]);
    foreach ($menus as $menu){
        $item = ['label'=>$menu->label,'items'=>[]];
        foreach ($menu->children as $child){
            //根据用户权限判断，该菜单是否显示
            if(Yii::$app->user->can($child->url)){
                $item['items'][] = ['label'=>$child->label,'url'=>[$child->url]];
            }

        }
        //如果该一级菜单没有子菜单，就不显示
        if(!empty($item['items'])){
            $menuItems[] = $item;
        }

    }
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => '登录', 'url' => ['user/login']];
    } else {
        $menuItems[] = ['label' => '注销('.Yii::$app->user->identity->username.')', 'url' => ['admin/logout']];



    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    //Breadcrumbs
    ?>

    <div class="container">
        <?= \yii\widgets\Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= \common\widgets\Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>