<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Eventi extends CI_Controller {

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
 * EVENTI
 *
 * Controller per la pagina principale dove verr� visualizzata la lista delle news.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Eventiclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_eventi'] = $this->Eventiclass->lista_eventi();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/eventi/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO EVENTI
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

	    $data['catlist'] = $this->Categoryclass->getCatList();
	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
	    $data['info']  = $this->Generals->informazionibase();   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/eventi/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA EVENTI DATABASE
 *
 * Controller per inserire a database la news e visualizzare la view di risposta.
 *
 */		
	public function aggiungidb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della Eventi */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Eventiclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    $config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		
		$this->load->library('upload', $config);
	    
		if ( $this->upload->do_upload())
		{
			$data_img = array('upload_data' => $this->upload->data());
		}else{
			$error = array('error' => $this->upload->display_errors());
			$data_img="";
			
		}
		
	    
	    $data['risultato_inserimento']=$this->Eventiclass->inserisci_evento($data_img);
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/eventi/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
/**
 * MODIFICA EVENTI 
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
	    $this->load->model('Galleryclass','',TRUE);
	    $this->load->model('Eventiclass','',TRUE);

	    $data['gallerylist'] = $this->Galleryclass->getGalleryList();
	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['evento'] = $this->Eventiclass->dati_evento($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/eventi/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * MODIFICA EVENTI DATABASE
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
	    $this->load->model('Eventiclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();

		$config['upload_path'] = './uploads/';
		$config['allowed_types'] = 'gif|jpg|jpeg|png';
		
		$this->load->library('upload', $config);
	    
		if ( $this->upload->do_upload())
		{
			$data_img = array('upload_data' => $this->upload->data());
		}else{
			$error = array('error' => $this->upload->display_errors());
			$data_img="";
			
		}
		
	    
	    
	    $data['risultato_inserimento']=$this->Eventiclass->modifica_evento($id,$data_img);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/eventi/confermamodifica.php', $data);
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
	    $this->load->model('Eventiclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Eventiclass->cancella_evento($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/eventi/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}

	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */