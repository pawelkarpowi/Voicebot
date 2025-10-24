<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('url'));
    }

    public function index()
    {
        $data['title'] = 'Strona główna';
        $data['features'] = array(
            'Szybkie prototypowanie aplikacji głosowych',
            'Integracja z bazą danych MySQL',
            'Obsługa formularza kontaktowego'
        );

        $this->load->view('templates/header', $data);
        $this->load->view('welcome_message', $data);
        $this->load->view('templates/footer');
    }
}
