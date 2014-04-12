<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Group_m','Group');

    }

    function addUser($fname,$lname,$dob,$gender,$email,$username){
        $data = array('fname' => $fname, 'lname' => $lname, 'dob' => $dob, 'gender' => $gender, 'email' => $email, 'username' => $username  );
        $this->db->insert('users',$data);
        
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
    // keep in mind $user1id < $user2id
    // new group needs to be generated and its id needs to be returned!
    // But if user1circle and user2circle are both not null, is one way friendship possible? 2 new groups created?
        if ($userID < $friendID) {
          # code...
        } else {
          # code...
        }

        
        
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
        $query = "SELECT * FROM group_posts,stories WHERE group_posts.storyid = stories.id and group_posts.groupid in (SELECT groupID FROM group_members WHERE memberID = $userID)";
        $res = $this->db->query($query);
        return $res->result();
    }

    function getFeedVisibleToSomeone($userID, $viewerID, $numOfItems){
    //return numOfItems number of stories that are authored by $userID and visible to $viewerID
    //just look up friendship table usercircle group? Or do you also need to check all those groups in which both are members (UNION)?
    }

    function updateDetails($fname ,  $lname , $dob , $gender , $email, $userid){
        $data = array('fname' => $fname, 'lname' => $lname, 'dob' => $dob, 'gender' => $gender, 'email' => $email);
        $this->db->update('users',$data,array('id' => $userid));
        
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }

    function getDetails($userid){
    //return user details
        $query = "SELECT * FROM users WHERE id = $userid";
        $res = $this->db->query($query);
        return $res->result();
    }
}