<?php

class Galleryclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getGalleryList() {
    	$query=$this->db->query('SELECT *, (SELECT COUNT(*) FROM '.$this->config->item('prefix').'file WHERE tipo_ref = "gallery" AND id_ref = '.$this->config->item('prefix').'gallery.id_gallery) as n_file FROM '.$this->config->item('prefix').'gallery');
    	return $query->result();
    	
    	
    }
    
  	function inserisci_gallery(){
    	
    	   
    	$this->nome   = $_POST['nome']; // please read the below note
        $this->descrizione = $_POST['descrizione'];


        $risultato=$this->db->insert($this->config->item('prefix').'gallery', $this);    
               
        return $risultato;

	}
	
	function modifica_gallery($id){
		
    	$this->nome   = $_POST['nome']; // please read the below note
        $this->descrizione = $_POST['descrizione'];
        
		$risultato=$this->db->update($this->config->item('prefix').'gallery',$this, array('id_gallery' => $id));
		
		return $risultato;
	}
	
	function dati_gallery($id){
		
		$query = $this->db->get_where($this->config->item('prefix').'gallery',Array('id_gallery'=>$id));
		return $query->result();
	
	
	}
	
	function getGalleryCont($id) {
		
		$query = $this->db->get_where($this->config->item('prefix').'gallery',Array('id_gallery'=>$id));
		$risultato=$query->result();
		$risultato['lista_file']=$this->Uploadclass->lista_file('gallery',$id);
		
		return $risultato;
		
	}
	
	function cancella_gallery($id){
		
		return $this->db->delete($this->config->item('prefix').'gallery',array('id_gallery' => $id));
		
	}
    
}
?>