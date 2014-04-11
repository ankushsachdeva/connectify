<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Story_m','Story');
	}
	public function index()
	{

	}
	public function addComment(){
		$storyid= $this->input->post('storyid');
		$content = $this->input->post('content');
		// $this->Story->addComment()
	}

	
}
