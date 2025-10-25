<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('Contact_model');
    }

    public function index()
    {
        $data['title'] = 'Kontakt';

        $this->form_validation->set_rules('name', 'Imię', 'required|min_length[2]');
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('message', 'Wiadomość', 'required|min_length[10]');

        if ($this->form_validation->run() === TRUE) {
            $payload = array(
                'name' => $this->input->post('name'),
                'email' => $this->input->post('email'),
                'message' => $this->input->post('message'),
            );
            $this->Contact_model->store($payload);
            $this->session->set_flashdata('success', 'Dziękujemy za kontakt!');
            redirect('contact');
        }

        $this->load->view('templates/header', $data);
        $this->load->view('contact/index');
        $this->load->view('templates/footer');
    }
}
