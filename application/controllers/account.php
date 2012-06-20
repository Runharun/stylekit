<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

 function __construct()
 {
   parent::__construct();
   $this->load->model('account_model','',TRUE);
 }

 function index()
 {
   $this->load->library('form_validation');

   $this->form_validation->set_rules('name', 'Name', 'trim|required|xss_clean');
   $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean');
   $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');



   if($this->form_validation->run() == FALSE)
   {
     // $this->load->view('login');
   }
 }

 function create()
 {
   $this->load->library('form_validation');
   $this->load->view('newaccount');
 }

 function verifycreate() {
   $this->load->library('form_validation');
   $this->account_model->set_account();

   $sess_array = array(
     'email' => $this->input->post('email'),
     'name' => $this->input->post('name'),
     'account_id' => $this->account_model->get_id_by_email($this->input->post('email'))
   );
   $this->session->set_userdata('logged_in', $sess_array);

   redirect('/', 'refresh');

   if($this->form_validation->run() == FALSE)
   {
     // $this->load->view('login');
   }
 }


 function update($account_id)
 {
 }
}
?>


