<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()
	{
   
		 if ($this->session->userdata('logged_in') == TRUE)
	    {
	        redirect('admin/');
	    }
	    $this->load->model('Generals', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase(); 
	    $data['title']      = 'MyCoolBibleApp';
	    $data['username']   = array('id' => 'username', 'name' => 'username');
	    $data['password']   = array('id' => 'password', 'name' => 'password');	        
		$this->load->view('login', $data);
	}
	
	public function process_login()
	{
	    $username = $this->input->post('username');    
	    $password = $this->input->post('password');
	    
	    $this->load->model('Generals', '', TRUE);
            
            

	    //$data['info']  = $this->Generals->informazionibase();
            
            $data = $this->Generals->autenticate_user($username,$password);
            
	    
	    if ($data!=null)
	    {
	        
                
             

            $this->session->set_userdata($data);
            
            redirect('admin/');
	    } 
	    else 
	    {
	        $this->session->set_flashdata('message', '<div id="message">Oopsie, it seems your username or password is incorrect, please try again.</div>');
	        redirect('login/index');
	    }
	}
	
	public function logout()
	{
	    $this->session->sess_destroy();
	    
	    $this->load->model('Generals', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase(); 
	    
	    redirect('login/index');
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */