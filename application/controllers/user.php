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
		$userdata = $this->User->getDetailsUsername($username);
		if($check == true){
			$this->session->set_userdata($userdata[0]);
			$this->session->set_userdata('userid',$this->session->userdata['id']);
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
		$gender = $this->input->post('gender');
		$password = $this->input->post('password');
		$res = $this->User->addUser($fname,$lname,$username,$dob,$gender,$email,$password);
		if(!$res){
			redirect('/#failed','location');
		}
		else{
			redirect('/#success','location');
		}

	}

	public function search(){
		$this->isLoggedIn();
		$this->load->view('header',array('title' => "Search Friends", 'loggedin'=>true));
		$this->load->view('search');
		$this->load->view('footer');

	}
	public function profile($userid = -1){
		$this->isLoggedIn();
		$friendship = 0;
		if($userid == -1){
			$userid = $this->session->userdata('userid');
		}
		else{
			
			$fstatus = $this->User->checkIfFriends($userid, $this->session->userdata('userid'));
			//if both frnds return 3, if viewer has sent request return 1, if viewer has recvieved return 2, else return 0
			if(count($fstatus) == 0 ){
				$friendship = 0;
			}
			else{
				if($fstatus[0]->user1accept == 1 && $fstatus[0]->user2accept == 1){
					$friendship = 3;
				}
				else if(($fstatus[0]->user1id == $this->session->userdata('userid') && $fstatus[0]->user1accept == 1) || ($fstatus[0]->user2id == $this->session->userdata('userid') && $fstatus[0]->user2accept == 1)){
					$friendship = 1;
				}
				else if(($fstatus[0]->user1id == $this->session->userdata('userid') && $fstatus[0]->user2accept == 1) || ($fstatus[0]->user2id == $this->session->userdata('userid') && $fstatus[0]->user1accept == 1)){
					$friendship = 2;
				}
			}
		}
		$this->load->view('header',array('title' => "Friends", 'loggedin'=>true));
		$stories = array( );
		// for ($i=0; $i < 3; $i++) { 
		// 	$story = $this->load->view('story', 
		// 		array('id'=>$i,'session'=> $this->session->all_userdata(),'storyid'=>2,'authorid'=>3,'comments'=>array(array('fname' => "Ankush" ,'lname'=>"Sachdeva" ,'content'=>"theek hai!",'time'=>"5 minutes ago", "authorid"=>1, "commentid"=>1)),
		// 			'likes'=>array(array('fname' => "Parineeti" ,'lname'=>"Chopra" ,'image'=>"http://2.bp.blogspot.com/-JzAEtW01NfY/UJFJz_50weI/AAAAAAAABDE/l7t4J3Atmgo/s1600/parineeti+Chopra.jpg","userid"=>1)),
		// 			'fname' => "Alia", 'lname' => "Bhatt",'image' =>"http://www.hdwallpaperfans.com/wp-content/uploads/2013/01/Cute-Alia-Bhatt-in-a-casual-Indian-attire.jpg",'content'=>"Hi I am Alia Bhatt, follow me at facebook and twitter.", 'numLikes' =>"10", 'numComments' =>"5", 'time' => "10 minutes ago"),
		// 		true);
		// 	array_push($stories, $story);
		// }
		$res = $this->User->getDetails($userid);

		$this->load->view('profile', array('session'=> $this->session->all_userdata(),'stories'=> array( ),'fname' => $res[0]->fname,'lname' =>$res[0]->lname,'userid'=>$userid, 'dob'=>$res[0]->dob,'username'=>$res[0]->username,'email'=>$res[0]->email,'img'=>$res[0]->image, 'friendship'=>$friendship ));
		$this->load->view('footer');
	}
	
	public function friends(){
		$this->isLoggedIn();
		
		$this->load->view('header',array('title' => "Friends", 'loggedin'=>true));
		$friends = $this->User->getFriends($this->session->userdata('userid'));
		$this->load->view('friends', array('friends' => $friends ));
		$this->load->view('footer');
	}
	public function pendingrequests(){
		$this->isLoggedIn();
		// $requests =  array(array('fname' => "Zoya", "lname"=>"Afroj", "userid"=>1 ),array('fname' => "Zoya", "lname"=>"Afroj", "userid"=>1 ) );
		$userid = $this->session->userdata('userid');
		$requests = $this->User->getFriendRequests($userid);
		$this->load->view('header',array('title' => "Pernding Friend Request", 'loggedin'=>true));
		$this->load->view('requests', array('requests' => $requests ));
		$this->load->view('footer');
	}
	public function update(){
		$this->isLoggedIn();
		$userid = $this->session->userdata('userid');
		$this->load->view('header',array('title' => "Update Profile", 'loggedin'=>true));
		
		$this->load->view('updateprofile', array('session'=> $this->session->all_userdata(),'fname' => "Koyal",'lname' =>'Rana','userid'=>$userid, 'dob'=>'23rd July 1993','username'=>"koyal",'email'=>"koyalrana@iitk.ac.in",'img'=>"http://newseastwest.com/wp-content/uploads/2014/04/Miss-India-Koyal-Rana.jpg" ));
		$this->load->view('footer');	
	}
	public function updateprofile(){
		$this->isLoggedIn();

		$fname = $this->input->post('fname');
		$lname = $this->input->post('lname');
		$dob = $this->input->post('dob');
		$email = $this->input->post('email');
		$gender = $this->input->post('gender');
		$userid = $this->session->userdata('userid');
		$res = updateDetails($fname ,  $lname , $dob , $gender , $email, $userid);

	}
	public function addfriend(){
		$this->isLoggedIn();
		$myid = $this->session->userdata('userid');
		$hisid = $this->input->get('userid');
		$res =$this->User->addFriend($myid, $hisid);
		$this->feedback($res);

	}
}
