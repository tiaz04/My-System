<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Filegallery extends CI_Controller {

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
	    $this->load->model('FileGalleryclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_filegallery'] = $this->FileGalleryclass->getFileGalleryList();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/filegallery/index.php', $data);
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
		$this->load->view('admin/filegallery/aggiungi.php', $data);
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
	    $this->load->model('FileGalleryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->FileGalleryclass->inserisci_filegallery();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/filegallery/confermainserimento.php', $data);
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
	    $this->load->model('FileGalleryclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['gallery'] = $this->FileGalleryclass->dati_filegallery($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/filegallery/modifica.php', $data);
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
	    $this->load->model('FileGalleryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->FileGalleryclass->modifica_filegallery($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/filegallery/confermamodifica.php', $data);
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
	    $this->load->model('FileGalleryclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->FileGalleryclass->cancella_filegallery($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/filegallery/confermacancellazione.php', $data);
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
	    $this->load->model('FileGalleryclass', '', TRUE);
	    $this->load->model('Uploadclass','',TRUE);
	    
	    $data['lista_file'] = $this->Uploadclass->lista_file(Array('file','ext_file'),$id);
 		$data['info_gallery'] = $this->FileGalleryclass->dati_filegallery($id);
                
                
                
	    $this->load->view('admin/uploads/ajax_filegallery.php',$data);
	}
	
	public function gestione_file($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->library('image_moo');
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('FileGalleryclass', '', TRUE);
	    $this->load->model('Uploadclass','',TRUE);

	    $data['tipo_upload']="file";
	    $data['info']  = $this->Generals->informazionibase();   
	    
		// GESTISCE L'INSERIMENTO DEL FILE
		if (isset($_REQUEST['submitting'])){
		$data['modifiche'] = $this->Uploadclass->add_file('file',$id);
		$data['ins_multiplo'] = 1;
		}
                
                // GESTISCE L'INSERIMENTO DEL FILE TRAMITE UN COLLEGAMENTO ESTERNO
		if (isset($_POST['file_link'])){
			if ($_POST['file_link']==3)
			{
			$data['modifiche'] = $this->Uploadclass->add_file('ext_file',$id);
			$data['ins_multiplo'] = 1;
			}
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
		$data['modifiche_res'] = $this->Uploadclass->upd_file('file',$id);
		}
		
		$data['lista_file'] = $this->Uploadclass->lista_file(Array('file','ext_file'),$id);
                
 		$data['info_filegallery'] = $this->FileGalleryclass->dati_filegallery($id);
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/filegallery/gestione_file.php', $data);
		if ((isset($_REQUEST['submitting']))||(isset($_POST['modify_sin']))||(isset($_POST['file_link']))){
			$this->load->view('admin/uploads/inserisci_info_filegallery.php',$data);		
		}
		
		$this->load->view('admin/uploads/lista_file_filegallery.php',$data);
                $this->load->view('admin/uploads/aggiungi.php');
		$this->load->view('template/adminfooter', $data);
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */