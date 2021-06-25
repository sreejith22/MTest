<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserHome extends CI_Controller {
 public function __construct()
 {
  parent::__construct();
  if(!$this->session->userdata('id'))
  {
   redirect('users/login');
  }
  $this->load->model('model_users');
 }

 function index()
 {
   $loginId = $this->session->userdata('id');
   $getUserName = $this->model_users->getUserInfo($loginId);
   $loginName = isset($getUserName->first_name) ? $getUserName->first_name:'';
  echo '<br /><br /><br /><h1 align="center">Welcome '.$loginName.'</h1>';
  echo '<p align="center"><a href="'.base_url().'user_home/logout">Logout</a></p>';
  $data =[];
  $getSubscribtionDetails = $this->model_users->subscriptionUserData($loginId);
  $data['subscribtionDetails'] = $getSubscribtionDetails;
  $this->load->view('user_home',$data);
 }

 function logout()
 {
  $data = $this->session->all_userdata();
  foreach($data as $row => $rows_value)
  {
   $this->session->unset_userdata($row);
  }
  redirect('users/login');
 }
}

?>