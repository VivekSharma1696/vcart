<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(['url','form']);
        $this->load->library(['form_validation','session']);
        $this->load->model('User_model');
    }

    public function index() {
        $this->load->view('login');
    }

    public function submit() {
        $this->form_validation->set_rules('email','Email','trim|required|valid_email');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
            return;
        }

        $email    = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        $user = $this->User_model->get_by_email($email);

        if ($user && password_verify($password, $user->password)) {

            $this->session->set_userdata([
                'user_id' => $user->id,
                'name'    => $user->name,
                'email'   => $user->email,
                'logged_in' => TRUE
            ]);

            $this->session->set_flashdata('success', 'Login successful, welcome '.$user->name.'!');
            redirect('dashboard');
            } else {
            $this->session->set_flashdata('error','Invalid email or password');
            redirect('login');
        }
    }

            public function logout() {
            $this->session->sess_destroy();
            redirect('login');
    }
}
