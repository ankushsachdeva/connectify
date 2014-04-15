<? class MY_Controller extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function isLoggedIn()
    {
        $user = $this->session->userdata('fname');
        if($user == false){
        	redirect('/','location');
        }
    }
    public function feedback($res){
        if($res)
            redirect($this->agent->referrer().'#success');
        else
            redirect($this->agent->referrer().'#failed');
    }
    public function _checkIfLiked($likes, $userid){
        foreach ($likes as $like) {
            if($like->userid == $userid)
                return true;
        }
        return false;
    }
}