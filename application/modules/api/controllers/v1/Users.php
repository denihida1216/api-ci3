<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        // $this->load->model('api/v1/User_model');
    }

    public function index_get()
    {
        // $users = $this->User_model->get_all_users();
        $this->response([
			'metadata' => [
				'code' => 200,
				'message' => 'OK',
			], 
			'response' => [
			['id' => 1, 'name' => 'John Doe'],
			['id' => 2, 'name' => 'Jane Smith'],
		]]);
    }

    public function index_post()
    {
        $data = json_decode(file_get_contents("php://input"), true);
        if ($this->User_model->insert_user($data)) {
            $this->response(['status' => true, 'message' => 'User added']);
        } else {
            $this->response(['status' => false, 'message' => 'Failed'], 400);
        }
    }
}
