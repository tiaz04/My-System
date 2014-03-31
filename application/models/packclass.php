<?php

class Packclass extends CI_Model {
	
	function __construct()
	{
		parent::__construct();
	}
	
	function inserisci_messaggio($lastid,$array,$table,$id_table) {
			
		foreach ($array as $arr){
			$data->messaggio = $this->input->post($arr);
			$data->lang = "it";
			$query = $this->db->insert($this->config->item('prefix').'messaggi',$data);
			$id=$this->db->insert_id();
			$this->db->query('UPDATE '.$this->config->item('prefix').$table.' SET lang_'.$arr.' = '.$id.' WHERE '.$id_table.' = '.$lastid.'');

		}
			
	}

	function modifica_messaggio($lastid,$array,$table,$id_table) {
			
		foreach ($array as $arr){

			$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').$table.' WHERE '.$id_table.' = '.$lastid.'');
			$row = $query->row();
			$suffisso='lang_'.$arr;
			$progressivo=$row->$suffisso;
			$data->messaggio = $this->input->post($arr);
			$query = $this->db->update($this->config->item('prefix').'messaggi',$data,Array('progressivo' => $progressivo, 'lang' => "it"));
		}
			
	}
	
	function lista_pacchetti(){
		
		$query = $this->db->get($this->config->item('prefix').'pacchetti');
		return $query->result();
		
	}
	
	function inserisci_pacchetto($lista_camere, $data_img){
		
		if ($data_img!="")
		$this->img=($data_img['upload_data']['file_name']);
		
		if ($this->input->post('s1periodo1_dal')!=""){
		$s1periodo1_dal=explode("/",$this->input->post('s1periodo1_dal'));
		$s1periodo1_dal=mktime(0,0,0,$s1periodo1_dal[1],$s1periodo1_dal[0],$s1periodo1_dal[2]);
		}else
		$s1periodo1_dal="";
		if ($this->input->post('s1periodo1_al')!=""){
		$s1periodo1_al=explode("/",$this->input->post('s1periodo1_al'));
		$s1periodo1_al=mktime(0,0,0,$s1periodo1_al[1],$s1periodo1_al[0],$s1periodo1_al[2]);
		}else
		$s1periodo1_al="";
		if ($this->input->post('s1periodo2_dal')!=""){
		$s1periodo2_dal=explode("/",$this->input->post('s1periodo2_dal'));
		$s1periodo2_dal=mktime(0,0,0,$s1periodo2_dal[1],$s1periodo2_dal[0],$s1periodo2_dal[2]);
		}else
		$s1periodo2_dal="";
		if ($this->input->post('s1periodo2_al')!=""){
		$s1periodo2_al=explode("/",$this->input->post('s1periodo2_al'));
		$s1periodo2_al=mktime(0,0,0,$s1periodo2_al[1],$s1periodo2_al[0],$s1periodo2_al[2]);
		}else
		$s1periodo2_al="";
		if ($this->input->post('s2periodo1_dal')!=""){
		$s2periodo1_dal=explode("/",$this->input->post('s2periodo1_dal'));
		$s2periodo1_dal=mktime(0,0,0,$s2periodo1_dal[1],$s2periodo1_dal[0],$s2periodo1_dal[2]);
		}else
		$s2periodo1_dal="";
		if ($this->input->post('s2periodo1_al')!=""){
		$s2periodo1_al=explode("/",$this->input->post('s2periodo1_al'));
		$s2periodo1_al=mktime(0,0,0,$s2periodo1_al[1],$s2periodo1_al[0],$s2periodo1_al[2]);
		}else
		$s2periodo1_al="";
		if ($this->input->post('s2periodo2_dal')!=""){
		$s2periodo2_dal=explode("/",$this->input->post('s2periodo2_dal'));
		$s2periodo2_dal=mktime(0,0,0,$s2periodo2_dal[1],$s2periodo2_dal[0],$s2periodo2_dal[2]);
		}else
		$s2periodo2_dal="";
		if ($this->input->post('s2periodo2_al')!=""){
		$s2periodo2_al=explode("/",$this->input->post('s2periodo2_al'));
		$s2periodo2_al=mktime(0,0,0,$s2periodo2_al[1],$s2periodo2_al[0],$s2periodo2_al[2]);
		}else
		$s2periodo2_al="";
		if ($this->input->post('visibile_dal')!=""){
		$visibile_dal=explode("/",$this->input->post('visibile_dal'));
		$visibile_dal=mktime(0,0,0,$visibile_dal[1],$visibile_dal[0],$visibile_dal[2]);
		}else
		$visibile_dal="";
		if ($this->input->post('visibile_al')!=""){
		$visibile_al=explode("/",$this->input->post('visibile_al'));
		$visibile_al=mktime(0,0,0,$visibile_al[1],$visibile_al[0],$visibile_al[2]);
		}else
		$visibile_al="";
		
		$this->nome=$this->input->post('nome');
		$this->anno=$this->input->post('anno');
		$this->attivo=$this->input->post('attivo');
		$this->s1periodo1_dal=$s1periodo1_dal;
		$this->s1periodo1_al=$s1periodo1_al;
		$this->s1periodo2_dal=$s1periodo2_dal;
		$this->s1periodo2_al=$s1periodo2_al;
		$this->s2periodo1_dal=$s2periodo1_dal;
		$this->s2periodo1_al=$s2periodo1_al;
		$this->s2periodo2_dal=$s2periodo2_dal;
		$this->s2periodo2_al=$s2periodo2_al;
		$this->descrizione=$this->input->post('descrizione');
		$this->visibile_dal=$visibile_dal;
		$this->visibile_al=$visibile_al;
		$this->strategia=$this->input->post('strategia');
		
		$risultato=$this->db->insert($this->config->item('prefix').'pacchetti', $this);
		$lastid=$this->db->insert_id();
		$this->inserisci_messaggio($lastid, Array('nome'), 'pacchetti', 'id_pacchetto');
		$this->inserisci_messaggio($lastid, Array('descrizione'), 'pacchetti', 'id_pacchetto');
		
		foreach ($lista_camere as $key=>$camere){
			$pprezzi->id_pacchetto=$lastid;
			$pprezzi->id_pcamera=$key;
			$pprezzi->prezzos1=$this->input->post($key."-s1");
			$pprezzi->prezzos2=$this->input->post($key."-s2");
			$pprezzi->attivo=$this->input->post($key."-active");
			$this->db->insert($this->config->item('prefix').'pacchetti_prezzi', $pprezzi);
		}

		return $risultato;
		
		
	}
	
