<?

class Pagineclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function inserisci_messaggio($lastid,$array) {
    	
    	foreach ($array as $arr){
    		$data->messaggio = $this->input->post($arr);
			$data->lang = "it";
			$query = $this->db->insert($this->config->item('prefix').'messaggi',$data);
    		
    		$id=$this->db->insert_id();
    		$this->db->query('UPDATE '.$this->config->item('prefix').'pagine SET lang_'.$arr.' = '.$id.' WHERE id_pagina = '.$lastid.'');
    		
    	}
    	
    }
    
    function inserisci_messaggiocat($lastid,$array) {
    	
    	foreach ($array as $arr){
    		$data->messaggio = $this->input->post($arr);
			$data->lang = "it";
			$query = $this->db->insert($this->config->item('prefix').'messaggi',$data);
    		$id=$this->db->insert_id();
    		$this->db->query('UPDATE '.$this->config->item('prefix').'pagine_cat SET lang_'.$arr.' = '.$id.' WHERE id_paginecat = '.$lastid.'');
    		
    	}
    	
    }
    
    function inserisci_messaggio_modulo($lastid,$array) {
    	
    	foreach ($array as $arr){
    		
    		$valori->messaggio=$this->input->post('contenuto');
    		$valori->lang='it';
    		$this->db->insert($this->config->item('prefix').'messaggi',$valori);
    		$id=$this->db->insert_id();
    		$this->db->query('UPDATE '.$this->config->item('prefix').'pagine_moduli SET lang_'.$arr.' = '.$id.' WHERE id_paginemodulo = '.$lastid.'');
    		
    	}
    	
    }
    
    function aggiorna_messaggio_modulo($lastid,$array) {
    	
    foreach ($array as $arr){
    	
    		$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').'pagine_moduli WHERE id_paginemodulo = '.$lastid.'');
    		$row = $query->row(); 
    		$suffisso='lang_'.$arr;
    		$progressivo=$row->$suffisso;  	
    		$valori->messaggio=$this->input->post('contenuto');
    		$this->db->update($this->config->item('prefix').'messaggi',$valori,Array('progressivo' => $progressivo,'lang' => 'it'));
    		
    	}
    	
    }
    
    function getlastposition($id){
    	
    	$query=$this->db->query('SELECT MAX(posizione) massimo FROM '.$this->config->item('prefix').'pagine_moduli WHERE id_pagina = '.$id);
    	$row = $query->row();
		return ($row->massimo+1);
    	
    }
    
    function getModuli($id,$only_text=0,$inc_traduzioni=0){
    	
    	if ($only_text==1)
    	$add="AND tipologia_contenuto='testo'";
    	else
    	$add = "";
    	
    	$c=0;
    	
    	$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'pagine_moduli WHERE id_pagina = '.$id.' '.$add.' ORDER BY posizione ASC');
   		
    	if ($query->num_rows() > 0)
{
    	foreach ($query->result() as $key => $row)
			{
   				if ($row->tipologia_contenuto=='gallery'){
					$elem[$c]->arrcont=$this->Galleryclass->getGalleryCont($row->id_contenuto);   				
   				}
				if ($row->tipologia_contenuto=='immagine'){
					$elem[$c]->arrcont=$this->Uploadclass->get_file($row->id_contenuto);   				
   				}
                                if ($row->tipologia_contenuto=='file'){
					$elem[$c]->arrcont=$this->Uploadclass->get_file($row->id_contenuto);   				
   				}
			   	if ($row->tipologia_contenuto=='video'){
			   		$elem[$c]->arrcont=$this->Videoclass->getVideogalleryCont($row->id_contenuto);   				
   				}
   				if (($row->tipologia_contenuto=='testo')&&($inc_traduzioni==1)){
   					$elem[$c]->traduzioni=$this->Tradclass->getTraduzioni($row->lang_contenuto);
   					
   				}
   				$elem[$c]->tipologia_contenuto=$row->tipologia_contenuto;
   				$elem[$c]->contenuto=$row->contenuto;
   				$elem[$c]->id_paginemodulo=$row->id_paginemodulo;
   				$elem[$c]->id_pagina=$row->id_pagina;
   				$elem[$c]->posizione=$row->posizione;
   				$elem[$c]->opzioni=$row->opzioni;
   				$elem[$c]->lang_contenuto=$row->lang_contenuto;
   				$c++;
			}
}else{
	return false;
	
}
    	return $elem;
    }
    
    function getModulo($id){
    	
    	$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'pagine_moduli WHERE id_paginemodulo = '.$id.'');
    	return $query->result();
    	
    }
    
    function modifica_modulo() {
    	
    	$id=$this->input->post('modifica_modulo');
    	
    	
    	
    	$this->tipologia_contenuto=$this->input->post('tipo_contenuto');
    	if ($this->input->post('tipo_contenuto')=='testo'){
    		$this->contenuto=$this->input->post('contenuto');
    		$risultato=$this->db->update($this->config->item('prefix').'pagine_moduli', $this, Array('id_paginemodulo' => $id));
    		$this->aggiorna_messaggio_modulo($id,Array('contenuto'));
    	}
        
    	if ($this->input->post('tipo_contenuto')=='gallery'){
    		$this->id_contenuto=$this->input->post('id_gallery');
    		if($this->input->post('solo_link')=='solo_link'){
    			$valjson=Array('solo_link' => TRUE);
    			$this->opzioni=json_encode($valjson);	
    		}
    		$risultato=$this->db->update($this->config->item('prefix').'pagine_moduli', $this, Array('id_paginemodulo' => $id));
    	}
    	
    	if ($this->input->post('tipo_contenuto')=='video'){
    		
    		
    			$this->id_contenuto=$this->input->post('id_gallery');
    			if($this->input->post('solo_link')=='solo_link'){
    			$valjson=Array('solo_link' => TRUE);
    			$this->opzioni=json_encode($valjson);	
    			}
    			$risultato=$this->db->update($this->config->item('prefix').'pagine_moduli', $this, Array('id_paginemodulo' => $id));
    		
    		

    	}
    	
    	return $risultato;
    	

    	
    }
    
    function inserisci_modulo($id){
    	
    	$this->id_pagina=$id;
    	$this->posizione=$this->getlastposition($id);
    	$this->tipologia_contenuto=$this->input->post('tipologia_contenuto');
    	
    	if ($this->input->post('tipologia_contenuto')=='testo'){
    		$this->contenuto=$this->input->post('contenuto');
    		$risultato=$this->db->insert($this->config->item('prefix').'pagine_moduli', $this);
    		$lastid=$this->db->insert_id();
    		$this->inserisci_messaggio_modulo($lastid,Array('contenuto'));
    	}
        
    	if ($this->input->post('tipologia_contenuto')=='gallery'){
    		$this->id_contenuto=$this->input->post('id_gallery');
    		if($this->input->post('solo_link')=='solo_link'){
    			$valjson=Array('solo_link' => TRUE);
    			$this->opzioni=json_encode($valjson);	
    		}
    		$risultato=$this->db->insert($this->config->item('prefix').'pagine_moduli', $this);
    	}
    	
    	if ($this->input->post('tipologia_contenuto')=='video'){
    		
    		
    			$this->id_contenuto=$this->input->post('id_videogallery');
    			if($this->input->post('solo_link')=='solo_link'){
    			$valjson=Array('solo_link' => TRUE);
    			$this->opzioni=json_encode($valjson);	
    			}
    			$risultato=$this->db->insert($this->config->item('prefix').'pagine_moduli', $this);
    		
    		

    	}
    	
    if ($this->input->post('tipologia_contenuto')=='immagine'){
    		
    		
    			$this->id_contenuto=$this->input->post('imagegallery');
    			
    			$risultato=$this->db->insert($this->config->item('prefix').'pagine_moduli', $this);
    		
    		

    	}
        
        if ($this->input->post('tipologia_contenuto')=='file'){
    		
    		
    			$this->id_contenuto=$this->input->post('filegallery');
    			
    			$risultato=$this->db->insert($this->config->item('prefix').'pagine_moduli', $this);
    		
    		

    	}
    	
    	return $risultato;
    	
    }

    function modifica_messaggio($lastid,$array) {
        
        
    	
    foreach ($array as $arr){
        
        $data = new stdClass();
    	
    		$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').'pagine WHERE id_pagina = '.$lastid.'');
    		$row = $query->row(); 
                
    		$suffisso='lang_'.$arr;
    		
                
                $progressivo=$row->$suffisso;  
                
        
                
    		$data->messaggio = $this->input->post($arr)!="" ? $this->input->post($arr) : "";
		
                $query2 = $this->db->update($this->config->item('prefix').'messaggi',$data,Array('progressivo' => $progressivo, 'lang' => "it"));
		
    	}
    	
    }
    
