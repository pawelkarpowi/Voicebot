<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auctions extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Auction_model');
        $this->load->helper(['url']);
        $this->output->set_content_type('application/json');
        $this->authenticate();
    }

    private function authenticate()
    {
        $auth_header = $this->input->get_request_header('Authorization', TRUE);
        if (!$auth_header || stripos($auth_header, 'Bearer ') !== 0) {
            $this->output->set_status_header(401);
            echo json_encode(['error' => 'Unauthorized']);
            exit;
        }
        $token = trim(substr($auth_header, 7));
        $expected = $this->config->item('vapi_token');
        if (!$expected || !hash_equals($expected, $token)) {
            $this->output->set_status_header(403);
            echo json_encode(['error' => 'Forbidden']);
            exit;
        }
    }

    public function index()
    {
        $list = $this->Auction_model->all();
        echo json_encode(['data' => $list]);
    }

    public function show($id)
    {
        $auction = $this->Auction_model->find((int)$id);
        if (!$auction) {
            $this->output->set_status_header(404);
            echo json_encode(['error' => 'Not Found']);
            return;
        }
        echo json_encode(['data' => $auction]);
    }

    public function store()
    {
        $payload = json_decode($this->input->raw_input_stream, true) ?: $this->input->post();
        if (!$payload || empty($payload['title']) || !isset($payload['starting_price'])) {
            $this->output->set_status_header(422);
            echo json_encode(['error' => 'Validation error', 'fields' => ['title','starting_price']]);
            return;
        }
        $data = [
            'title' => (string)$payload['title'],
            'description' => isset($payload['description']) ? (string)$payload['description'] : null,
            'starting_price' => (float)$payload['starting_price'],
            'status' => isset($payload['status']) ? (string)$payload['status'] : 'draft',
        ];
        $id = $this->Auction_model->create($data);
        $created = $this->Auction_model->find($id);
        $this->output->set_status_header(201);
        echo json_encode(['data' => $created]);
    }

    public function update($id)
    {
        $auction = $this->Auction_model->find((int)$id);
        if (!$auction) {
            $this->output->set_status_header(404);
            echo json_encode(['error' => 'Not Found']);
            return;
        }
        $payload = json_decode($this->input->raw_input_stream, true) ?: [];
        $data = [];
        if (isset($payload['title'])) { $data['title'] = (string)$payload['title']; }
        if (array_key_exists('description', $payload)) { $data['description'] = $payload['description'] === null ? null : (string)$payload['description']; }
        if (isset($payload['starting_price'])) { $data['starting_price'] = (float)$payload['starting_price']; }
        if (isset($payload['status'])) { $data['status'] = (string)$payload['status']; }

        if (empty($data)) {
            echo json_encode(['data' => $auction]);
            return;
        }
        $this->Auction_model->update_by_id((int)$id, $data);
        $updated = $this->Auction_model->find((int)$id);
        echo json_encode(['data' => $updated]);
    }

    public function destroy($id)
    {
        $deleted = $this->Auction_model->delete_by_id((int)$id);
        if (!$deleted) {
            $this->output->set_status_header(404);
            echo json_encode(['error' => 'Not Found']);
            return;
        }
        $this->output->set_status_header(204);
    }

    // Single entrypoint for RESTful HTTP verbs
    public function router($id = null)
    {
        $http_method = $this->input->method(TRUE); // GET, POST, PUT, PATCH, DELETE
        switch ($http_method) {
            case 'GET':
                return $id === null ? $this->index() : $this->show((int)$id);
            case 'POST':
                return $this->store();
            case 'PUT':
            case 'PATCH':
                if ($id === null) { $this->output->set_status_header(400); echo json_encode(['error' => 'ID required']); return; }
                return $this->update((int)$id);
            case 'DELETE':
                if ($id === null) { $this->output->set_status_header(400); echo json_encode(['error' => 'ID required']); return; }
                return $this->destroy((int)$id);
            default:
                $this->output->set_status_header(405);
                echo json_encode(['error' => 'Method Not Allowed']);
        }
    }
}
