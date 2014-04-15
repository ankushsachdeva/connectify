<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Group_m','Group');
		$this->load->model('Story_m','Story');
		$this->load->model('User_m','User');


	}
	private function _checkAdmin($members, $userid){
		foreach ($members as $member) {
			if($member->id = $userid){
				if($member->role = 2)
					return true;
				else
					return false;
			}
		}
		return false;
	}
	public function index(){
		
	}
	public function show($groupID)
	{
		$this->isLoggedin();
		$this->load->view('header',array('title' => "Group", 'loggedin'=>$this->session->userdata('fname') ));
		$res = $this->Group->getStories($groupID);
		$details = $this->Group->getDetails($groupID);
		$stories = array( );
		foreach ($res as $row) {
			$likes = $this->Story->getLikes($row->storyid);
			$comments = $this->Story->getComments($row->storyid);
			$story = $this->load->view('story', 
				array('session'=>$this->session->all_userdata(),'storyid'=>$row->storyid,'authorid'=>$row->authorid,'comments'=> $comments,
					'likes'=>$likes,
					'fname' => $row->fname, 'lname' => $row->lname,'image' =>$row->image, 'content' => $row->content,'numLikes' =>count($likes), 'numComments' =>count($comments), 'time' =>$row->time),
				true);
			array_push($stories, $story);
		}		


		// for ($i=0; $i < 10; $i++) { 
		// 	$story = $this->load->view('story', 
		// 		array('authorid'=>$i,'storyid'=>2,'comments'=>array(array('fname' => "Ankush" ,'lname'=>"Sachdeva" ,'content'=>"theek hai!")),
		// 			'likes'=>array(array('userid'=>1,'fname' => "Parineeti" ,'lname'=>"Chopra" ,'image'=>"http://2.bp.blogspot.com/-JzAEtW01NfY/UJFJz_50weI/AAAAAAAABDE/l7t4J3Atmgo/s1600/parineeti+Chopra.jpg")),
		// 			'userid'=>1,'fname' => "Alia", 'lname' => "Bhatt",'image' =>"http://www.hdwallpaperfans.com/wp-content/uploads/2013/01/Cute-Alia-Bhatt-in-a-casual-Indian-attire.jpg",'content'=>"Hi I am Alia Bhatt, follow me at facebook and twitter.", 'numLikes' =>"10", 'numComments' =>"5", 'time' => "10 minutes ago"),
		// 		true);
		// 	array_push($stories, $story);
		// }
		$this->load->view('group', array('stories' => $stories, 'name' => $details[0]->name, 'groupid' => $groupID ));
		$this->load->view('footer');

	}
	public function showAll(){
		$this->isLoggedin();
		$this->load->view('header',array('title' => "Home" , 'loggedin'=>$this->session->userdata('fname') ));
		$res = $this->Group->getAll($this->session->userdata('id'));
		$groups = array();
		foreach ($res as $group) {
			$groupid = $group->id;
			$members = $this->Group->getMembers($groupid);
			$group = array('name' => $group->name, 'time' => $group->time, 'groupid' =>$groupid, 
			'iamadmin' => $this->_checkAdmin($members, $this->session->userdata('id')), 
			'members' => $members );
			array_push($groups, $group);
		}
		$friends = $this->User->getFriends($this->session->userdata('userid'));
		// $groups = array(
		// 	array('name' => "Friends",
		// 	 	  'time'=>'1 month ago', 
		// 	 	  'groupid' => 1,
		// 	 	  'iamadmin' => true,
		// 	 	   'members' => array(array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'23rd July 1993', 'role' =>0 ),
		// 		  							array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'23rd July 1993', 'role' =>0 ) ) ),
		// 		  		array('name' => "Family", 'time'=>'1 month ago' ,'iamadmin' => false, 'groupid' =>2,
		// 				 'members' => array(array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'13th July 1993', 'role' =>0 ),
		// 		  							array('fname' => "Anushka", 'lname' => 'Sharma', 'userid' => 1,'time'=>'3rd July 1993', 'role' =>0 ) ) ) );
		$this->load->view('group_list', array('groups' => $groups , "session" => $this->session->all_userdata(),
			'friends' => $friends));
		$this->load->view('footer');

	}
	public function addmember(){
		$memberIDs = $this->input->post('memberIDs');
		$groupID = $this->input->post('groupid');
		$roles = array_fill(0, count($memberIDs), 0);
		$res = $this->Group->addMember($groupID, $memberIDs, $roles);
		if($res)
			redirect($this->agent->referrer().'#success');
		else
			redirect($this->agent->referrer().'#failed');

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
	public function add(){
		$this->isLoggedin();
		$name = $this->input->post('name');
		$authorid = $this->session->userdata('userid');
		$res = $this->Group->addGroup($authorid, $name);
		if($res)
			redirect('group/showall#success');
		else
			redirect('group/showall#failed');
	}
	
	
}
