<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Element extends CI_Controller {

  public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

  }

	public function newelement($guide_id, $unique_id)
	{
		$this->load->model('elements_model');
    $this->elements_model->set_element($guide_id, $unique_id);
  }

	public function removeelement($unique_id)
	{
		$this->load->model('elements_model');
    $this->elements_model->remove_element($unique_id);
  }

	public function updateelement($unique_id)
	{
    $this->load->helper('form');

		$this->load->model('elements_model');
    $this->elements_model->update_element($unique_id);
    $data['id'] = $unique_id;
    $this->load->view('dboutput', $data);
  }

	public function reorder()
	{
		$this->load->model('elements_model');
    $this->elements_model->reorder_elements();
  }

}
