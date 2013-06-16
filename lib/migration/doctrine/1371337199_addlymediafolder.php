<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addlymediafolder extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('ly_media_folder', array(
             'id' => 
             array(
              'type' => 'integer',
              'primary' => true,
              'autoincrement' => true,
              'length' => 4,
             ),
             'name' => 
             array(
              'type' => 'string',
              'notnull' => true,
              'length' => 255,
             ),
             'title' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'description' => 
             array(
              'type' => 'clob',
              'length' => NULL,
             ),
             'relative_path' => 
             array(
              'type' => 'string',
              'length' => 255,
             ),
             'created_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'updated_at' => 
             array(
              'notnull' => true,
              'type' => 'timestamp',
              'length' => 25,
             ),
             'lft' => 
             array(
              'type' => 'integer',
              'length' => 4,
             ),
             'rgt' => 
             array(
              'type' => 'integer',
              'length' => 4,
             ),
             'level' => 
             array(
              'type' => 'integer',
              'length' => 2,
             ),
             ), array(
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             ));
    }

    public function down()
    {
        $this->dropTable('ly_media_folder');
    }
}