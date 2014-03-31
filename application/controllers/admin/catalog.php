<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Catalog extends CI_Controller {

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
 * NEWS
 *
 * Controller per la pagina principale dove verr� visualizzata la lista delle catalog.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_catalog'] = $this->Catalogclass->lista_catalog();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/index.php', $data);
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
	    $this->load->model('Categoryclass','',TRUE);
	    $this->load->model('Galleryclass','',TRUE);

	    $data['catlist'] = $this->Categoryclass->getCatCatalogList();
	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
	    $data['info']  = $this->Generals->informazionibase();   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA NEWS DATABASE
 *
 * Controller per inserire a database la catalog e visualizzare la view di risposta.
 *
 */		
	public function aggiungidb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della Catalog */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->library('image_moo');
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|pdf';
		
		$this->load->library('upload', $config);
                
                
	    
		if ( $this->upload->do_upload())
		{
			$data_img = array('upload_data' => $this->upload->data());
		}else{
			$error = array('error' => $this->upload->display_errors());
			$data_img="";
			
		}
		
		
		
	    
	    $data['risultato_inserimento']=$this->Catalogclass->inserisci_catalog($data_img);
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
/**
 * MODIFICA NEWS 
 *
 * Controller per modificare la catalog e visualizzare il form di modifica.
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
	    $this->load->model('Catalogclass','',TRUE);

	    $data['catlist'] = $this->Categoryclass->getCatCatalogList();
	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['catalog'] = $this->Catalogclass->dati_catalog($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA NEWS DATABASE
 *
 * Controller per modificare a database la catalog e visualizzare la view di risposta.
 *
 */		
	public function modificadb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    $this->load->library('image_moo');
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|zip|rar|doc|docx|xls|xlsx|ppt|pptx|pdf';
		
		$this->load->library('upload', $config);
	    
		if ( $this->upload->do_upload())
		{
			$data_img = array('upload_data' => $this->upload->data());
		}else{
			$error = array('error' => $this->upload->display_errors());
			$data_img="";
			
		}
		
	    
	    
	    $data['risultato_inserimento']=$this->Catalogclass->modifica_catalog($id,$data_img);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	}
/**
 * CANCELLAZIONE DATABASE
 *
 * Cancello la catalog dal database.
 *
 */	
	public function elimina($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Catalogclass->cancella_catalog($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
        
        public function aggiungicat()
	{
		
			
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass','',TRUE);
            
            $data['lista_cat'] = $this->Catalogclass->lista_catcatalog(); 


	    $data['info']  = $this->Generals->informazionibase();
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/aggiungicat.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
        
        public function aggiungicatdb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della Catalog */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Catalogclass->inserisci_catcatalog();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
	
	public function listacat()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_cat'] = $this->Catalogclass->lista_catcatalog();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/listacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
	
	public function modificacat($id)
	{
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  
            
            $data['lista_cat'] = $this->Catalogclass->lista_catcatalog(); 


	    
	    $data['catpagine'] = $this->Catalogclass->dati_catcatalog($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/modificacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA NEWS DATABASE
 *
 * Controller per modificare a database la catalog e visualizzare la view di risposta.
 *
 */		
	public function modificacatdb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->Catalogclass->modifica_catcatalog($id);
            
           
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/confermamodificacat.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	}
/**
 * CANCELLAZIONE DATABASE
 *
 * Cancello la catalog dal database.
 *
 */	
	public function eliminacat($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Catalogclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Catalogclass->cancella_catalogcat($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/catalog/confermacancellazionecat.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */