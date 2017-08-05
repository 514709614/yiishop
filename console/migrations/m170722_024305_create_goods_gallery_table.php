<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_gallery`.
 */
class m170722_024305_create_goods_gallery_table extends Migration
{
    /**
     * @inheritdoc
     * id	primaryKey
    goods_id	int	��Ʒid
    path	varchar(255)	ͼƬ��ַ
     */
    public function up()
    {
        $this->createTable('goods_gallery', [
            'id' => $this->primaryKey(),
            'goods_id'=>$this->integer()->comment('��Ʒid'),
            'path'=>$this->string()->comment('ͼƬ��ַ'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_gallery');
    }
}
