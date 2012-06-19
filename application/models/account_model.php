<?php
Class Account_model extends CI_Model
{
 function login($email, $password)
 {

   $this->db->select('id, email, password, name');
   $this->db->from('accounts');
   $this->db->where('email = ' . "'" . $email . "'");
   $this->db->where('password = ' . "'" . MD5($password) . "'");
   $this->db->limit(1);

   $query = $this->db->get();

   if($query->num_rows() == 1)
   {
     return $query->result();
   }
   else
   {
     return false;
   }
 }
 function set_account()
 {
	  $data = array(
	  	'name' => $this->input->post('name'),
	  	'email' => $this->input->post('email'),
	  	'password' => md5($this->input->post('password'))
	  );
	  return $this->db->insert('accounts', $data);
 }
 function get_id_by_email($email) {
    $this->db->select('id');
    $this->db->from('accounts');
    $this->db->where('email = ' . "'" . $email . "'");
    $this->db->limit(1);
    $query = $this->db->get();

    if($query->num_rows() == 1)
    {
      return$query->row('id');
    }
 }

}
