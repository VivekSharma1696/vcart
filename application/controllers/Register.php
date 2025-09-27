<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Register extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper(['url','form']);
        $this->load->library(['form_validation','session']);
        $this->load->database();
        $this->load->model('User_model');
    }

    public function index() {
        $data['countries'] = $this->db->select('id,name')->get('countries')->result();
        $this->load->view('register', $data);
    }

    public function submit() {
        $this->form_validation->set_rules('name','Name','trim|required|min_length[2]');
        $this->form_validation->set_rules('dob','Date of Birth','required');
        $this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password','Password','required|min_length[6]');
        $this->form_validation->set_rules('country','Country','required');
        $this->form_validation->set_rules('state','State','required');
        $this->form_validation->set_rules('city','City','required');

        if ($this->form_validation->run() == FALSE) {
            $data['countries'] = $this->db->select('id,name')->get('countries')->result();
            $this->load->view('register', $data);
            return;
        }

        $payload = [
            'name'       => $this->input->post('name', true),
            'dob'        => $this->input->post('dob', true),
            'email'      => $this->input->post('email', true),
            'password'   => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
            'country_id' => (int)$this->input->post('country'),
            'state_id'   => (int)$this->input->post('state'),
            'city_id'    => (int)$this->input->post('city'),
        ];

        $insert_id = $this->User_model->create($payload);
        if ($insert_id) {
            $this->session->set_flashdata('success','Registration successful. You can now login.');
            redirect('login');
        } else {
            $this->session->set_flashdata('error','Something went wrong. Please try again.');
            redirect('register');
        }
    }

    // AJAX: get states by country_id
    public function states($country_id = null) {
        $country_id = (int)$country_id;
        $states = $this->db->where('country_id', $country_id)->get('states')->result();
        echo json_encode($states);
    }

    // AJAX: get cities by state_id
    public function cities($state_id = null) {
        $state_id = (int)$state_id;
        $cities = $this->db->where('state_id', $state_id)->get('cities')->result();
        echo json_encode($cities);
    }

}
