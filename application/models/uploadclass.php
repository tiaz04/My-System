<?php
class Uploadclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function get_file($id, $inc_traduzioni=0) {
    	
    	
    	
    	$query = $this->db->get_where($this->config->item('prefix').'file',Array('id_file'=>$id));
    	$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($inc_traduzioni==1){
			$elem[$c]->titolo_traduzioni = $this->getUploadtraduzioni($elem[$c]->lang_titolo);
			$elem[$c]->descrizione_traduzioni = $this->getUploadtraduzioni($elem[$c]->lang_descrizione);
			}
		}
		
		return $elem;
    	
    }
    
    function lista_file($referente,$id) {
 		$this->db->select('*')->from($this->config->item('prefix').'file')->where(Array('id_ref'=>$id))->where_in('tipo_ref', $referente)->order_by("ordine", "asc");;
    	$query = $this->db->get();
 		return $query->result();
    	
    }
  /** CARICA IL FILE A DATABASE E RIMANDA AL CONTROLLER I FILE A CUI EFFETTUARE L'ULTIMA MODIFICA */         
    function add_file($referente,$id) {
    	
    	$file_modificati = Array();

    	/* GESTISCO IL CARICAMENTO DEL FILE SE INVIATO TRAMITE BOX UPLOAD */
    	if (isset($_REQUEST['submitting'])){
    $submitting = $_REQUEST['submitting'];
    
	if ($submitting == 'yes') {
	// REQUEST POST INFOS
	foreach ($_REQUEST as $var => $value) {
		if (stripos($var, 'img_SWFUpload_') !== false) {
			if (stripos($var, '_fileName') !== false){
				$img_fileName[] = $value;
			}
		} else {
			$$var = $value;
		}
	}
$c=0;
	foreach ($img_fileName as $i => $value) {
		$query = $this->db->query('SELECT MAX(ordine) as numero FROM '.$this->config->item('prefix').'file WHERE id_ref = '.$id.'');
		$qres = $query->row();
		$this->ordine = $qres->numero +1;
		$this->tipo_file=get_mime_by_extension(upload_url("$img_fileName[$i]"));
		$this->nome_file=$img_fileName[$i];
		$this->tipo_ref=$referente;
		$this->id_ref=$id;
		$this->data_ins=mktime();
		$risultato=$this->db->insert($this->config->item('prefix').'file', $this); 
		$lastid=$this->db->insert_id();
		$this->inserisci_messaggio($lastid,Array('titolo','descrizione'));
		$file_modificati[$c]=$lastid;
		$c++;
		if (strpos($this->tipo_file,'image')!==false){
		$this->processa_img($this->nome_file,$lastid);
		}		
	}
	if ($file_modificati!="")
	return $this->lista_file_modificare($file_modificati);
	else
	return $risultato;
	}}else{
		
	/* GESTISCO L'INSERIMENTO DI UN FILE CON SOLO IL LINK */	
		if ($_POST['link']!=""){
			if ($referente=='video_youtube'){
			$valori_youtube=$this->processa_linkyoutube($_POST['link']);
			$this->link=$valori_youtube[1];
			$this->link2=$valori_youtube[0];
			}else if ($referente=='video_vimeo'){
			$valori_vimeo=$this->processa_linkvimeo($_POST['link']);
			$this->link=$valori_vimeo[1];
			$this->link2=$valori_vimeo[0];
			}else
		$this->link=$_POST['link'];
		$this->tipo_ref=$referente;
		$this->id_ref=$id;
		$this->data_ins=mktime();	
		$query = $this->db->query('SELECT MAX(ordine) as numero FROM '.$this->config->item('prefix').'file WHERE id_ref = '.$id.'');
		$qres = $query->row();
		$this->ordine = $qres->numero +1;	
		$risultato=$this->db->insert($this->config->item('prefix').'file', $this); 
               
		$lastid=$this->db->insert_id();
		$this->inserisci_messaggio($lastid,Array('titolo','descrizione'));
		$file_modificati[0]=$lastid;	
                
		return $this->lista_file_modificare($file_modificati);	
		}
		return 0;
		
	}
	
    	
    	
    }
    
  /** PROCESSA LA STRINGA DEL VIDEO YOUTUBE PER ADATTARLO A SHADOWBOX */

    function processa_linkyoutube($link){
    	
    	$codice_video = str_replace("http://youtu.be/", "", $link);
    	$parametri[0]=$codice_video;
    	$parametri[1]="http://www.youtube.com/v/".$codice_video."&amp;hl=en&amp;fs=1&amp;rel=0&amp;autoplay=1";
    	
    	return $parametri;
    }
    
