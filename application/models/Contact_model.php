<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_model extends CI_Model
{
    protected $table = 'contact_messages';

    public function store(array $payload): bool
    {
        $payload['created_at'] = date('Y-m-d H:i:s');
        return $this->db->insert($this->table, $payload);
    }
}
