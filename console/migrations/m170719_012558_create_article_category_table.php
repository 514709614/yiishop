<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_category`.
 */
//yii migrate/create create_menu_table
class m170719_012558_create_article_category_table extends Migration
{
    /**
     * @inheritdoc
     *
     */
    public function up()
    {
        $this->createTable('article_category', [
            'id' => $this->primaryKey(),
            'name'=>$this->string(50)->comment('名称'),
            'intro'=>$this->text()->comment('简介'),
            'sort'=>$this->integer()->comment('排序'),
            'status'=>$this->smallInteger(2)->comment('状态'),
        ]);
    }
/*article_category 文章

字段名	类型	注释
id	primaryKey
name	varchar(50)	名称
intro	text	简介
sort	int(11)	排序
status	int(2)	状态(-1删除 0隐藏 1正常)*/

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_category');
    }
}
