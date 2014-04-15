<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_m','User');
		$this->load->model('Story_m','Story');

	}
	
	public function index()
	{
		$this->isLoggedin();
		$userid = $this->session->userdata('id');
		$res = $this->User->getFeed($userid);
		$this->load->view('header',array('title' => "Home", 'loggedin'=>$this->session->userdata('fname') ));
		$stories = array( );
		foreach ($res as $row) {
			$likes = $this->Story->getLikes($row->storyid);
			$alreadyLiked = $this->_checkIfLiked($likes, $userid);
			$comments = $this->Story->getComments($row->storyid);
			$story = $this->load->view('story', 
				array('session'=>$this->session->all_userdata(),'storyid'=>$row->storyid,'authorid'=>$row->authorid,'comments'=> $comments,
					'likes'=>$likes,'alreadyLiked'=>$alreadyLiked,
					'fname' => $row->fname, 'lname' => $row->lname,'image' =>$row->image, 'content' => $row->content,'numLikes' =>count($likes), 'numComments' =>count($comments), 'time' =>$row->time),
				true);
			array_push($stories, $story);
		}
		// for ($i=0; $i < 10; $i++) { 
		// 	$story = $this->load->view('story', 
		// 		array('storyid'=>2,'authorid'=>4,'comments'=>array(array('fname' => "Ankush" ,'lname'=>"Sachdeva" ,'content'=>"theek hai!",'time'=>"10 mins ago")),
		// 			'likes'=>array(array('fname' => "Parineeti" ,'lname'=>"Chopra" ,'image'=>"http://2.bp.blogspot.com/-JzAEtW01NfY/UJFJz_50weI/AAAAAAAABDE/l7t4J3Atmgo/s1600/parineeti+Chopra.jpg",'userid'=>1)),
		// 			'fname' => "Alia", 'lname' => "Bhatt",'image' =>"http://www.hdwallpaperfans.com/wp-content/uploads/2013/01/Cute-Alia-Bhatt-in-a-casual-Indian-attire.jpg",'content'=>"Hi I am Alia Bhatt, follow me at facebook and twitter.", 'numLikes' =>"10", 'numComments' =>"5", 'time' => "10 minutes ago"),
		// 		true);
		// 	array_push($stories, $story);
		// }
		$this->load->view('home', array('stories' => $stories, 'session'=>$this->session->all_userdata()));
		$this->load->view('footer');

	}

	
}