function modifica_messaggiocat($lastid,$array) {
    	
    foreach ($array as $arr){
    	
    		$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').'pagine_cat WHERE id_paginecat = '.$lastid.'');
    		$row = $query->row(); 
    		$suffisso='lang_'.$arr;
    		$progressivo=$row->$suffisso; 
    		$data->messaggio = $this->input->post($arr);
			$query = $this->db->update($this->config->item('prefix').'messaggi',$data,Array('progressivo' => $progressivo, 'lang' => "it"));
		
    	}
    	
    }
    
    function inserisci_pagina(){
    	
    	   
    	$this->nome   = $this->input->post('nome'); // please read the below note
        $this->descrizione = $this->input->post('descrizione');
        $this->titolo = $this->input->post('titolo');
        $this->id_cat = $this->input->post('id_cat');
        $this->modifica = mktime();
        $this->header_img = $this->input->post('header_img');
        $this->pagina_padre = $this->input->post('pagina_padre');
        $this->hideInMenu = $this->input->post('hideInMenu');
        $this->hidelink = $this->input->post('hidelink');
        $this->order = $this->input->post('order');
        $this->template = $this->input->post('template');
        $this->directLink = $this->input->post('directLink');
        $this->id_faqcat = $this->input->post('id_faqcat');
        $this->nome_rewrite = url_title(character_limiter($this->nome, 20), 'underscore', TRUE);

        $risultato=$this->db->insert($this->config->item('prefix').'pagine', $this);    
        $lastid=$this->db->insert_id();
        
        $this->inserisci_messaggio($lastid,Array('nome','descrizione','titolo'));
        
        return $risultato;

	}
	
    function inserisci_catpagina(){
    	
    	   
    	$this->nome   = $this->input->post('nome'); // please read the below note
        $this->cat_rewrite = url_title(character_limiter($this->nome, 20), 'underscore', TRUE);

        $risultato=$this->db->insert($this->config->item('prefix').'pagine_cat', $this);    
        $lastid=$this->db->insert_id();
        
        $this->inserisci_messaggiocat($lastid,Array('nome'));
        
        return $risultato;

	}
	
	function lista_catpagine(){
	
		$query = $this->db->get($this->config->item('prefix').'pagine_cat');
		return $query->result();	
	}
	
	function lista_pagine(){
		$this->db->order_by('order','asc');
		$query = $this->db->get($this->config->item('prefix').'pagine');
		$c=0;
		if ($query->num_rows() > 0)
{
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($elem[$c]->id_cat!=0){
			$query2=$this->db->get_where($this->config->item('prefix').'pagine_cat',Array('id_paginecat'=>$elem[$c]->id_cat));
			$row2 = $query2->row();
			
			$elem[$c]->cat_pagina = $row2->nome;
			}else{
				$elem[$c]->cat_pagina = "";
				
			}
			$c++;

		}
}else{
return false;	

}
		return $elem;	
	}
	
	function dati_pagina($id,$inc_traduzioni=0){
		
	
		
		$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'pagine WHERE id_pagina = '.$id);
		//return $query->result();
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($inc_traduzioni==1){
			$elem[$c]->nome_traduzioni = $this->getPagtraduzioni($elem[$c]->lang_nome);
			$elem[$c]->descrizione_traduzioni = $this->getPagtraduzioni($elem[$c]->lang_descrizione);
			$elem[$c]->titolo_traduzioni = $this->getPagtraduzioni($elem[$c]->lang_titolo);
			}
		}
		return $elem;
		
		
	
	
	}
	
	function dati_catpagina($id,$inc_traduzioni=0){
		
	
		
		$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'pagine_cat WHERE id_paginecat = '.$id);
		//return $query->result();
		$c=0;
		if ($query->num_rows() > 0)
{
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($inc_traduzioni==1){
			$elem[$c]->nome_traduzioni = $this->getPagtraduzioni($elem[$c]->lang_nome);
			}
		}
}else{
	return false;
	
}
		return $elem;
		
		
	
	
	}
	
	
	
	function getPagtraduzioni($id) {

		$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo'=>$id));
		return $query->result();

	}
	
	function modifica_pagina($id){
		
    	$this->nome   = $this->input->post('nome'); // please read the below note
        $this->descrizione = $this->input->post('descrizione');
        $this->titolo = $this->input->post('titolo');
        $this->nome_rewrite = url_title($this->input->post('rewrite'), 'underscore', TRUE);
        $this->id_cat = $this->input->post('id_cat');
        $this->pagina_padre = $this->input->post('pagina_padre');
        $this->hideInMenu = $this->input->post('hideInMenu');
        $this->hidelink = $this->input->post('hidelink');
        $this->order = $this->input->post('order');
        $this->template = $this->input->post('template');
        $this->directLink = $this->input->post('directLink');
        $this->modifica = mktime();
        $this->header_img = $this->input->post('header_img');
        $this->id_faqcat = $this->input->post('id_faqcat');
        
		$risultato=$this->db->update($this->config->item('prefix').'pagine',$this, array('id_pagina' => $id));
		
		$this->modifica_messaggio($id,Array('nome','descrizione','titolo'));
		
				
		return $risultato;
	}
	
	function modifica_catpagina($id){
		
    	$this->nome   = $this->input->post('nome'); // please read the below note
    	$this->cat_rewrite = $this->input->post('rewrite');
		$this->cat_rewrite = url_title($this->cat_rewrite, 'underscore', TRUE);
        
		$risultato=$this->db->update($this->config->item('prefix').'pagine_cat',$this, array('id_paginecat' => $id));
		
		$this->modifica_messaggiocat($id,Array('nome'));
		
				
		return $risultato;
	}
	
	function cancella_pagina($id){
		
		return $this->db->delete($this->config->item('prefix').'pagine',array('id_pagina' => $id));
		
	}
	
	function cancella_paginacat($id){
		
		return $this->db->delete($this->config->item('prefix').'pagine_cat',array('id_paginecat' => $id));
		
	}
	
	function update_posizione($array){
		
		foreach ($array as $position => $item) :
		$item = explode('_',$item);
		
		$this->posizione = $position;
		$this->db->update($this->config->item('prefix').'pagine_moduli',$this,Array('id_paginemodulo' => $item[1]));

		endforeach;
	}
	
	function del_modulo(){
		$id=$this->input->post('del_sin');
		return $this->db->delete($this->config->item('prefix').'pagine_moduli',array('id_paginemodulo' => $id));
	}
    
}

?>