<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Video extends CI_Controller {

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
 * video
 *
 * Controller per la pagina principale dove verrˆ visualizzata la lista delle video.
 *
 */		
	public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Videoclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_video'] = $this->Videoclass->getVideoList();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/video/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
/**
 * INSERIMENTO video
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
		$this->load->view('admin/video/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * AGGIUNTA video DATABASE
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
	    $this->load->model('Videoclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Videoclass->inserisci_videogallery();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/video/confermainserimento.php', $data);
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
	    $this->load->model('Videoclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['videogallery'] = $this->Videoclass->dati_videogallery($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/video/modifica.php', $data);
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
	    $this->load->model('Videoclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->Videoclass->modifica_videogallery($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/video/confermamodifica.php', $data);
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
	    $this->load->model('Videoclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Videoclass->cancella_videogallery($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/video/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
/**
 * GESTIONE IMMAGINI
 *
 * Mostra le immagini e processa l'inserimento.
 *
 */
	
	public function gestione_video($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->library('image_moo');

	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Videoclass', '', TRUE);
	    $this->load->model('Uploadclass','',TRUE);
	    $this->Uploadclass = new Uploadclass();
	    $this->Videoclass = new Videoclass();


	    /* Carico informazioni di base */
	    $data['info']  = $this->Generals->informazionibase();   
	    $data['tipo_upload']="video";
	    
		// GESTISCE L'INSERIMENTO DEL FILE CON RICHIESTA DAL FORM UPLOAD
		if (isset($_REQUEST['submitting'])){
		$data['modifiche'] = $this->Uploadclass->add_file('video',$id);
		$data['ins_multiplo'] = 1;
		}
		
		// GESTISCE L'INSERIMENTO DEL FILE TRAMITE UN COLLEGAMENTO ESTERNO
		if (isset($_POST['file_link'])){
			if ($_POST['file_link']==1)
			{
			$data['modifiche'] = $this->Uploadclass->add_file('video_youtube',$id);
			$data['ins_multiplo'] = 1;
			}else if ($_POST['file_link']==2){
			$data['modifiche'] = $this->Uploadclass->add_file('video_vimeo',$id);
			$data['ins_multiplo'] = 1;	
				
			}
		}
		
		
		// GESTISCE LA MODIFICA DI UN FILE SINGOLO
		if (isset($_POST['modify_sin'])){
		$data['modifiche_file'] = $this->Uploadclass->get_file($_POST['mod'][0]);			
		$data['modifiche'] = $this->Uploadclass->lista_file_modificare($_POST['mod']);	
		$data['ins_multiplo'] = 0;
		}
		
		// GESTISCE LA CANCELLAZIONE DEL FILE
		if (isset($_POST['delete'])){
		$data['cancella_res'] = $this->Uploadclass->del_file($_POST['delete']);			
		}
		
		// GESTISCE LA MODIFICA DEL FILE
		if (isset($_POST['modify'])){
		$data['modifiche_res'] = $this->Uploadclass->upd_file('video',$id);
		}
		
		$data['lista_file'] = $this->Uploadclass->lista_file(Array('video','video_youtube','video_vimeo'),$id);
 		$data['info_videogallery'] = $this->Videoclass->dati_videogallery($id);
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/video/gestione_video.php', $data);
		if ((isset($_REQUEST['submitting']))||(isset($_POST['modify_sin']))||(isset($_POST['file_link']))){
			$this->load->view('admin/uploads/inserisci_info_video.php',$data);		
		}
		$this->load->view('admin/uploads/aggiungi.php');
		$this->load->view('admin/uploads/lista_file_video.php',$data);
		$this->load->view('template/adminfooter', $data);
		
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */