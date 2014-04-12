<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('User_m','User');
		$this->load->model('Group_m','Group');
		$this->load->model('Story_m','Story');

	}
	public function index()
	{
		var_dump($this->Story->deleteStory(2));
	}

	
}
