<?php
class Login_model extends CI_Model
{
 function can_login($email, $password)
 {
  $this->db->where('email', $email);
  $inputpsw = md5($password);
  $query = $this->db->get('users');
  if($query->num_rows() > 0)
  {
   foreach($query->result() as $row)
   {
    if($row->is_email_verified == 'yes')
    {
     $store_password = $row->password;
     if($inputpsw == $store_password)
     {
      $this->session->set_userdata('id', $row->id);
     }
     else
     {
      return 'Wrong Password';
     }
    }
    else
    {
     return 'First verified your email address';
    }
   }
  }
  else
  {
   return 'Wrong Email Address';
  }
 }
}

?>