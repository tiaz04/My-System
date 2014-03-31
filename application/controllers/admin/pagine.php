<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagine extends CI_Controller {

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
 * PAGINE
 *
 * Controller per la pagina principale dove verr� visualizzata la lista delle pagine presenti.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Pagineclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_pagine'] = $this->Pagineclass->lista_pagine();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO PAGINA
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
		$this->load->model('Pagineclass','',TRUE);
		$this->load->model('Headerimgclass','',TRUE);
                $this->load->model('Faqclass','',TRUE);
		

	    $data['info']  = $this->Generals->informazionibase();
	    $data['lista_cat'] = $this->Pagineclass->lista_catpagine(); 
	    $data['lista_pag'] = $this->Pagineclass->lista_pagine();
	    $data['headerimglist'] = $this->Headerimgclass->getHeaderimgList(); 
	    $data['templates'] = $this->Generals ->getTemplateList();
            $data['catfaq_list'] = $this->Faqclass->lista_catfaq();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA PAGINA DATABASE
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
	    $this->load->model('Pagineclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Pagineclass->inserisci_pagina();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
/**
 * MODIFICA PAGINA 
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
	    $this->load->model('Pagineclass','',TRUE);
            $this->load->model('Faqclass','',TRUE);
	    $this->load->model('Galleryclass','',TRUE);
            $this->load->model('FileGalleryclass','',TRUE);
	    $this->load->model('Videoclass','',TRUE);
	    $this->load->model('Uploadclass','',TRUE);
		$this->load->model('Headerimgclass','',TRUE);

		/** GESTISCO L'AGGIUNTA DEL MODULO */
		if ($this->input->post('tipologia_contenuto')!=""){
	    $risultato=$this->Pagineclass->inserisci_modulo($id);		    	
	    }
	    
		/** GESTISCO LA MODIFICA DEL MODULO */
		if ($this->input->post('modifica_modulo')!=""){
	    $risultato=$this->Pagineclass->modifica_modulo();		    	
	    }
	    
		if ($this->input->post('del_sin')!=""){
	    	$risultato=$this->Pagineclass->del_modulo();
	    }
	    
	    
	    if (isset($risultato))
	    $data['risultato_inserimento']=$risultato;
	    else
	    $data['risultato_inserimento']="";
	    
	    
	    $data['headerimglist'] = $this->Headerimgclass->getHeaderimgList();
	    $data['info']  = $this->Generals->informazionibase();  
	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
            $data['filegallerylist'] = $this->FileGalleryclass->getFileGalleryList();
	    $data['videolist'] = $this->Videoclass->getVideoList();
            $data['catfaq_list'] = $this->Faqclass->lista_catfaq();
	    
	    $data['modulilist'] = $this->Pagineclass->getModuli($id);

	    
	    $data['pagina'] = $this->Pagineclass->dati_pagina($id);  
	    $data['lista_cat'] = $this->Pagineclass->lista_catpagine();  
	    $data['lista_pag'] = $this->Pagineclass->lista_pagine();
	    $data['templates'] = $this->Generals ->getTemplateList();
		$this->load->view('template/adminheader', $data);
		if ($this->input->post('modify_sin')!=""){
			$data['modifica_sin']=$this->Pagineclass->getModulo($this->input->post('modify_sin'));
	    	$this->load->view('admin/pagine/modifica_sin.php', $data);	
	    }
	    
		$this->load->view('admin/pagine/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA PAGINA DATABASE
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
	    $this->load->model('Pagineclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Pagineclass->modifica_pagina($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		redirect('admin/pagine/modifica/'.$id,2);
               
	
	
	}
/**
 * CANCELLAZIONE DATABASE
 *
 * Cancello la pagina dal database.
 *
 */	
	public function elimina($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Pagineclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Pagineclass->cancella_pagina($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIORNO POSIZIONI
 *
 * Cancello la pagina dal database.
 *
 */	
	public function aggiorno_pos()
	{
		
		$this->load->model('Pagineclass', '', TRUE);
		$ordine=$this->input->post('ordine');
		$this->Pagineclass->update_posizione($ordine);
		

		
	}
/**
 * AGGIUNGO LA CATEGORIA
 *
 * 
 *
 */		
	public function aggiungicat()
	{
		
			
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);


	    $data['info']  = $this->Generals->informazionibase();
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/aggiungicat.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA PAGINA CAT  DATABASE
 *
 * Controller per inserire a database la news e visualizzare la view di risposta.
 *
 */		
	public function aggiungicatdb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della News */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Pagineclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Pagineclass->inserisci_catpagina();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
	
	public function listacat()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Pagineclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_cat'] = $this->Pagineclass->lista_catpagine();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/listacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
	
	public function modificacat($id)
	{
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Pagineclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['catpagine'] = $this->Pagineclass->dati_catpagina($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/modificacat.php', $data);
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
	    $this->load->model('Pagineclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->Pagineclass->modifica_catpagina($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/confermamodificacat.php', $data);
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
	    $this->load->model('Pagineclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Pagineclass->cancella_paginacat($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/pagine/confermacancellazionecat.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */