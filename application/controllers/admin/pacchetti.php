<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pacchetti extends CI_Controller {
	
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Packclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 
	    
	    $data['lista_pacchetti'] = $this->Packclass->lista_pacchetti();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pacchetti/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO PACCHETTI
 *
 * Controller per visualizzare il form di inserimento.
 *
 */	
	public function aggiungi()
	{
		
			
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Packclass','',TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase();   
	    

	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pacchetti/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA PACCHETTO DATABASE
 *
 * Controller per inserire a database il pacchetto e visualizzare la view di risposta.
 *
 */		
	public function aggiungidb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della News */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Packclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
	    
		if ( $this->upload->do_upload())
		{
			$data_img = array('upload_data' => $this->upload->data());
		}else{
			$error = array('error' => $this->upload->display_errors());
			$data_img="";
			
		}
	    
	    $data['risultato_inserimento']=$this->Packclass->inserisci_pacchetto($data['info']['pacchetti_camere'], $data_img);
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pacchetti/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
	
	public function modifica($id)
	{

		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Packclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    $data['pacchetto'] = $this->Packclass->dati_pacchetto($id);
	    
	    $this->load->view('template/adminheader', $data);
		$this->load->view('admin/pacchetti/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
	
	public function modificadb($id)
	{

			if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Packclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png';
		
		$this->load->library('upload', $config);
	    
		if ( $this->upload->do_upload())
		{
			$data_img = array('upload_data' => $this->upload->data());
		}else{
			$error = array('error' => $this->upload->display_errors());
			$data_img="";
			
		}
	    
	    
	    $data['risultato_inserimento']=$this->Packclass->modifica_pacchetto($id,$data['info']['pacchetti_camere'], $data_img);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pacchetti/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	
	}
	
	public function elimina($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Packclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Packclass->cancella_pacchetto($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pacchetti/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
	
	
}