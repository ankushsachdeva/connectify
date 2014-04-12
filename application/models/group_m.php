<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function addGroup($authorID,$groupName){
      //return true iff new group is created and author is successfully added as admin
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
    function addMember($groupID, $memberIDs, $roles){
      // $memberIDs is an array of new member IDs, roles is an array of roles
    	
    }
    function getMembers($groupID){
    //join group_members with users
    	$query = "SELECT userid, comment, time FROM story_comments WHERE storyid = $storyID";
      	$res = $this->db->query($query);
      	return $res->result();
    }
    function getStories($groupID){
    //join group members with stories  
    }
}