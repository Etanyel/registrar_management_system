<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use CodeIgniter\Database\RawSql;

class ActivityLogs extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type"=> "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment"=> true,
            ],
            "user_id" => [
                "type" => "INT",
                "constraint"=> 11,
                "unsigned" => true,
                "null" => false,
            ],
            "action" => [
                "type" => "VARCHAR",
                "constraint" => 255,
                "null" => false,
            ],
            "user_agent" => [
                "type" => 'VARCHAR',
                'constraint'=> 255,
                "null" => false,
            ],
            "ip_address" => [
                "type" => "VARCHAR",
                "constraint" => 15,
                "null"=> false,
            ],
            "created_at" => [
                "type" => "DATETIME",
                "null"=> false,
                "default" => new RawSql("CURRENT_TIMESTAMP")
            ]
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('activity_logs');
    }

    public function down()
    {
        $this->forge->dropTable('activity_logs');
    }
}
