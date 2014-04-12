<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller {

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
			redirect('/#failed','location');
		}
	}
	public function logout(){
		$this->session->sess_destroy();
		redirect('/','location');
	}
	public function signup(){
		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$dob = $this->input->post('dob');
		$email = $this->input->post('email');
		$username = $this->input->post('username');
		$res = $this->User->addUser($fname,$lname,$dob,$email,$username);
		if(!$res){
			redirect('/#failed','location');
		}
		else{
			redirect('/','location');
		}

	}
	public function profile($userid = -1){
		$this->isLoggedIn();
		if($userid == -1)
			$userid = $this->session->userdata('userid');
		$this->load->view('header',array('title' => "Friends", 'loggedin'=>true));
		$stories = array( );
		for ($i=0; $i < 3; $i++) { 
			$story = $this->load->view('story', 
				array('id'=>$i,'storyid'=>2,'authorid'=>3,'comments'=>array(array('fname' => "Ankush" ,'lname'=>"Sachdeva" ,'content'=>"theek hai!",'time'=>"5 minutes ago")),
					'likes'=>array(array('fname' => "Parineeti" ,'lname'=>"Chopra" ,'image'=>"http://2.bp.blogspot.com/-JzAEtW01NfY/UJFJz_50weI/AAAAAAAABDE/l7t4J3Atmgo/s1600/parineeti+Chopra.jpg","userid"=>1)),
					'fname' => "Alia", 'lname' => "Bhatt",'image' =>"http://www.hdwallpaperfans.com/wp-content/uploads/2013/01/Cute-Alia-Bhatt-in-a-casual-Indian-attire.jpg",'content'=>"Hi I am Alia Bhatt, follow me at facebook and twitter.", 'numLikes' =>"10", 'numComments' =>"5", 'time' => "10 minutes ago"),
				true);
			array_push($stories, $story);
		}
		$this->load->view('profile', array('stories'=>$stories,'fname' => "Koyal",'lname' =>'Rana','userid'=>$userid, 'dob'=>'23rd July 1993','username'=>"koyal",'email'=>"koyalrana@iitk.ac.in",'img'=>"http://newseastwest.com/wp-content/uploads/2014/04/Miss-India-Koyal-Rana.jpg" ));
		$this->load->view('footer');
	}
	
	public function friends(){
		$this->isLoggedIn();
		$friends =  array(array('fname' => "Anushka", 'lname'=>"Sharma", 'userid'=>1, 'image'=>"http://www.biobloomonline.com/wp-content/uploads/2013/01/Anushka-Sharma-face-2.jpg"  ),
					 array('fname' => "Lynn", 'lname'=>"Collins", 'userid'=>2, 'image'=>"http://www4.images.coolspotters.com/photos/835986/lynn-collins-and-john-carter-of-mars-gallery.jpg"  )
					 	);
		$this->load->view('header',array('title' => "Friends", 'loggedin'=>true));
		$this->load->view('friends', array('friends' => $friends ));
		$this->load->view('footer');
	}
}
