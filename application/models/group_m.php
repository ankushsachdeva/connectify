<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Group_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    function addGroup($authorID){
      //true or false
    }
    function addMember($groupID, $memberIDs){
      // $memberIDs is an array of new member IDs
    }
    function getMembers($groupID){

    }
    function getStories($groupID){
      
    }
    function changeRole($userid, $groupid, $newRole){
        
    }
}