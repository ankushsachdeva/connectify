<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Group_m','Group');

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
				array('authorid'=>$i,'storyid'=>2,'comments'=>array(array('fname' => "Ankush" ,'lname'=>"Sachdeva" ,'content'=>"theek hai!")),
					'likes'=>array(array('userid'=>1,'fname' => "Parineeti" ,'lname'=>"Chopra" ,'image'=>"http://2.bp.blogspot.com/-JzAEtW01NfY/UJFJz_50weI/AAAAAAAABDE/l7t4J3Atmgo/s1600/parineeti+Chopra.jpg")),
					'userid'=>1,'fname' => "Alia", 'lname' => "Bhatt",'image' =>"http://www.hdwallpaperfans.com/wp-content/uploads/2013/01/Cute-Alia-Bhatt-in-a-casual-Indian-attire.jpg",'content'=>"Hi I am Alia Bhatt, follow me at facebook and twitter.", 'numLikes' =>"10", 'numComments' =>"5", 'time' => "10 minutes ago"),
				true);
			array_push($stories, $story);
		}
		$this->load->view('group', array('stories' => $stories, 'name' => 'Family Circle'));
		$this->load->view('footer');

	}
	public function showAll(){
		$this->isLoggedin();
		$this->load->view('header',array('title' => "Home" , 'loggedin'=>$this->session->userdata('fname') ));
		$groups = array(
			array('name' => "Friends",
			 	  'time'=>'1 month ago', 
			 	  'groupid' => 1,
			 	  'iamadmin' => true,
			 	   'members' => array(array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'23rd July 1993', 'role' =>0 ),
				  							array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'23rd July 1993', 'role' =>0 ) ) ),
				  		array('name' => "Family", 'time'=>'1 month ago' ,'iamadmin' => false, 'groupid' =>2,
						 'members' => array(array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'13th July 1993', 'role' =>0 ),
				  							array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'3rd July 1993', 'role' =>0 ) ) ) );
		$this->load->view('group_list', array('groups' => $groups ,
			'friends' => array(array('fname' => "Scarlett", 'lname' => 'Johnson', 'userid' =>1) )));
		$this->load->view('footer');

	}
	public function addmember(){
		$memberIDs = $this->input->post('memberIDs');
		$groupID = $this->input->post('groupid');
		$res = $this->Group->addMember($groupID, $memberIDs);
		if($res)
			redirect('group/showall#success');
		else
			redirect('group/showall#failed');

	}
	public function changerole(){
		$newRole = $this->input->post('role');
		$userid = $this->input->post('userid');
		$groupid = $this->input->post('groupid');
		$res = $this->Group->changeRole($userid, $groupid, $newRole);
		if($res)
			redirect('group/showall#success');
		else
			redirect('group/showall#failed');
	}
	
}
