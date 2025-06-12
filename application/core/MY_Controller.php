<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH . 'third_party/MX/Controller.php';

class MY_Controller extends MX_Controller
{
    protected $json_input = [];
    public $request = [];

    public function __construct()
    {
        parent::__construct();
        // $this->json_input = $this->sanitize($this->get_json_input());
        // $this->request = $this->sanitize(array_merge($_GET, $_POST, $this->json_input));
        $this->json_input = $this->get_json_input();
        $this->request = array_merge($_GET, $_POST, $this->json_input);
    }

    protected function get_json_input()
    {
        $input = file_get_contents('php://input');
        $decoded = json_decode($input, true);
        return (json_last_error() === JSON_ERROR_NONE) ? $decoded : [];
    }

    protected function sanitize($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $val) {
                $data[$key] = $this->sanitize($val);
            }
        } else {
            $data = strip_tags($data);
            $data = htmlspecialchars($data, ENT_QUOTES);
            $data = trim($data);
        }
        return $data;
    }

    protected function response($data, $status = 200)
    {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }
}
