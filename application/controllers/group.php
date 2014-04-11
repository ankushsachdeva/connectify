<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {

	function __construct(){
		parent::__construct();

	}
	public function index(){
		
	}
	public function show($groupID)
	{
		$this->isLoggedin();
		$this->load->view('header',array('title' => "Home", 'loggedin'=>$this->session->userdata('fname') ));
		$stories = array( );
		for ($i=0; $i < 10; $i++) { 
			$story = $this->load->view('story', 
				array('id'=>$i,'storyid'=>2,'comments'=>array(array('fname' => "Ankush" ,'lname'=>"Sachdeva" ,'content'=>"theek hai!")),
					'likes'=>array(array('fname' => "Parineeti" ,'lname'=>"Chopra" ,'image'=>"http://2.bp.blogspot.com/-JzAEtW01NfY/UJFJz_50weI/AAAAAAAABDE/l7t4J3Atmgo/s1600/parineeti+Chopra.jpg")),
					'fname' => "Alia", 'lname' => "Bhatt",'image' =>"http://www.hdwallpaperfans.com/wp-content/uploads/2013/01/Cute-Alia-Bhatt-in-a-casual-Indian-attire.jpg",'content'=>"Hi I am Alia Bhatt, follow me at facebook and twitter.", 'numLikes' =>"10", 'numComments' =>"5", 'time' => "10 minutes ago"),
				true);
			array_push($stories, $story);
		}
		$this->load->view('group', array('stories' => $stories, 'name' => 'Family Circle'));
		$this->load->view('footer');

	}
	public function showAll(){
		isLoggedin();

	}

	
}