function processa_linkvimeo($link){
    	
    	$codice_video = str_replace("http://vimeo.com/", "", $link);
    	$parametri[0]=$codice_video;
    	$parametri[1]="http://player.vimeo.com/video/".$codice_video."";
    	
    	return $parametri;
    }
    
  /** MANDA AL CONTROLLER LA LISTA DEI FILE A CUI AGGIUNGERE TITOLO E DESCRIZIONE */  
    function lista_file_modificare($file_modificati) {
    	
    	$this->db->select('*')->from($this->config->item('prefix').'file')->where_in('id_file', $file_modificati);
    	$query = $this->db->get();
        
    	return $query->result();
    	
    }
  /** RIDIMENSIONA LE IMMAGINI CARICATI A SECONDA DELLE IMPOSTAZIONI X e Y PRESENTI NELLA TABELLA GENERALS DEL DATABASE */     
    function processa_img($filename,$id){
    	
    	$info_base=$this->Generals->informazionibase();
    	$x=$info_base['thumb_width'];
    	$y=$info_base['thumb_height'];
    	$x2=$info_base['mid_width'];
    	$y2=$info_base['mid_height'];
        $enableretina=$info_base['enable_retina'];
        
        if ($enableretina==1){
            $this->image_moo->load($this->config->item('uploadabsolute_url').$filename);
            $this->image_moo->save_pa("", "@2x",TRUE);
            
            
            $this->image_moo->clear();
            
            
            $this->image_moo->load($this->config->item('uploadabsolute_url').$filename);
            $this->image_moo->resize_crop(($this->image_moo->width/2),($this->image_moo->height/2));
            $this->image_moo->save_pa("", "",TRUE);
            
             $this->image_moo->clear();
             
            $this->image_moo->load($this->config->item('uploadabsolute_url').$filename);
		$this->image_moo->resize_crop(($x*2),($y*2));
		$this->image_moo->save_pa("", "_thumb@2x",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$this->image_moo->load($this->config->item('uploadabsolute_url').$filename);
		$this->image_moo->resize_crop(($x2*2),($y2*2));
		$this->image_moo->save_pa("", "_mid@2x",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear(); 
             
             
        }
        
    	
		$this->image_moo->load($this->config->item('uploadabsolute_url').$filename);
		$this->image_moo->resize_crop($x,$y);
		$this->image_moo->save_pa("", "_thumb",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$this->image_moo->load($this->config->item('uploadabsolute_url').$filename);
		$this->image_moo->resize_crop($x2,$y2);
		$this->image_moo->save_pa("", "_mid",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$path_parts = pathinfo($this->config->item('uploadabsolute_url').$filename);

		$fileext=$path_parts['extension'];
		$filename=$path_parts['filename'];
		
		$daupdate->nome_file2   = $filename."_thumb.".$fileext;
		$daupdate->nome_file3   = $filename."_mid.".$fileext; 
        
		$risultato=$this->db->update($this->config->item('prefix').'file',$daupdate, array('id_file' => $id));
		
		
    }
    
    function upd_file($referente,$id){
    	
    	
    	foreach ($_POST['mod'] as $id_mod){
    		
    		$this->titolo=$_POST['titolo_'.$id_mod];
    		$this->descrizione=$_POST['descrizione_'.$id_mod];
    		$this->ordine=$_POST['ordine_'.$id_mod];
    		$risultato=$this->db->update($this->config->item('prefix').'file',$this, array('id_file' => $id_mod));
    		$this->modifica_messaggio($id_mod,Array('titolo','descrizione'));
    	}
    	return $risultato;
    	
    }
    
    function del_file($id){
    	
    	return $this->db->delete($this->config->item('prefix').'file',array('id_file' => $id));
    	
    }
    
	function inserisci_messaggio($lastid,$array) {
            
            
			
		foreach ($array as $arr){
                    if ($this->input->post($arr)==""){
                        $data->messaggio = $this->input->post($arr."_".$lastid);
                    }else{
			$data->messaggio = $this->input->post($arr);
                    }
			$data->lang = "it";
                        
			$query = $this->db->insert($this->config->item('prefix').'messaggi',$data);
			$id=$this->db->insert_id();
			$this->db->query('UPDATE '.$this->config->item('prefix').'file SET lang_'.$arr.' = '.$id.' WHERE id_file = '.$lastid.'');

		}
			
	}

	function modifica_messaggio($lastid,$array) {
			
		foreach ($array as $arr){

			$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').'file WHERE id_file = '.$lastid.'');
			$row = $query->row();
			$suffisso='lang_'.$arr;
			$progressivo=$row->$suffisso;
			if ($this->input->post($arr)==""){
                        $data->messaggio = $this->input->post($arr."_".$lastid);
                    }else{
			$data->messaggio = $this->input->post($arr);
                    }
			$query = $this->db->update($this->config->item('prefix').'messaggi',$data,Array('progressivo' => $progressivo, 'lang' => "it"));
		}
			
	}
	
function getUploadtraduzioni($id) {

		$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo'=>$id));
		return $query->result();

	}
	
	function dati_filelist($type,$inc_traduzioni=0,$array){
            
                $this->db->select('*');
                $this->db->from($this->config->item('prefix').'file');
                $c=0;
                if ($type==""){
                    
                    foreach ($array as $arr){
                    if ($c==0){
                        
                        $this->db->where('tipo_ref',$arr);
                    }
                    $this->db->or_where('tipo_ref',$arr);
                    $c++;
                    }
                    
                }else{
                
                $this->db->where('tipo_ref',$type);
                
                }
                
                
		
		$query = $this->db->get();
                
                
		
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
                        $c++;
		}
                
		return $elem;
		
	
	
	}
}
