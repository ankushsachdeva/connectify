<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Group_m','Group');

    }
    function addUser($fname,$lname,$dob,$email,$username){
      $data = array('fname' => $fname, 'lname' => $lname, 'dob' => $dob, 'email' => $email, 'username' => $username  );
      $this->db->insert('users',$data);
      //We can manually mae 3 new groups for the 3 user circles or create a trigger
      if($this->db->affected_rows())
        return true;
      else
        return false;
    }
    //manual query coz of active reord does not support union
    function getFriends($userID){ 
      $subQuery1 = "SELECT user2circle AS circle,friendship.time AS time, users.id AS fid, users.fname AS ffname, users.lname AS flname, users.dob AS fdob, users.email AS femail FROM friendship JOIN users ON (users.id = friendship.user2id) WHERE user1id = $userID";
      $subQuery2 = "SELECT user1circle AS circle,friendship.time AS time, users.id AS fid, users.fname AS ffname, users.lname AS flname, users.dob AS fdob, users.email AS femail FROM friendship JOIN users ON (users.id = friendship.user1id) WHERE user2id = $userID";
      $res = $this->db->query("($subQuery1) UNION ($subQuery2)");
      return $res->result();      
    }

    function addFriend($userID, $friendID, $friendCircle){
      //keep in mind $user1id < $user2id
    }
    function checkLogin($username, $password){
      //return true or false
      $this->session->set_userdata('fname','Ankush');
      $this->session->set_userdata('lname','Sachdeva');
      $this->session->set_userdata('username','sankush');
      $this->session->set_userdata('userid',1);


      return true;
    }
    function getFeed($userID){
      //return all visible posts to user in any group hes in
    }
    function getFeedVisibleToSomeone($userID, $viewerID, $numOfItems){
      //return numOfItems number of stories that are authored by $userID and visible to $viewerID
    }
    function updateDetails($fname ,  $lname , $username , $dob, $gender, $email){
      
    }
}