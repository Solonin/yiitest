<?php

use yii\db\Migration;

/**
 * Handles the creation of table `book`.
 */
class m180921_192657_create_book_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('book', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
            'author_id' =>$this->integer(),
            'year' => $this->date(),
            'pages' => $this->integer()
        ]);
        $this->batchInsert('author', ['id', 'name'], [
            [1, 'Авадяева Елена'],
            [2, 'Барто Агния'],
            [3, 'Головачев Василий']
            ]);
        $this->batchInsert('book', ['id', 'title', 'author_id', 'year', 'pages'], [
            [1, '100 великих казней', 1, '2004-01-01', 260],
            [2, '100 великих мореплавателей', 1,'2004-01-01', 229],
            [3, 'Алёша Птицын вырабатывает характер', 2, null, 15],
            [4, 'Бич времен', 3, '2002-01-01', 183],
            [5, 'Излом зла', 3, '2003-01-01', 179]
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('book');
    }
}
