<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Faq extends CI_Controller {

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
 * faq
 *
 * Controller per la pagina principale dove verr� visualizzata la lista delle faq.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_faq'] = $this->Faqclass->lista_faq();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO faq
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
	    $this->load->model('Categoryclass','',TRUE);
	    $this->load->model('Galleryclass','',TRUE);

	    $data['catlist'] = $this->Categoryclass->getFaqList();
	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
	    $data['info']  = $this->Generals->informazionibase();   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA faq DATABASE
 *
 * Controller per inserire a database la faq e visualizzare la view di risposta.
 *
 */		
	public function aggiungidb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della faq */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Faqclass->inserisci_faq();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
/**
 * MODIFICA faq 
 *
 * Controller per modificare la faq e visualizzare il form di modifica.
 *
 */		
		public function modifica($id)
	{
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Categoryclass','',TRUE);
	    $this->load->model('Galleryclass','',TRUE);
	    $this->load->model('Faqclass','',TRUE);

	    $data['catlist'] = $this->Categoryclass->getFaqList();
	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['faq'] = $this->Faqclass->dati_faq($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA faq DATABASE
 *
 * Controller per modificare a database la faq e visualizzare la view di risposta.
 *
 */		
	public function modificadb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Faqclass->modifica_faq($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	}
/**
 * CANCELLAZIONE DATABASE
 *
 * Cancello la faq dal database.
 *
 */	
	public function elimina($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Faqclass->cancella_faq($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
        
        
        public function aggiungicat()
	{
		
			
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);


	    $data['info']  = $this->Generals->informazionibase();
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/aggiungicat.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
        
        public function aggiungicatdb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della News */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Faqclass->inserisci_catfaq();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
	
	public function listacat()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_cat'] = $this->Faqclass->lista_catfaq();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/listacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
	
	public function modificacat($id)
	{
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['catpagine'] = $this->Faqclass->dati_catfaq($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/modificacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA NEWS DATABASE
 *
 * Controller per modificare a database la news e visualizzare la view di risposta.
 *
 */		
	public function modificacatdb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->Faqclass->modifica_catfaq($id);
            
           
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/faq/confermamodificacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	}
/**
 * CANCELLAZIONE DATABASE
 *
 * Cancello la news dal database.
 *
 */	
	public function eliminacat($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Faqclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Faqclass->cancella_faqcat($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/news/confermacancellazionecat.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */