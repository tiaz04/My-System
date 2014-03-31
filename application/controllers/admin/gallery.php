<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery extends CI_Controller {

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
 * Gallery
 *
 * Controller per la pagina principale dove verr� visualizzata la lista delle gallery.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Galleryclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_gallery'] = $this->Galleryclass->getGalleryList();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/gallery/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO GALLERY
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
		$this->load->view('admin/gallery/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA GALLERY DATABASE
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
	    $this->load->model('Galleryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Galleryclass->inserisci_gallery();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/gallery/confermainserimento.php', $data);
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
	    $this->load->model('Galleryclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['gallery'] = $this->Galleryclass->dati_gallery($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/gallery/modifica.php', $data);
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
	    $this->load->model('Galleryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->Galleryclass->modifica_gallery($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/gallery/confermamodifica.php', $data);
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
	    $this->load->model('Galleryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Galleryclass->cancella_gallery($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/gallery/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * GESTIONE IMMAGINI
 *
 * Mostra le immagini e processa l'inserimento.
 *
 */
	public function ajaxgall_list($id)
	{
	if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
		
		 $this->load->model('Generals', '', TRUE);
	    $this->load->model('Galleryclass', '', TRUE);
	    $this->load->model('Uploadclass','',TRUE);
	    
	    $data['lista_file'] = $this->Uploadclass->lista_file('gallery',$id);
 		$data['info_gallery'] = $this->Galleryclass->dati_gallery($id);
	    $this->load->view('admin/uploads/ajax_gallery.php',$data);
	}
	
	public function gestione_immagini($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->library('image_moo');
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Galleryclass', '', TRUE);
	    $this->load->model('Uploadclass','',TRUE);

	    $data['tipo_upload']="gallery";
	    $data['info']  = $this->Generals->informazionibase();   
	    
		// GESTISCE L'INSERIMENTO DEL FILE
		if (isset($_REQUEST['submitting'])){
		$data['modifiche'] = $this->Uploadclass->add_file('gallery',$id);
		$data['ins_multiplo'] = 1;
		}
		
		if (isset($_POST['modify_sin'])){
		$data['modifiche_file'] = $this->Uploadclass->get_file($_POST['mod'][0]);			
		$data['modifiche'] = $this->Uploadclass->lista_file_modificare($_POST['mod']);	
		$data['ins_multiplo'] = 0;
		}
		
		if (isset($_POST['delete'])){
		$data['cancella_res'] = $this->Uploadclass->del_file($_POST['delete']);			
		}
		
		// GESTISCE LA MODIFICA DEL FILE
		if (isset($_POST['modify'])){
		$data['modifiche_res'] = $this->Uploadclass->upd_file('gallery',$id);
		}
		
		$data['lista_file'] = $this->Uploadclass->lista_file('gallery',$id);
 		$data['info_gallery'] = $this->Galleryclass->dati_gallery($id);
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/gallery/gestione_immagini.php', $data);
		if ((isset($_REQUEST['submitting']))||(isset($_POST['modify_sin']))){
			$this->load->view('admin/uploads/inserisci_info_gallery.php',$data);		
		}
		
		$this->load->view('admin/uploads/lista_file_gallery.php',$data);
                $this->load->view('admin/uploads/aggiungi.php');
		$this->load->view('template/adminfooter', $data);
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */