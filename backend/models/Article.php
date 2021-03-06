<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $name
 * @property string $intro
 * @property integer $article_category_id
 * @property integer $sort
 * @property integer $status
 * @property integer $create_time
 */
class Article extends \yii\db\ActiveRecord
{

    public function getArticleCategory(){


        return $this->hasOne(ArticleCategory::className(), ['id' => 'article_category_id']);


    }
    public function getArticleDetail(){


        return $this->hasOne(ArticleDetail::className(), ['article_id' => 'id']);


    }



    /**
     * @inheritdoc
     */ public static $status_options = [
    -1=>'删除', 0=>'隐藏', 1=>'正常'
];
    public static function tableName()
    {
        return 'article';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['intro'], 'string'],
            [['article_category_id', 'sort', 'status', 'create_time'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => '名称',
            'intro' => '简介',
            'article_category_id' => '文章分类id',
            'sort' => '排序',
            'status' => '状态',
            'create_time' => '创建时间',
        ];
    }
    public static function getArticleCategoryOptions(){

        return ArrayHelper::map(ArticleCategory::find()->all(),'id','name');
    }
}
