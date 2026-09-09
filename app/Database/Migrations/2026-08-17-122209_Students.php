<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Students extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id"=> [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            "student_id" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => false,
            ],
            "firstname" => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null' => false
            ],
            "lastname" => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null'=> false
            ],
            "middlename" => [
                'type' => 'VARCHAR',
                'constraint' => 150,
                'null'=> true,
                'default' => '',
            ],
            "suffix" => [
                'type' => 'VARCHAR',
                'constraint' => 10,
                'null'=> true,
                'default' => ''
            ],
            "sex" => [
                "type"=> 'VARCHAR',
                'constraint' => 6,
                'null'=> false,
            ],
            "birthdate" => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            "email" => [
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => true, 
            ],
            "contact_no" => [
                'type' => 'VARCHAR',
                'constraint' => 11,
                'null'=> true,
            ],
            "contact_person" => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
            "address" => [
                "type" => "TEXT",
                "null" => false,
            ],
            "course" => [
                'type' => 'INT',
                'constraint'=> 2,
                'null' => false,
            ],
            "photo" => [
                'type' => 'TEXT',
                'null' => true
            ],
            'status' => [
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null'=> false,
                'default' => 'new'
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],
            "updated_at" => [
                'type' => 'DATETIME',
                'null'=> true,
            ],
            "updated_by" => [
                'type' => 'INT',
                'constraint' => 11,
                'null'=> true,
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('students');
    }

    public function down()
    {
        $this->forge->dropTable('students');
    }
}
