<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Glossario extends CI_Controller {

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
	

/**
 * GLOSSARIO
 *
 * Controller per la pagina principale dove verrˆ visualizzata la lista degli elementi a glossario.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Glossaryclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_glossario'] = $this->Glossaryclass->lista_glossario();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/glossario/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO NEWS
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

	    $data['info']  = $this->Generals->informazionibase();   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/glossario/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA NEWS DATABASE
 *
 * Controller per inserire a database la news e visualizzare la view di risposta.
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
	    $this->load->model('Glossaryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Glossaryclass->inserisci_glossario();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/glossario/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
/**
 * MODIFICA NEWS 
 *
 * Controller per modificare la news e visualizzare il form di modifica.
 *
 */		
		public function modifica($id)
	{
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Glossaryclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['glossario'] = $this->Glossaryclass->dati_glossario($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/glossario/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA NEWS DATABASE
 *
 * Controller per modificare a database la news e visualizzare la view di risposta.
 *
 */		
	public function modificadb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Glossaryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Glossaryclass->modifica_glossario($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/glossario/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	}
/**
 * CANCELLAZIONE DATABASE
 *
 * Cancello la news dal database.
 *
 */	
	public function elimina($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Glossaryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Glossaryclass->cancella_glossario($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/glossario/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */