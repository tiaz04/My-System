<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Traduzioni extends CI_Controller {

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
	 * Controller per la pagina principale dove verr� visualizzata la lista delle video.
	 *
	 */
	public function index($valore)
	{

			
	}

	public function lista($sezione){

		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  

	  
		$this->load->model('Generals', '', TRUE);
		$this->load->model('Pagineclass', '', TRUE);
		$this->load->model('Newsclass', '', TRUE);
                $this->load->model('Pressclass', '', TRUE);
                $this->load->model('Blogclass', '', TRUE);
		$this->load->model('Eventiclass', '', TRUE);
		$this->load->model('Faqclass', '', TRUE);
		$this->load->model('Glossaryclass', '', TRUE);
		$this->load->model('Tarifsclass', '', TRUE);
		$this->load->model('FileGalleryclass', '', TRUE);
		$this->load->model('UploadClass', '', TRUE);
		$this->load->model('Packclass', '', TRUE);
		$this->load->library('table');

		$data['info']  = $this->Generals->informazionibase();

		if ($sezione=='pagine')
		$data['lista_pagine'] = $this->Pagineclass->lista_pagine();
		if ($sezione=='news')
		$data['lista_news'] = $this->Newsclass->lista_news();
                if ($sezione=='blog')
		$data['lista_blog'] = $this->Blogclass->lista_blog();
                if ($sezione=='press')
		$data['lista_press'] = $this->Pressclass->lista_press();
		if ($sezione=='eventi')
		$data['lista_eventi'] = $this->Eventiclass->lista_eventi();
		if ($sezione=='glossario')
		$data['lista_glossario'] = $this->Glossaryclass->lista_glossario();
		if ($sezione=='faq')
		$data['lista_faq'] = $this->Faqclass->lista_faq();
                if ($sezione=='catfaq')
		$data['lista_catfaq'] = $this->Faqclass->lista_catfaq();
		if ($sezione=='tariffe')
		$data['lista_tariffe'] = $this->Tarifsclass->lista_tariffe();
		if ($sezione=='pacchetti')
		$data['lista_pacchetti'] = $this->Packclass->lista_pacchetti();
		if ($sezione=='filegallery')
		$data['lista_filegallery'] = $this->UploadClass->dati_filelist("",0,Array("file","ext_file"));
                
                
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/traduzioni/lista.php', $data);
		$this->load->view('template/adminfooter', $data);


	}

	public function gest_elemento($sezione,$id){

		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  


		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tradclass', '', TRUE);
		$this->load->model('Pagineclass', '', TRUE);
		$this->load->model('Newsclass', '', TRUE);
                $this->load->model('Pressclass', '', TRUE);
                $this->load->model('Blogclass', '', TRUE);
		$this->load->model('Eventiclass', '', TRUE);
		$this->load->model('Faqclass', '', TRUE);
		$this->load->model('Galleryclass', '', TRUE);
		$this->load->model('FileGalleryclass', '', TRUE);
		$this->load->model('UploadClass', '', TRUE);
		$this->load->model('Glossaryclass', '', TRUE);
		$this->load->model('Tarifsclass', '', TRUE);
		$this->load->model('Packclass', '', TRUE);


		$this->load->library('table');

		$data['info']  = $this->Generals->informazionibase();


	  
		$this->load->view('template/adminheader', $data);
		if ($sezione=='pagine'){
			$data['pagina'] = $this->Pagineclass->dati_pagina($id,1);
			$data['elementi'] = $this->Pagineclass->getModuli($id,1,1);
			$this->load->view('admin/traduzioni/trad_pagine.php', $data);
		}if ($sezione=='news'){
			$data['elementi'] = $this->Newsclass->dati_news($id,1);
			$this->load->view('admin/traduzioni/trad_news.php', $data);
                }if ($sezione=='blog'){
			$data['elementi'] = $this->Blogclass->dati_blog($id,1);
			$this->load->view('admin/traduzioni/trad_blog.php', $data);
                }if ($sezione=='press'){
			$data['elementi'] = $this->Pressclass->dati_press($id,1);
			$this->load->view('admin/traduzioni/trad_press.php', $data);
		}if ($sezione=='evento'){
			$data['elementi'] = $this->Eventiclass->dati_evento($id,1);
			$this->load->view('admin/traduzioni/trad_eventi.php', $data);
		}if ($sezione=='faq'){
			$data['elementi'] = $this->Faqclass->dati_faq($id,1);
			$this->load->view('admin/traduzioni/trad_faq.php', $data);
		}if ($sezione=='catfaq'){
			$data['elementi'] = $this->Faqclass->dati_catfaq($id,1);
			$this->load->view('admin/traduzioni/trad_catfaq.php', $data);
		}if ($sezione=='glossario'){
			$data['elementi'] = $this->Glossaryclass->dati_glossario($id,1);
			$this->load->view('admin/traduzioni/trad_glossario.php', $data);
		}if ($sezione=='tariffe'){
			$data['elementi'] = $this->Tarifsclass->dati_tariffa($id,1);
			$this->load->view('admin/traduzioni/trad_tariffe.php', $data);
		}if ($sezione=='pacchetti'){
			$data['elementi'] = $this->Packclass->dati_pacchetto($id,1);
			$this->load->view('admin/traduzioni/trad_pacchetti.php', $data);
		}if ($sezione=='filegallery'){
			$data['elementi'] = $this->UploadClass->get_file($id,1);
			
			$this->load->view('admin/traduzioni/trad_filegallery.php', $data);
		}
		
		
		$this->load->view('template/adminfooter', $data);


	}

	public function ins_traduzione(){

		$this->load->model('Tradclass', '', TRUE);
		$risultato=$this->Tradclass->ins_traduzione();

		if ($risultato==1)
		echo "<div id=\"ris_traduzione\">Messaggio aggiornato con successo</div>";
		else
		echo "<div id=\"ris_traduzione\">Errore nell'inserimento del messaggio</div>";

	}


}