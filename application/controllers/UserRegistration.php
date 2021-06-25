<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserRegistration extends CI_Controller {

  public function __construct()
 {
  parent::__construct();
  $this->load->library('form_validation');
  $this->load->library('encryption');
  $this->load->model('register_model');
  $this->load->model('model_users');
 }
	public function index()
	{
    //echo "hi";die;
		$this->load->view('register');
  }
  public function validation()
  {
   $this->form_validation->set_rules('first_name', 'First Name', 'required|trim');
   $this->form_validation->set_rules('last_name', 'Last Name', 'required|trim');
   $this->form_validation->set_rules('phone', 'Phone Number', 'required|regex_match[/^(\+44\s?7\d{3}|\(?07\d{3}\)?)\s?\d{3}\s?\d{3}$/]');
   $this->form_validation->set_rules('dob', 'Date Of Birth', 'required');
   $this->form_validation->set_rules('email', 'Email Address', 'required|trim|valid_email|is_unique[users.email]');
   $this->form_validation->set_rules('password', 'Password', 'required');
   $this->form_validation->set_rules('subscription_for', 'Subscription For', 'required');
   if($this->form_validation->run())
   {
    $verification_key = md5(rand());
    $encrypted_password = md5($this->input->post('password'));
    $data = array(
     'first_name'  => $this->input->post('first_name'),
     'last_name'  => $this->input->post('last_name'),
     'phone'  => $this->input->post('phone'),
     'dob'  => date("Y-m-d", strtotime($this->input->post('dob'))),
     'email'  => $this->input->post('email'),
     'subscription_for'  => $this->input->post('subscription_for'),
     'password' => $encrypted_password,
     'verification_key' => $verification_key
    );
    $id = $this->register_model->insert($data);
    
    if($id > 0)
    {
     $subject = "Please verify email";
     echo $message = "
     <p>Hi ".$this->input->post('first_name')."</p>
     <p>This is email verification mail from User Register system. For complete registration process and login into system. First you want to verify you email by click this <a href='".base_url()."register/verify_email/".$verification_key."' target='_blank'>link</a>.</p>
     <p>Once you click this link your email will be verified and you can login into system.</p>
     <p>Thanks,</p>
     ";
     $config = array(
      'protocol'  => 'smtp',
      'smtp_host' => 'smtpout.secureserver.net',
      'smtp_port' => 80,
      'smtp_user'  => 'xxxxxxx', 
      'smtp_pass'  => 'xxxxxxx', 
      'mailtype'  => 'html',
      'charset'    => 'iso-8859-1',
      'wordwrap'   => TRUE
     );
     $this->load->library('email', $config);
     $this->email->set_newline("\r\n");
     $this->email->from('info@mtest.info');
     //$this->email->to($this->input->post('email'));
     $this->email->to('sreejithgirieshnair@gmail.com');
     $this->email->subject($subject);
     $this->email->message($message);
     if($this->email->send())
     {
      $this->session->set_flashdata('message', 'Check in your email for email verification mail');
      redirect('register');
     }
    }
   }
   else
   {
    $this->index();
   }
  }

  public function verify_email()
  {
   if($this->uri->segment(3))
   {
    $verification_key = $this->uri->segment(3);
    if($this->register_model->verify_email($verification_key))
    {
     $data['message'] = '<h1 align="center">Your Email has been successfully verified, now you can login from <a href="'.base_url().'users/login">here</a></h1>';
     $getSubscrptionfor = $this->model_users->subscrptionfor($verification_key);
     $subscrptionName = isset($getSubscrptionfor->subscription_for) ? $getSubscrptionfor->subscription_for:'';
     $userId = isset($getSubscrptionfor->id) ? $getSubscrptionfor->id:'';
     if($subscrptionName){
      $json = file_get_contents('https://hn.algolia.com/api/v1/search?query=foo&tags='.$subscrptionName.'&hitsPerPage=10');
		$getExternalTasksA = json_decode($json, true);
		foreach ($getExternalTasksA['hits'] as $key => $externalTask) {
      if($subscrptionName == 'comment'){
        $author = isset($externalTask['author']) ? $externalTask['author']:'';
        $story_text = isset($externalTask['comment_text']) ? $externalTask['comment_text']:'';
      }
      if($subscrptionName == 'story'){
        $author = isset($externalTask['author']) ? $externalTask['author']:'';
        $story_text = isset($externalTask['story_text']) ? $externalTask['story_text']:'';
      }
      if($subscrptionName == 'poll'){
        $author = isset($externalTask['author']) ? $externalTask['author']:'';
        $story_text = isset($externalTask['story_text']) ? $externalTask['story_text']:'';
      }

      $dataArray = [
        'user_id'=>$userId,
        'author'=>$author,
        'story_text'=>$story_text
      ];
      $this->model_users->subscriptionInsert($dataArray);
		
		}

     }
    }
    else
    {
     $data['message'] = '<h1 align="center">Invalid Link</h1>';
    }
    $this->load->view('email_verification', $data);
   }
  }
}