	function modifica_pacchetto($id,$lista_camere, $data_img){
		
		if ($this->input->post('del_img')==1)
		$this->img="";
		if ($data_img!="")
		$this->img=($data_img['upload_data']['file_name']);
		
		if ($this->input->post('s1periodo1_dal')!=""){
		$s1periodo1_dal=explode("/",$this->input->post('s1periodo1_dal'));
		$s1periodo1_dal=mktime(0,0,0,$s1periodo1_dal[1],$s1periodo1_dal[0],$s1periodo1_dal[2]);
		}else
		$s1periodo1_dal="";
		if ($this->input->post('s1periodo1_al')!=""){
		$s1periodo1_al=explode("/",$this->input->post('s1periodo1_al'));
		$s1periodo1_al=mktime(0,0,0,$s1periodo1_al[1],$s1periodo1_al[0],$s1periodo1_al[2]);
		}else
		$s1periodo1_al="";
		if ($this->input->post('s1periodo2_dal')!=""){
		$s1periodo2_dal=explode("/",$this->input->post('s1periodo2_dal'));
		$s1periodo2_dal=mktime(0,0,0,$s1periodo2_dal[1],$s1periodo2_dal[0],$s1periodo2_dal[2]);
		}else
		$s1periodo2_dal="";
		if ($this->input->post('s1periodo2_al')!=""){
		$s1periodo2_al=explode("/",$this->input->post('s1periodo2_al'));
		$s1periodo2_al=mktime(0,0,0,$s1periodo2_al[1],$s1periodo2_al[0],$s1periodo2_al[2]);
		}else
		$s1periodo2_al="";
		if ($this->input->post('s2periodo1_dal')!=""){
		$s2periodo1_dal=explode("/",$this->input->post('s2periodo1_dal'));
		$s2periodo1_dal=mktime(0,0,0,$s2periodo1_dal[1],$s2periodo1_dal[0],$s2periodo1_dal[2]);
		}else
		$s2periodo1_dal="";
		if ($this->input->post('s2periodo1_al')!=""){
		$s2periodo1_al=explode("/",$this->input->post('s2periodo1_al'));
		$s2periodo1_al=mktime(0,0,0,$s2periodo1_al[1],$s2periodo1_al[0],$s2periodo1_al[2]);
		}else
		$s2periodo1_al="";
		if ($this->input->post('s2periodo2_dal')!=""){
		$s2periodo2_dal=explode("/",$this->input->post('s2periodo2_dal'));
		$s2periodo2_dal=mktime(0,0,0,$s2periodo2_dal[1],$s2periodo2_dal[0],$s2periodo2_dal[2]);
		}else
		$s2periodo2_dal="";
		if ($this->input->post('s2periodo2_al')!=""){
		$s2periodo2_al=explode("/",$this->input->post('s2periodo2_al'));
		$s2periodo2_al=mktime(0,0,0,$s2periodo2_al[1],$s2periodo2_al[0],$s2periodo2_al[2]);
		}else
		$s2periodo2_al="";
		if ($this->input->post('visibile_dal')!=""){
		$visibile_dal=explode("/",$this->input->post('visibile_dal'));
		$visibile_dal=mktime(0,0,0,$visibile_dal[1],$visibile_dal[0],$visibile_dal[2]);
		}else
		$visibile_dal="";
		if ($this->input->post('visibile_al')!=""){
		$visibile_al=explode("/",$this->input->post('visibile_al'));
		$visibile_al=mktime(0,0,0,$visibile_al[1],$visibile_al[0],$visibile_al[2]);
		}else
		$visibile_al="";
		
		$this->nome=$this->input->post('nome');
		$this->anno=$this->input->post('anno');
		$this->attivo=$this->input->post('attivo');
		$this->s1periodo1_dal=$s1periodo1_dal;
		$this->s1periodo1_al=$s1periodo1_al;
		$this->s1periodo2_dal=$s1periodo2_dal;
		$this->s1periodo2_al=$s1periodo2_al;
		$this->s2periodo1_dal=$s2periodo1_dal;
		$this->s2periodo1_al=$s2periodo1_al;
		$this->s2periodo2_dal=$s2periodo2_dal;
		$this->s2periodo2_al=$s2periodo2_al;
		$this->descrizione=$this->input->post('descrizione');
		$this->visibile_dal=$visibile_dal;
		$this->visibile_al=$visibile_al;
		$this->strategia=$this->input->post('strategia');
		
		$risultato=$this->db->update($this->config->item('prefix').'pacchetti',$this,Array('id_pacchetto'=>$id));
		$this->modifica_messaggio($id, Array('nome'), 'pacchetti', 'id_pacchetto');
		$this->modifica_messaggio($id, Array('descrizione'), 'pacchetti', 'id_pacchetto');
		
		$this->db->delete($this->config->item('prefix').'pacchetti_prezzi',Array('id_pacchetto'=>$id));
		
		foreach ($lista_camere as $key=>$camere){
			$pprezzi->id_pacchetto=$id;
			$pprezzi->id_pcamera=$key;
			$pprezzi->prezzos1=$this->input->post($key."-s1");
			$pprezzi->prezzos2=$this->input->post($key."-s2");
			$pprezzi->attivo=$this->input->post($key."-active");
			$this->db->insert($this->config->item('prefix').'pacchetti_prezzi', $pprezzi);
		}

		return $risultato;
		
		
	}
	
	function dati_pacchetto($id,$inc_traduzioni=0){
		
		$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'pacchetti WHERE id_pacchetto = '.$id);
		//return $query->result();
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;
			}

			$elem[$c]->lista_prezzi = $this->lista_prezzi($id);
			if ($inc_traduzioni==1){
				$elem[$c]->nome_traduzioni = $this->getPacchettitraduzioni($elem[$c]->lang_nome);
				$elem[$c]->descrizione_traduzioni = $this->getPacchettitraduzioni($elem[$c]->lang_descrizione);
			}

		}

		
		return $elem;
		
	}
	
	function lista_prezzi($id){

		$this->db->where('id_pacchetto',$id);
		$this->db->order_by("id_pcamera", "asc"); 
		$query = $this->db->get($this->config->item('prefix').'pacchetti_prezzi');
		return $query->result();
		
	}
	
	function getPacchettitraduzioni($id) {

		$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo'=>$id));
		return $query->result();

	}
	
	function cancella_pacchetto($id) {

		return $this->db->delete($this->config->item('prefix').'pacchetti',array('id_pacchetto' => $id));
	
	}
	
}