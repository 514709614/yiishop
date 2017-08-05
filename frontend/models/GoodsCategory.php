<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "goods_category".
 *
 * @property integer $id
 * @property integer $tree
 * @property integer $lft
 * @property integer $rgt
 * @property integer $depth
 * @property string $name
 * @property integer $parent_id
 * @property string $intro
 */
class GoodsCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goods_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tree', 'lft', 'rgt', 'depth', 'parent_id'], 'integer'],
            [['intro'], 'string'],
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
            'tree' => '树ID',
            'lft' => '左值',
            'rgt' => '右值',
            'depth' => '层级',
            'name' => '名称',
            'parent_id' => '上级分类',
            'intro' => '简介',
        ];
    }
    //二级分类
    public static function getGoodsCategory($id,$key){
       $parent_id= GoodsCategory::findOne(['parent_id'=>$id]);

       if ($parent_id && $parent_id->depth == $key){

            return $parent_id;
       }else{
           return false;
       }
    }
    //顶级分类
    public static function getCategory($parent_id){
        $models=GoodsCategory::findAll(['parent_id'=>$parent_id]);
        foreach ($models as $model){
            $tmp[$model->name]=$model->name;
        }
        return $tmp;
    }
//    public static function getParentId(){
//
//    }
}
