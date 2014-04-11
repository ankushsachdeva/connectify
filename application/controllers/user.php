<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_m','User');
	}
	public function index()
	{
		$friends = $this->User->getFriends(3);
		var_dump($friends);
	}
	public function login(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$check = $this->User->checkLogin($username,$password);
		if($check == true){
			redirect('/home','location');
		}
		else{
			redirect('/','location');
		}
	}
	public function signup(){
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$dob = $this->input->post('dob');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$res = $this->User->addUser($fname,$lname,$dob,$email,$username);
		if(!$res){
			echo "Failed";
		}
		else{
			redirect('/','location');
		}

	}
}
