<?php

use yii\db\Migration;

/**
 * Handles the creation of table `goods_category`.
 */
class m170721_073313_create_goods_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('goods_category', [
            'id' => $this->primaryKey(),
            'tree'=>$this->integer(),
//lft	int()	��ֵ
            'lft'=>$this->integer(),
//rgt	int()	��ֵ
            'rgt'=>$this->integer(),
//depth	int()	�㼶
            'depth'=>$this->integer(),
//name	varchar(50)	����
            'name'=>$this->string(50)->comment('����'),
//parent_id	int()	�ϼ�����id
            'parent_id'=>$this->integer()->comment('�ϼ�����id'),
//intro	text()	���
            'intro'=>$this->text()->comment('���')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('goods_category');
    }
}
