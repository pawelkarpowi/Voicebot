<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_auctions extends CI_Migration {
    public function up()
    {
        // auctions table
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ],
            'starting_price' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'default' => '0.00'
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['draft','active','ended'],
                'default' => 'draft'
            ],
            'created_at' => [
                'type' => 'DATETIME',
            ],
            'updated_at' => [
                'type' => 'DATETIME',
            ],
        ]);
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('auctions', TRUE);
    }

    public function down()
    {
        $this->dbforge->drop_table('auctions', TRUE);
    }
}
