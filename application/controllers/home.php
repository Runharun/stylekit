<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();

class Home extends CI_Controller {

  public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

    if($this->session->userdata('logged_in'))
   {
     $session_data = $this->session->userdata('logged_in');

		 $this->load->model('guides_model');

     $data['email'] = $session_data['email'];
     $data['name'] = $session_data['name'];
     $data['guides'] = $this->guides_model->get_guides($session_data['account_id']);
     $data['loggedin'] = true;

     $this->load->view('header', $data);
		 $this->load->view('guides', $data);
     $this->load->view('footer');

   }
   else
   {
      $this->load->helper(array('form', 'url'));
		  $this->load->view('login');
   }
  }

	public function guide($guide_id)
	{
    $session_data = $this->session->userdata('logged_in');

		$this->load->model('elements_model');
		$this->load->model('guides_model');

    $data['elements'] = $this->elements_model->get_elements($guide_id);
    $data['guide'] = $this->guides_model->get_guide($guide_id);
    $data['account_id'] = $session_data['account_id'];
    if($this->session->userdata('logged_in'))
    {
      $data['loggedin'] = true;
    } else {
      $data['loggedin'] = false;
    }

    $this->load->view('header', $data);
		$this->load->view('guide', $data);
    $this->load->view('footer');
  }

	public function newguide()
	{
    if($this->session->userdata('logged_in'))
    {
        $this->load->helper('form');
        $this->load->library('form_validation');
        
        $this->form_validation->set_rules('title', 'title', 'required');
        
		    $this->load->model('guides_model');
        if($this->input->post('title')) {
          $this->guides_model->set_guide();
        }

        if ($this->form_validation->run() === FALSE)
	      {
        } else {
          $this->db->select('id');
          $this->db->from('guides');
          $this->db->where('title = ' . "'" . $this->input->post('title') . "'");
          $this->db->limit(1);
          $query = $this->db->get();

          if($query->num_rows() == 1)
          {
            redirect('/guide/' . $query->row('id'), 'refresh');
          }
      }
        $session_data = $this->session->userdata('logged_in');

        $data['account_id'] = $session_data['account_id'];
        $data['loggedin'] = true;
        $this->load->view('newguide', $data);
    } else {
      redirect('', 'refresh');
    }
  }


	public function removeguide($guide_id)
	{
    $this->load->helper('form');
    
		$this->load->model('guides_model');
    $this->guides_model->remove_guide($guide_id);
    redirect('', 'refresh');
  }

	public function update_global_styles($guide_id)
	{
		$this->load->model('guides_model');
    $this->guides_model->update_global_styles($guide_id);
  }

  function signout()
  {
    $this->session->unset_userdata('logged_in');
    session_destroy();
    redirect('', 'refresh');
  }

}

