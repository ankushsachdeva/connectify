<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function addGroup($authorID,$groupName){
    //return true iff new group is created and author is successfully added as admin
    //assumes that a single user is allowed to create multiple groups having the same name

    	$data = array('name' => $groupName);
    	$this->db->insert('groups',$data);
    	$temp1 = $this->db->affected_rows();
    	$gID = $this->db->insert_id();

    	$data = array('groupID' => $gID, 'memberID' => $authorID, 'role' => 2);
    	$this->db->insert('group_members',$data);
    	$temp2 = $this->db->affected_rows();

    	if($temp1 > 0 and $temp2 > 0)
        	return true;
      	else
        	return false; 
    }

    function addMembers($groupID, $memberIDs, $roles){
    //$memberIDs is an array of new member IDs, $roles is an array of roles (of the same size)
    //assumes both of the above arrays are indexed from 0
    	
        $len = count($memberIDs);
    	$temp = 0;
    	if ($len == count($roles)) {
    		for ($i = 0; $i < $len; $i++) { 
    			$data = array('groupID' => $groupID, 'memberID' => $memberIDs[$i], 'role' => $roles[$i]);
    			$this->db->insert('group_members',$data);
    			$temp = $temp + $this->db->affected_rows();
    		}
    		if($temp == $len)
        		return true;
      		else
        		return false;
    	}
    	else
    		return false;
    }

    function getMembers($groupID){
    //join group_members with user to return all member details
    	$query = "SELECT * FROM group_members,users WHERE group_members.memberID = users.id and groupID = $groupID";
    	$res = $this->db->query($query);
   	   	return $res->result();
    }

    function getStories($groupID){
    //join group_posts with stories to return all story details 
    //sort stories chronologically backwards
    //also get the likes and comments details associated with each story
    	$query = "SELECT * FROM group_posts,stories WHERE stories.id = group_posts.storyid and group_posts.groupid = $groupID ORDER BY stories.time DESC";
    	$res = $this->db->query($query);
   	   	return $res->result();  
    }

    function changeRole($userid, $groupid, $newRole){
    //update the corresponding entry in group_members
    	$data = array('role' => $newRole);
      	$this->db->update('group_members',$data,array('memberID' => $userid,'groupID' => $groupid));
      	
      	if($this->db->affected_rows())
        	return true;
      	else
        	return false;
    }

    function getAdmins($groupID){
    //join group_members with users to returl all details of admins
    	$query = "SELECT * FROM group_members,users WHERE group_members.memberID = users.id and groupID = $groupID and role = 2";
    	$res = $this->db->query($query);
   	   	return $res->result();	
    }
}