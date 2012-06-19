<?php
class Elements_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}

  public function get_elements($guide_id)
  {
  	$query = $this->db->order_by('order', 'asc')->get_where('elements', array('guide_id' => $guide_id));
    return $query->result_array();
  }

  public function set_element($guide_id, $unique_id)
  {
	  $data = array(
	  	'title' => 'New Element',
	  	'guide_id' => $guide_id,
	  	'unique_id' => $unique_id,
	  	'order' => 100000
	  );
	  
	  return $this->db->insert('elements', $data);
  }

  public function update_element($unique_id)
  {
	  $data = array(
	  	'title' => $this->input->post('title'),
	  	'markup' => $this->input->post('markup'),
	  	'css' => $this->input->post('css')
	  );
    $this->db->where('unique_id', $unique_id);
    $this->db->update('elements', $data);
  }

  public function remove_element($element_id)
  {
    $this->db->delete('elements', array('unique_id' => $element_id));
  }

  public function reorder_elements()
  {
    $items = $this->input->post('item');
    $total_items = count($this->input->post('item'));

    for($item = 0; $item < $total_items; $item++ )
        {

        $data = array(
            'unique_id' => $items[$item],
            'order' => $item
        );

        $this->db->where('unique_id', $data['unique_id']);
        $this->db->update('elements', $data);
    } 
  }

}
