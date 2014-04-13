<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Story_m extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }

    function addStory($authorID, $content, $groupID){
    //add to stories table
    //add to group_posts table using auto generated story id
    // return true/false
        $data = array('authorid' => $authorID, 'content' => $content);
        $this->db->insert('stories',$data);
        $temp = $this->db->affected_rows();
        $newstoryID = $this->db->insert_id();

        $data = array('storyid' => $newstoryID, 'groupid' => $groupID);
        $this->db->insert('group_posts',$data);
        $temp = $temp + $this->db->affected_rows();

        if($temp == 2)
            return true;
        else
            return false;
    }

    function addComment($authorID, $storyID, $comment ){
    // return true/false
    //authorID is the id of the user who wrote the comment
        $data = array('storyid' => $storyID, 'userid' => $authorID, 'comment' => $comment);
        $this->db->insert('story_comments',$data);
        
        if($this->db->affected_rows())
            return true;
        else
            return false;
    }

    function likeStory($storyID, $authorID){
    // return true/false
    // authorID is the id of the user who liked the story
    
        $data = array('storyid' => $storyID, 'userid' => $authorID);
        $this->db->insert('story_likes',$data);
        
        if($this->db->affected_rows())
            return true;
        else
            return false;  
    }

    // //Shows how to get data from db using Active Record queries
    // function getLikes($storyID){
    // //return an array
    //     $this->db->select('userid,  time')->where('storyid',$storyID)->from('story_likes');
    //     return $this->db->get()->result();
    // }

    // //Shows how to get data from db using simple queries
    // function getComments($storyID){
    // //return an array
    //     $query = "SELECT userid, comment, time FROM story_comments WHERE storyid = $storyID";
    //     $res = $this->db->query($query);
    //     return $res->result();
    // }

    function deleteStory($storyid){
    //remove story and all related data from stories, group_posts, story_likes and story_comments
        
        $this->db->delete('group_posts', array('storyid' => $storyid));
        $temp2 = $this->db->affected_rows();

        $this->db->delete('story_likes', array('storyid' => $storyid));
        $temp3 = $this->db->affected_rows();

        $this->db->delete('story_comments', array('storyid' => $storyid));
        $temp4 = $this->db->affected_rows();        

        //delete this entry in the end due to foreign key contraints
        $this->db->delete('stories', array('id' => $storyid));
        $temp1 = $this->db->affected_rows();

        //HOW TO CHECK WHETHER ALL LIKES AND COMMENTS WERE DELETED?
        //there may be no likes or comments (temp3 = 0 or temp4 = 0)
        //READ DB AND CHECK WHETHER THERE ARE ANY LIKES/COMMENTS

        if($temp1 > 0 and $temp2 > 0)
            return true;
        else
            return false;
    }

    function getGroup($storyid){
    // returns the group in which this story is
        $query = "SELECT groupid FROM group_posts WHERE storyid = $storyid";
        $res = $this->db->query($query);
        return $res->result();
    }
}