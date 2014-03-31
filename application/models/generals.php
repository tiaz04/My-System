<?

class Generals extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function autenticate_user($username,$password) {
        
        $query = $this->db->get_where($this->config->item('prefix').'admin_users', array('username' => $username, 'password' => md5($password)));
        if ($query->num_rows() > 0)
{
            
            $row = $query->row();
            $data = array(
                   'username'  => $username,
                   'logged_in' => TRUE,
                   'permission' => $row->permission
            );
            
            
            return $data;
            
        }else{
            
            return null;
        }
        
    }
    
    function informazionibase(){
    
    	$query = $this->db->get($this->config->item('prefix').'general', 1);
    	foreach ($query->result() as $row)
{
    $data['nome_sito']=$row->nome_sito;
    $data['indirizzo_sito']=$row->indirizzo_sito;
    $data['thumb_width']=$row->thumb_width;
    $data['thumb_height']=$row->thumb_height;
    $data['enable_retina']=$row->retina;
    $data['mid_width']=$row->mid_width;
    $data['mid_height']=$row->mid_height;
    $data['version']=$row->version;
    $data['open_tabella']='<table border="0" cellpadding="0" cellspacing="0" class="table table-striped ">';
    $data['userinfo']=$this->session->userdata;
    $data['indirizzo_upload']=$this->config->item('upload_short');
    $data['lingue']=json_decode($row->lang);
    $data['tarifs_option']=json_decode($row->tarifs_option);
    $data['pacchetti_camere']=json_decode($row->pacchetti_camere);
    
}
        return $data;
    
    }
    
	function getTemplateList(){ 
		$query=$this->db->get($this->config->item('prefix').'templates');
		return $query->result();
	}
    
}

?>