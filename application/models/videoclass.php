<?php

class Videoclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getVideoList() {
    	$query=$this->db->query('SELECT *, (SELECT COUNT(*) FROM '.$this->config->item('prefix').'file WHERE tipo_ref = "video" AND id_ref = '.$this->config->item('prefix').'videogallery.id_videogallery) as n_file FROM '.$this->config->item('prefix').'videogallery');
    	return $query->result();
    	
    }
    
  	function inserisci_videogallery(){
    	
    	   
    	$this->nome   = $_POST['nome']; // please read the below note
        $this->descrizione = $_POST['descrizione'];


        $risultato=$this->db->insert($this->config->item('prefix').'videogallery', $this);    
               
        return $risultato;

	}
	
	function modifica_videogallery($id){
		
    	$this->nome   = $_POST['nome']; // please read the below note
        $this->descrizione = $_POST['descrizione'];
        
		$risultato=$this->db->update($this->config->item('prefix').'videogallery',$this, array('id_videogallery' => $id));
		
		return $risultato;
	}
	
	function dati_videogallery($id){
		
		$query = $this->db->get_where($this->config->item('prefix').'videogallery',Array('id_videogallery'=>$id));
		return $query->result();
	
	
	}
	
	function getVideogalleryCont($id,$limit = '') {
		$query = $this->db->get_where($this->config->item('prefix').'videogallery',Array('id_videogallery'=>$id),$limit);
		$risultato=$query->result();
		$risultato['lista_file']=$this->Uploadclass->lista_file(Array('video','video_youtube','video_vimeo'),$id);
		
		return $risultato;
		
	}
	
	function cancella_videogallery($id){
		
		return $this->db->delete($this->config->item('prefix').'videogallery',array('id_videogallery' => $id));
		
	}
    
}
?>