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
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'company_name' => $this->string(),
            'tel' => $this->string(),
            'email'=>$this->string(100),
            'message'=>'MEDIUMTEXT',
            'created_date' => $this->integer(),
            'status'=>$this->tinyInteger()->defaultValue(0)
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%feedback}}');
    }
}
