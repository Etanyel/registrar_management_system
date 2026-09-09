<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class Enrollments extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],

            "student_id" => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            "course_id" => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],

            "section" => [
                'type' => 'VARCHAR',
                'constraint' => 90,
                'null' => false,
                'default' => 'BLOCK-A'
            ],

            "student_type" => [
                'type' => 'ENUM',
                'constraint' => ['new', 'transferee', 'returning'],
                'default' => 'new',
            ],

            "year_level" => [
                'type' => 'TINYINT',
                'constraint' => 1,
                'unsigned' => true,
            ],

            "academic_year" => [
                'type' => 'VARCHAR',
                'constraint' => 9,
            ],

            "semester" => [
                'type' => 'ENUM',
                'constraint' => ['1st', '2nd'],
            ],

            "created_at" => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => new RawSql('CURRENT_TIMESTAMP')
            ],

            "enrolled_by" => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],

        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('enrollments');
    }

    public function down()
    {
        $this->forge->dropTable('enrollments');
    }
}
