<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tariffe extends CI_Controller {

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
	 * TARIFFE
	 *
	 * Controller per la pagina principale dove verrˆ visualizzata la lista delle news.
	 *
	 */
	public function index()
	{


		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  
		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass', '', TRUE);
		$this->load->library('table');

		if ($this->input->post('upd_generals')==1)
		$this->Tarifsclass->upd_generals($this->Generals->informazionibase());
	  
		$data['info']  = $this->Generals->informazionibase();

	  
		$data['lista_tariffe'] = $this->Tarifsclass->lista_tariffe();
	  
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/index.php', $data);
		$this->load->view('template/adminfooter', $data);

	}

	public function modifica_periodi($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}

		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass','',TRUE);
		$this->load->library('table');
	  
		if ($this->input->post("ins_periodo")){

			$data['risultato_inserimento']=$this->Tarifsclass->aggiungi_periodo($id);
		}

		if ($this->input->post("mod_periodo")){

			$data['risultato_inserimento']=$this->Tarifsclass->modifica_periodo($id);
		}


		$data['info']  = $this->Generals->informazionibase();
	  
		$data['tariffa'] = $this->Tarifsclass->dati_tariffa($id);
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/gest_periodi.php', $data);
		$this->load->view('template/adminfooter', $data);

	}

	public function modifica_righe($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}

		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass','',TRUE);
		$this->load->library('table');
	  
		if ($this->input->post("ins_riga")){

			$data['risultato_inserimento']=$this->Tarifsclass->aggiungi_riga($id);
		}

		if ($this->input->post("mod_riga")){

			$data['risultato_inserimento']=$this->Tarifsclass->modifica_riga($id);
		}


		$data['info']  = $this->Generals->informazionibase();
	  
		$data['tariffa'] = $this->Tarifsclass->dati_tariffa($id);
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/gest_righe.php', $data);
		$this->load->view('template/adminfooter', $data);

	}

	public function modifica($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  
		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass','',TRUE);
		$this->load->library('table');

		$data['info']  = $this->Generals->informazionibase();

	  
		$data['tariffa'] = $this->Tarifsclass->dati_tariffa($id);
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);

	}

	public function modificadb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  
		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass', '', TRUE);

		$data['info']  = $this->Generals->informazionibase();
	  
	  
		$data['risultato_inserimento']=$this->Tarifsclass->modifica_tariffa($id);
		 
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);


	}
	public function aggiungi_tariffa($id = 0)
	{

		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  
		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass', '', TRUE);

		$data['info']  = $this->Generals->informazionibase();
		if ($id!=0)
	  	$data['tariffa'] = $this->Tarifsclass->dati_tariffa($id);
	  	else
	  	$data['tariffa'] = 0;
		 
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/aggiungi_tariffa.php', $data);
		$this->load->view('template/adminfooter', $data);

	}
	
	public function aggiungi_tariffa_db()
	{
		if ($this->session->userdata('logged_in') != TRUE)
		{

			redirect('login/index');
		}
	  
		$this->load->model('Generals', '', TRUE);
		$this->load->model('Tarifsclass', '', TRUE);
		
		$data['info']  = $this->Generals->informazionibase();
		
		$data['risultato_inserimento']=$this->Tarifsclass->inserisci_tariffa();
		 
	  
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/tariffe/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
		
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */