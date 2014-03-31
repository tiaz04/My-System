<?php

class FileGalleryclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getFileGalleryList() {
    	$query=$this->db->query('SELECT *, (SELECT COUNT(*) FROM '.$this->config->item('prefix').'file WHERE tipo_ref = "file" AND id_ref = '.$this->config->item('prefix').'filegallery.id_filegallery) as n_file FROM '.$this->config->item('prefix').'filegallery');
    	return $query->result();
    	
    	
    }
    
  	function inserisci_filegallery(){
    	
    	   
    	$this->nome   = $_POST['nome']; // please read the below note
        $this->descrizione = $_POST['descrizione'];


        $risultato=$this->db->insert($this->config->item('prefix').'filegallery', $this);    
               
        return $risultato;

	}
	
	function modifica_filegallery($id){
		
    	$this->nome   = $_POST['nome']; // please read the below note
        $this->descrizione = $_POST['descrizione'];
        
		$risultato=$this->db->update($this->config->item('prefix').'filegallery',$this, array('id_filegallery' => $id));
		
		return $risultato;
	}
	
	function dati_filegallery($id,$inc_traduzioni=0){
		
		$query = $this->db->get_where($this->config->item('prefix').'filegallery',Array('id_filegallery'=>$id));
		
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($inc_traduzioni==1){
			$elem[$c]->titolo_traduzioni = $this->getNewstraduzioni($elem[$c]->lang_titolo);
			$elem[$c]->descrizione_traduzioni = $this->getNewstraduzioni($elem[$c]->lang_descrizione);
			}
		}
		return $elem;
		
	
	
	}
	
	function getFileGalleryCont($id) {
		
		$query = $this->db->get_where($this->config->item('prefix').'filegallery',Array('id_filegallery'=>$id));
		$risultato=$query->result();
		$risultato['lista_file']=$this->Uploadclass->lista_file('file',$id);
		
		return $risultato;
		
	}
	
	function cancella_filegallery($id){
		
		return $this->db->delete($this->config->item('prefix').'filegallery',array('id_filegallery' => $id));
		
	}
    
}
?>