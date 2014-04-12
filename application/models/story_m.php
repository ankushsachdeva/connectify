<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function addStory($authorID, $content, $groupID){
      //add to stories table
      //add to group_posts table
      // return true/false
    }

    function addComment($authorID, $storyID, $comment ){
      // return true/false

    }

    function likeStory($storyID, $authorID){
      // return true/false

    }

    //Shows how to get data from db using Active Record queries
    function getLikes($storyID){
      //return an array
      $this->db->select('userid,  time')->where('storyid',$storyID)->from('story_likes');
      return $this->db->get()->result();
    }

    //Shows how to get data from db using simple queries
    function getComments($storyID){
      //return an array
      $query = "SELECT userid, comment, time FROM story_comments WHERE storyid = $storyID";
      $res = $this->db->query($query);
      return $res->result();
    }

    function deleteStory($storyid){

    }
    
    function getGroup($storyid){
      // returns the group in which this story is
    }
}