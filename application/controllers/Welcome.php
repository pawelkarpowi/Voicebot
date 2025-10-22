<?php
class Welcome extends CI_Controller
{
    public function index(): void
    {
        $data = [
            'title' => 'Mini CodeIgniter 3',
            'message' => 'Witamy w przykładowej aplikacji inspirowanej CodeIgniterem 3.',
        ];

        $this->load->view('welcome_message', $data);
    }

    public function hello(string $name = 'Gościu'): void
    {
        $data = [
            'title' => 'Mini CodeIgniter 3',
            'message' => 'Cześć ' . htmlspecialchars(ucfirst($name), ENT_QUOTES, 'UTF-8') . '!',
        ];

        $this->load->view('welcome_message', $data);
    }
}
