<?php

use yii\db\Migration;

/**
 * Handles the creation of table `order`.
 */
class m170802_181900_create_order_table extends Migration
{
    /**
     * @inheritdoc
     *             'id' => 'ID',
    'member_id' => '用户ID',
    'name' => '收货人',
    'province' => '省',
    'city' => '市',
    'area' => '县',
    'address' => '详细地址',
    'tel' => '电话号码',
    'delivery_id' => '配送方式id',
    'delivery_name' => '配送方式名称',
    'delivery_price' => '配送方式价格',
    'payment_id' => '支付方式id',
    'payment_name' => '支付方式名称',
    'total' => '订单金额',
    'status' => '订单状态',
    'trade_no' => '第三方支付交易号',
    'create_time' => '创建时间',
     */
    public function up()
    {
        $this->createTable('order', [
            'id' => $this->primaryKey(),
            'member_id' => $this->integer()->notNull()->comment('用户id'),
            'name'=>$this->string(100)->notNull()->comment('收货人'),
            'province'=>$this->string(100)->notNull()->comment('省'),
            'city'=>$this->string(100)->notNull()->comment('市'),
            'area'=>$this->string(100)->notNull()->comment('县'),
            'address'=>$this->string(255)->notNull()->comment('详细地址'),
            'tel'=>$this->char(11)->notNull()->comment('手机号码'),
            'delivery_id'=>$this->smallInteger(1)->comment('配送方式id'),
            'delivery_name'=>$this->string(100)->notNull()->comment('配送方式名称'),
            'delivery_price'=>$this->string(100)->notNull()->comment('配送方式价格'),
            'payment_id'=>$this->string(100)->notNull()->comment('支付方式id'),
            'payment_name'=>$this->string(100)->notNull()->comment('支付方式名称'),
            'total'=>$this->string(100)->notNull()->comment('订单金额'),
            'status'=>$this->string(100)->notNull()->comment('订单状态'),
            'trade_no'=>$this->string(100)->notNull()->comment('第三方支付交易号'),
            'create_time'=>$this->string(100)->notNull()->comment('创建时间'),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('order');
    }
}
