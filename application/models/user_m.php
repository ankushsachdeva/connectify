<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->load->model('Group_m','Group');

    }

    //No Transaction required as there is only a single write
    function addUser($fname,$lname,$username,$dob,$gender,$email,$password){
    //return true if record is inserted, false otherwise (for example if constraints are not satisfied)
        $query = "SELECT * FROM users WHERE email = \"$email\" or username = \"$username\"";
        $res = $this->db->query($query);
        $temp = $res->result();

        if (count($temp) > 0) {
        //cannot create new user record as email and username must be unique
            return false;
        } else {
        //user record can be created - if attempted DB operation fails return false
            $data = array('fname' => $fname, 'lname' => $lname, 'username' => $username, 'dob' => $dob, 'gender' => $gender, 'email' => $email, 'passwd' => $password);
            $this->db->insert('users',$data);
            
            if($this->db->affected_rows())
                 return true;
            else
                return false;
        }
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

    function getFriendRequests($userID){ 
    //return all friends records
        $subquery1 = "SELECT * FROM friendship,users WHERE user1accept = 1 and user2accept = 0 and user2id = $userID and user1id = users.id";
        $subquery2 = "SELECT * FROM friendship,users WHERE user1accept = 0 and user2accept = 1 and user1id = $userID and user2id = users.id";
        $query = "$subquery1 UNION $subquery2";
        $res = $this->db->query($query);
        return $res->result();
    }

    function addFriend($userID, $friendID){
    // keep in mind $user1id < $user2id in friendship
    // check whether $friendID has already sent a friend request to userID

        if ($userID < $friendID) {
            //query database for record corresponding to these two users
            //if record is present, update this record
            //if record is not present, insert this record
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
                $this->db->update('friendship',$data,array('user1id' => $friendID));

                if($this->db->affected_rows())
                    return true;
                else
                    return false;
            }
        }
        return false;
    }

    function checkLogin($username, $password){
    //return true if username and password match, false otherwise
        $query = "SELECT * FROM users WHERE username = \"$username\" and passwd = \"$password\"";
        $res = $this->db->query($query);
        $temp = $res->result();

        if (count($temp) > 0) {
            return true;
        } else {
            return false;
        }
        
            
        
    }

    function checkIfFriends($user1id, $user2id){
    //return the row in frndship table
        if ($user1id < $user2id) {
            $query = "SELECT * FROM friendship WHERE user1id = $user1id and user2id = $user2id";
        } else {
            $query = "SELECT * FROM friendship WHERE user1id = $user2id and user2id = $user1id";
        }
        
        $res = $this->db->query($query);
        return $res->result();
        
    }
    function getFeed($userID){
    //return all visible posts to user, that is, posts in all groups that he is in
    //also need to return the comments and likes associated with each of the stories
        $subquery = "SELECT groupID FROM group_members WHERE memberID = $userID";
        $query = "SELECT *, stories.time AS time FROM group_posts,stories,users WHERE stories.id = group_posts.storyid and users.id = stories.authorid and group_posts.groupid in ($subquery) ORDER BY stories.time DESC";
        $res = $this->db->query($query);
        return $res->result();
    }


    function getFeedVisibleToSomeone($userID, $viewerID, $numOfItems){
    //essentially what is seen by the viewer on opening the profile page of a user
    //return $numOfItems number of stories that are authored by $userID and visible to $viewerID
    //by visible we mean stories posted in all mutual groups (display in chronologically backwards order)
        $subquery1 = "SELECT groupID from group_members where memberID = $userID";
        
        //all groups common to both users - MySQL does not support the INTERSECT operation
        $subquery = "SELECT groupID from group_members where memberID = $viewerID and groupID in ($subquery1)";
         
        $query = "SELECT *, stories.time AS time FROM group_posts,stories,users WHERE stories.id = group_posts.storyid and stories.authorid=$userID and users.id=$userID and group_posts.groupid in ($subquery) ORDER BY stories.time DESC  LIMIT $numOfItems";
        
        $res = $this->db->query($query);
        return $res->result();   
    }

    function updateDetails($fname ,  $lname , $dob , $gender , $email, $userid){
        $data = array();
        if(count($fname))
            $data['fname'] = $fname;
        if(count($lname))
            $data['lname'] = $lname;
        if(count($dob))
            $data['dob'] = $dob;
        if(count($gender))
            $data['gender'] = $gender;
        if(count($email))
            $data['email'] = $email;
        // $data = array('fname' => $fname, 'lname' => $lname, 'dob' => $dob, 'gender' => $gender, 'email' => $email);
        $this->db->update('users',$data,array('id' => $userid));
        
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
    function updatePic($userid, $filename){
        $data = array('image' => '/connectify/images/'.$filename);
        $this->db->update('users',$data,array('id' => $userid));
        return true;
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
    function getDetailsUsername($username){
    //return user details
        $query = "SELECT * FROM users WHERE username = '$username'";
        $res = $this->db->query($query);
        return $res->result();
    }


    function search($fname, $lname, $fromDOB, $toDOB, $gender){
    //all are substring search, fromDOB-toDOB is the range of DOB
    //if the user has not specified any value for one of the search parameters pass NULL
    //if no value has been specified by the user for gender however PASS 2 AND NOT NULL
        if ($toDOB == NULL) {
            $toDOB = "9999-01-01";
        }
        if ($fromDOB == NULL) {
            $fromDOB = "0000-01-01";
        }
        if ($gender == 0 or $gender == 1) {
            $query = "SELECT * FROM users WHERE (LOWER(fname) like LOWER(\"%$fname%\")) and (LOWER(lname) like LOWER(\"%$lname%\")) and (gender = $gender) and (dob BETWEEN \"$fromDOB\" and \"$toDOB\")";
        } else {
            $query = "SELECT * FROM users WHERE (LOWER(fname) like LOWER(\"%$fname%\")) and (LOWER(lname) like LOWER(\"%$lname%\")) and (dob BETWEEN \"$fromDOB\" and \"$toDOB\")";
        }
        
        $res = $this->db->query($query);
        return $res->result();       
    }

    function acceptRequest($userid, $requesterid){
    //accept the request that $requestid had sent to $userid
        if ($userid > $requesterid) {
            $smallerID = $requesterid;
            $largerID = $userid;
        } else {
            $smallerID = $userid;
            $largerID = $requesterid;
        }
        
        $data = array('user1accept' => 1,'user2accept' => 1);
        $this->db->update('friendship',$data,array('user1id' => $smallerID,'user2id' => $largerID));

        if($this->db->affected_rows())
            return true;
        else
            return false;
    }

    function rejectRequest($userid, $requesterid){
    //reject the request that $requestid had sent to $userid
        if ($userid > $requesterid) {
            $smallerID = $requesterid;
            $largerID = $userid;
        } else {
            $smallerID = $userid;
            $largerID = $requesterid;
        }
        

        $this->db->delete('friendship', array('user1id' => $smallerID, 'user2id' => $largerID));
        
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }
}