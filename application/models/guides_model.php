<?php
class Guides_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

  public function get_guides($account_id)
  {
	  $query = $this->db->get_where('guides', array('account_id' => $account_id));
	  return $query->result_array();
	}

  public function get_guide($guide_id)
  {
	  $query = $this->db->get_where('guides', array('id' => $guide_id));
	  return $query->result_array();
	}

  public function set_guide()
{
	$this->load->helper('url');
	
	
	$data = array(
		'title' => $this->input->post('title'),
		'account_id' => $this->input->post('account_id'),
		'global_styles' => '',
	);
	
	return $this->db->insert('guides', $data);
}

  public function remove_guide($guide_id)
  {
    $this->db->delete('guides', array('id' => $guide_id));
    $this->db->delete('elements', array('guide_id' => $guide_id));
  }

  public function update_global_styles($guide_id)
  {
	  $data = array(
	  	'global_styles' => $this->input->post('global_styles')
	  );
    $this->db->where('id', $guide_id);
    $this->db->update('guides', $data);
  }

}
