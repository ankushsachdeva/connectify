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
}