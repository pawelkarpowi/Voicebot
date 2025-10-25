<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auctions extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auction_model');
        $this->load->helper(['url', 'form']);
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['auctions'] = $this->Auction_model->all();
        $this->load->view('auctions/index', $data);
    }

    public function create()
    {
        $this->load->view('auctions/create');
    }

    public function store()
    {
        $this->form_validation->set_rules('title', 'Title', 'required|min_length[3]');
        $this->form_validation->set_rules('starting_price', 'Starting Price', 'required|numeric');

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('auctions/create');
            return;
        }

        $data = [
            'title' => $this->input->post('title', TRUE),
            'description' => $this->input->post('description', TRUE),
            'starting_price' => $this->input->post('starting_price', TRUE),
            'status' => 'draft',
        ];

        $id = $this->Auction_model->create($data);
        redirect('auctions/'.$id);
    }

    public function show($id)
    {
        $auction = $this->Auction_model->find((int)$id);
        if (!$auction) {
            show_404();
            return;
        }
        $data['auction'] = $auction;
        $this->load->view('auctions/show', $data);
    }
}
