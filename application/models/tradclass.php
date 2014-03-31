<?php
class Tradclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getTraduzioni($id){
 
 	$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo' => $id));   
 	return $query->result();	
    	
    }
    
    function ins_traduzione(){
    	
    	$this->progressivo=$this->input->post('progressivo');
    	$this->lang=$this->input->post('lang');
    	$this->messaggio=$this->input->post('messaggio');
    	/* Controllo se � gi� presente la traduzione */
    	$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo' => $this->progressivo, 'lang' => $this->lang));
    	$quantita=$query->num_rows();
    	
    	
    	
    	/* Se � gi� presente aggiorno, altrimenti la inserisco */
    	if ($quantita>0)
    	$query = $this->db->update($this->config->item('prefix').'messaggi',$this,Array('progressivo' => $this->progressivo, 'lang' => $this->lang));
    	else
    	$query = $this->db->insert($this->config->item('prefix').'messaggi',$this);
    	
		/* Ritorno il risultato dell'inserimento */
    	return $query;

    	
    	
    }
    
}