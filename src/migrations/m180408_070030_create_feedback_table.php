<?php

use yii\db\Migration;

/**
 * Handles the creation of table `feedbacks`.
 */
class m180408_070030_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'company_name' => $this->string(),
            'tel' => $this->string(),
            'email'=>$this->string(100),
            'message'=>'MEDIUMTEXT',
            'created_date' => $this->integer(),
            'status'=>$this->tinyInteger()->defaultValue(0)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
