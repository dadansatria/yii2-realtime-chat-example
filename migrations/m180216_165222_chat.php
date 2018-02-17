<?php

use yii\db\Migration;
use yii\db\Schema;

/**
 * Class m180216_165222_chat
 */
class m180216_165222_chat extends Migration
{
    /**
     * @inheritdoc
     */
/*    public function safeUp()
    {

    }*/

    /**
     * @inheritdoc
     */
/*    public function safeDown()
    {
        echo "m180216_165222_chat cannot be reverted.\n";

        return false;
    }*/

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('chat', [
            'id' => Schema::TYPE_PK,
            'user' => Schema::TYPE_STRING . ' NOT NULL',
            'teks' => Schema::TYPE_TEXT,
            'waktu_dibuat' => Schema::TYPE_DATETIME,
        ]);
    }

    public function down()
    {
        $this->dropTable('chat');
    }
    
}
