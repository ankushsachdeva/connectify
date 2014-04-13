<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Group_m','Group');

    }

    function addUser($fname,$lname,$username,$dob,$gender,$email,$password){
    //return true of false
        $data = array('fname' => $fname, 'lname' => $lname, 'username' => $username, 'dob' => $dob, 'gender' => $gender, 'email' => $email, 'passwd' => $password);
        $this->db->insert('users',$data);
        
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }

    //manual query coz of active record does not support union
    function getFriends($userID){ 
    //return all friends records
        $subquery1 = "SELECT * FROM friendship,users WHERE user1accept = 1 and user2accept = 1 and user1id = $userID and user2id = users.id";
        $subquery2 = "SELECT * FROM friendship,users WHERE user1accept = 1 and user2accept = 1 and user2id = $userID and user1id = users.id";
        $query = "$subquery1 UNION $subquery2";
        $res = $this->db->query($query);
        return $res->result();
    }

    function addFriend($userID, $friendID){
    // keep in mind $user1id < $user2id in friendship
    // check whether $friendID has already sent a friend request to userID
        if ($userID < $friendID) {
            //query database for record
            //if record is present, update
            //if record is not present, insert
            $query = "SELECT * FROM friendship WHERE user1id = $userID and user2id = $friendID";
            $res = $this->db->query($query);
            $temp = $res->result();

            if (count($temp) == 0) {
                //record is not present in the table friendship => insert a new record
                $data = array('user1id' => $userID, 'user2id' => $friendID, 'user1accept' => 1, 'user2accept' => 0);
                $this->db->insert('friendship',$data);

                if($this->db->affected_rows())
                    return true;
                else
                    return false;
            } else {
                //record is present in the table => update
                $data = array('user1accept' => 1);
                $this->db->update('friendship',$data,array('user2id' => $friendID));

                if($this->db->affected_rows())
                    return true;
                else
                    return false;
            }
        } 
        else {
            //similar approach to if    
            $query = "SELECT * FROM friendship WHERE user1id = $friendID and user2id = $userID";
            $res = $this->db->query($query);
            $temp = $res->result();

            if (count($temp) == 0) {
                //record is not present in the table friendship => insert a new record
                $data = array('user1id' => $friendID, 'user2id' => $userID, 'user1accept' => 0, 'user2accept' => 1);
                $this->db->insert('friendship',$data);

                if($this->db->affected_rows())
                    return true;
                else
                    return false;
            } else {
                //record is present in the table => update
                $data = array('user2accept' => 1);
                $this->db->update('friendship',$data,array('user2id' => $friendID));

                if($this->db->affected_rows())
                    return true;
                else
                    return false;
            }
        }
    }

    function checkLogin($username, $password){
    //return true if username and password match, false otherwise
        $query = "SELECT passwd FROM users WHERE username = $username";
        $res = $this->db->query($query);
        $temp = $res->result();
        if ($temp['passwd'] == $password) {
            return true;
        } else {
            return false;
        }
        
    }

    function getFeed($userID){
    //return all visible posts to user, that is, posts in all groups that he is in
    //also need to return the comments and likes associated with each of the stories
        $subquery = "SELECT groupID FROM group_members WHERE memberID = $userID";
        $query = "SELECT * FROM group_posts,stories,story_likes,comments WHERE stories.id = story_likes.storyid and stories.id = comments.storyid and stories.id = group_posts.storyid and group_posts.groupid in ($subquery) ORDER BY stories.time DESC";
        $res = $this->db->query($query);
        return $res->result();
    }

    function getFeedVisibleToSomeone($userID, $viewerID, $numOfItems){
    //essentially what is seen by the viewer on opening the profile page of a user
    //return $numOfItems number of stories that are authored by $userID and visible to $viewerID
    //by visible we mean stories posted in all mutual groups
    //also display all likes and comment details associated with each story (sorted chronologically backwards)
        $subquery1 = "SELECT groupID from group_members where memberID = $userID";
        $subquery2 = "SELECT groupID from group_members where memberID = $viewerID";
        $subquery = "$subquery1 INTERSECT $subquery2";  //all common groups 
        $query = "SELECT * FROM group_posts,stories,story_likes,comments WHERE stories.id = story_likes.storyid and stories.id = comments.storyid and stories.id = group_posts.storyid and group_posts.groupid in ($subquery) ORDER BY stories.time DESC LIMIT $numOfItems";

        $res = $this->db->query($query);
        return $res->result();   
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