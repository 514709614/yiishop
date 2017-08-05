<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_intro`.
 */
class m170722_024039_create_goods_intro_table extends Migration
{
    /**
     * @inheritdoc
     * goods_intro 商品详情表

    字段名	类型	注释
    goods_id	int	商品id
    content	text	商品描述
    goods_gallery 商品图片表
     */
    public function up()
    {
        $this->createTable('goods_intro', [
            'goods_id'=>$this->integer()->comment('商品id'),
           'content'=>$this->text()->comment('商品描述'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_intro');
    }
}
