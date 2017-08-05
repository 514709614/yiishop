<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_intro`.
 */
class m170722_024039_create_goods_intro_table extends Migration
{
    /**
     * @inheritdoc
     * goods_intro ��Ʒ�����

    �ֶ���	����	ע��
    goods_id	int	��Ʒid
    content	text	��Ʒ����
    goods_gallery ��ƷͼƬ��
     */
    public function up()
    {
        $this->createTable('goods_intro', [
            'goods_id'=>$this->integer()->comment('��Ʒid'),
           'content'=>$this->text()->comment('��Ʒ����'),
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
