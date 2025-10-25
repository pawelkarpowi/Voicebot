<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pages extends CI_Controller
{
    public function about()
    {
        $data['title'] = 'O projekcie';
        $data['content'] = 'Przykładowa aplikacja CodeIgniter 3 gotowa do dalszej rozbudowy.';

        $this->load->view('templates/header', $data);
        $this->load->view('pages/about', $data);
        $this->load->view('templates/footer');
    }
}
