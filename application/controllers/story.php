<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Story_m','Story');
	}
	public function index()
	{

	}
	public function addComment(){
		$this->isLoggedin();
		$storyid= $this->input->post('storyid');
		$content = $this->input->post('content');
		$authorid = $this->session->userdata('userid');
		$res = $this->Story->addComment($authorid, $storyid, $content);
		if($res)
			redirect($this->agent->referrer().'#success');
		else
			redirect($this->agent->referrer().'#failed');

	}
	public function deleteComment(){
		$this->isLoggedin();
		$commentid = $this->input->post('commentid');
		$res = $this->Story->deleteComment($commentid);
		$this->feedback($res);
	}
	public function deleteStory(){
		$this->isLoggedin();
		$storyid= $this->input->post('storyid');
		$res = $this->Story->deleteStory($storyid);
		if($res)
			redirect($this->agent->referrer().'#success');
		else
			redirect($this->agent->referrer().'#failed');
	}
	public function add(){
		$this->isLoggedin();
		$content = $this->input->post('content');
		$groupid = $this->input->post('groupid');
		$authorid = $this->session->userdata('id');
		$res = $this->Story->addStory($authorid, $content, $groupid);
		if($res)
			redirect('group/show/'.$groupid.'#success');
		else
			redirect('group/show/'.$groupid.'#failed');
	}
	public function likestory(){
		$this->isLoggedin();
		$storyid = $this->input->post('storyid');
		$res = $this->Story->likeStory($storyid, $this->session->userdata('userid'));
		$this->feedback($res, $this->session->userdata('userid'));

	}
	
}
