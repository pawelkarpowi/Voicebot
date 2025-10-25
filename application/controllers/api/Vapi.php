<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vapi extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(['url', 'vapi']);
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

    public function minutes()
    {
        $payload = json_decode($this->input->raw_input_stream, true);
        if (!is_array($payload)) {
            $payload = $this->input->post() ?: [];
        }
        $rounding = isset($payload['rounding']) ? (string)$payload['rounding'] : ($this->input->get('rounding') ?: 'ceil_each');

        // Accept flexible inputs: durations, items, calls
        $items = [];
        if (isset($payload['durations']) && is_array($payload['durations'])) {
            $items = $payload['durations'];
        } elseif (isset($payload['items']) && is_array($payload['items'])) {
            $items = $payload['items'];
        } elseif (isset($payload['calls']) && is_array($payload['calls'])) {
            $items = $payload['calls'];
        } else {
            // Fallback: if payload itself looks like an array of items
            if (array_values($payload) === $payload) {
                $items = $payload;
            }
        }

        if (!is_array($items) || empty($items)) {
            $this->output->set_status_header(422);
            echo json_encode(['error' => 'Validation error', 'fields' => ['durations|items|calls']]);
            return;
        }

        $result = vapi_sum_minutes($items, $rounding);
        echo json_encode(['data' => $result]);
    }
}
