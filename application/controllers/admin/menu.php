<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu extends CI_Controller {
    
    
        public function index()
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Menuclass', '', TRUE);
	    $this->load->library('table');

	    $data['info']  = $this->Generals->informazionibase(); 

	    
	    $data['lista_menu'] = $this->Menuclass->getMenuList();  
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/index.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
        
        
        
        public function gestione_menu($id)
	{

		
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Menuclass', '', TRUE);
            $this->load->model('Pagineclass','',TRUE);

	    $this->load->library('table');
            
            if (isset($_POST['ins_pagina'])){
                
                
                
                $data['risultato_inserimento'] = $this->Menuclass->ins_pagina($_POST['pagina_ins'],$id);
                
            }
            
            if (isset($_POST['del_sin'])){
                
                
                
                $data['risultato_inserimento'] = $this->Menuclass->del_pagina($_POST['del_sin'],$id);
            }

	    $data['info']  = $this->Generals->informazionibase(); 
            $data['lista_pag'] = $this->Pagineclass->lista_pagine();
	    
	    $data['info_menu'] = $this->Menuclass->dati_menu($id); 
            
            $data['lista_elem'] = $this->Menuclass->lista_elem($id);
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/gestione_menu.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
        
        public function aggiorno_pos()
	{
		
		$this->load->model('Menuclass', '', TRUE);
		$ordine=$this->input->post('ordine');
		$this->Menuclass->update_posizione($ordine);
		

		
	}
        
        
        public function aggiungi()
	{
		
			
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/aggiungi.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
        
        
        public function aggiungidb()
	{
		
		/* Controller per la pagina di inserimento in DATABASE della News */
	
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Menuclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Menuclass->inserisci_menu();
	    
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/confermainserimento.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	
	
	}
        
        public function modifica($id)
	{
	    if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Menuclass','',TRUE);

	    $data['info']  = $this->Generals->informazionibase();  


	    
	    $data['menu'] = $this->Menuclass->dati_menu($id);  
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/modifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	}
        
        public function modificadb($id)
	{
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Menuclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
    
	    $data['risultato_inserimento']=$this->Menuclass->modifica_menu($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/confermamodifica.php', $data);
		$this->load->view('template/adminfooter', $data);
	
	
	}
        
        public function elimina($id)
	{
		
		if ($this->session->userdata('logged_in') != TRUE)
	    {
	    	
	        redirect('login/index');
	    }
	    
	    $this->load->model('Generals', '', TRUE);
	    $this->load->model('Menuclass', '', TRUE);

	    $data['info']  = $this->Generals->informazionibase();   
	    
	    
	    $data['risultato_inserimento']=$this->Menuclass->cancella_menu($id);
   
	    
		$this->load->view('template/adminheader', $data);
		$this->load->view('admin/menu/confermacancellazione.php', $data);
		$this->load->view('template/adminfooter', $data);
		
		
	}
        
        
        
}