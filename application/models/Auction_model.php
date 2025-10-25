<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auction_model extends CI_Model {
    protected $table = 'auctions';

    public function create(array $data) {
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function all() {
        return $this->db->order_by('created_at', 'DESC')->get($this->table)->result_array();
    }

    public function find($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row_array();
    }

    public function update_by_id($id, array $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        $this->db->where('id', $id)->update($this->table, $data);
        return $this->db->affected_rows() > 0;
    }

    public function delete_by_id($id) {
        $this->db->delete($this->table, ['id' => $id]);
        return $this->db->affected_rows() > 0;
    }
}
