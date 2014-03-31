<?php
class Tarifsclass extends CI_Model {

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

	function lista_tariffe(){
		$this->db->where('tpadre', '0');
		$query = $this->db->get($this->config->item('prefix').'tariffe');
		return $query->result();
	}
	
function lista_tariffe_agg($id){
		$this->db->where('tpadre', $id);
		$query = $this->db->get($this->config->item('prefix').'tariffe');
		$c=0;
		$elem2="";
		
		foreach ($query->result() as $row)
		{
			$elem2[$c]->tariffa=$this->dati_tariffa($row->id_tariffa);
			$c++;
		}
				
		return $elem2;
	}
	
	

	function inserisci_tariffa(){

		if ($this->input->post('tpadre')){
			
			$this->nome=$this->input->post('nome');
			$this->tpadre=$this->input->post('tpadre');
			$risultato=$this->db->insert('tariffe',$this);			
			$lastid=$this->db->insert_id();	
			$this->inserisci_messaggio($lastid, Array('html'), 'tariffe', 'id_tariffa');	

			return $risultato;
			
		}else{
			
			$this->anno=$this->input->post('anno');
			$this->validita=mktime(0,0,0,$this->input->post('validita_mese'),$this->input->post('validita_giorno'),$this->input->post('validita_anno'));
			$this->attivo=$this->input->post('attivo');
			$risultato=$this->db->insert('tariffe',$this);
			$lastid=$this->db->insert_id();
			$this->inserisci_messaggio($lastid, Array('html'), 'tariffe', 'id_tariffa');
			
			return $risultato;
			
		}
	
	}
	
	function modifica_tariffa($id) {

		$lista_periodi=$this->lista_periodi($id);
		$lista_righe=$this->lista_righe($id);

		/* Cancello i prezzi */
		$this->db->delete($this->config->item('prefix').'tariffe_prezzi',array('id_tariffa' => $id));

		/* cerco tutte le possibili combinazioni per aggiornare la lista dei prezzi */
		foreach ($lista_righe as $righe){
			$arr_riga= Array();
			$arr_riga[0]=$righe->nome;

			foreach ($lista_periodi as $periodo){
					
				$prezzi->id_tariffa=$id;
				$prezzi->id_triga=$righe->id_triga;
				$prezzi->id_tperiodo=$periodo->id_tperiodo;
				if ($_POST[$righe->id_triga."_".$periodo->id_tperiodo]!="")
				$prezzi->prezzo=$_POST[$righe->id_triga."_".$periodo->id_tperiodo];
				else
				$prezzi->prezzo="";
					
				$this->db->insert($this->config->item('prefix').'tariffe_prezzi',$prezzi);
					
			}
		}

		$this->html=$this->input->post('html');
		$risultato=$this->db->update($this->config->item('prefix').'tariffe',$this, array('id_tariffa' => $id));

		$this->modifica_messaggio($id,Array('html'),'tariffe','id_tariffa');

		return $risultato;

	}

	function dati_tariffa($id,$inc_traduzioni=0){

		$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'tariffe WHERE id_tariffa = '.$id);
		//return $query->result();
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;
			}

			$elem[$c]->lista_periodi = $this->lista_periodi($id);
			$elem[$c]->lista_righe = $this->lista_righe($id,$inc_traduzioni);
			$elem[$c]->lista_prezzi = $this->lista_prezzi($id);
			$elem[$c]->lista_tariffe_agg = $this->lista_tariffe_agg($id);
			if ($inc_traduzioni==1){
				$elem[$c]->html_traduzioni = $this->getTariffetraduzioni($elem[$c]->lang_html);
			}

		}

		
		return $elem;
		
		

	}

	function getTariffetraduzioni($id) {

		$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo'=>$id));
		return $query->result();

	}

	function lista_periodi($id){

		$this->db->where('id_tariffa',$id);
		$query = $this->db->get($this->config->item('prefix').'tariffe_periodi');
		return $query->result();
	}

	function lista_righe($id,$inc_traduzioni=0){

		$this->db->where('id_tariffa',$id);
		$this->db->order_by('ordine','asc');
		$query = $this->db->get($this->config->item('prefix').'tariffe_righe');
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}

			if ($inc_traduzioni==1){

				$elem[$c]->righe_traduzioni = $this->getTariffetraduzioni($elem[$c]->lang_nome);

			}
			$c++;
		}
		return $elem;

	}

	function lista_prezzi($id){
		$this->db->where('id_tariffa',$id);
		$query = $this->db->get($this->config->item('prefix').'tariffe_prezzi');
		return $query->result();

	}

	function upd_generals($array){

		$anno_attivo = $this->input->post('anno_attivo');
		$anno_next = $this->input->post('anno_next');

		$array['tarifs_option']->tariffa_attiva = $anno_attivo;
		$array['tarifs_option']->anno_next = $anno_next;
		$json = json_encode($array['tarifs_option']);
		$toinput->tarifs_option=$json;
		$this->db->update($this->config->item('prefix').'general',$toinput);

	}

	function aggiungi_periodo($id){

		$this->stagione_dal=mktime(0, 0, 0, $this->input->post("dal_mese"), $this->input->post("dal_giorno"), $this->input->post("dal_anno"));
		$this->stagione_al=mktime(0, 0, 0, $this->input->post("al_mese"), $this->input->post("al_giorno"), $this->input->post("al_anno"));
		$this->nome_stagione=$this->input->post("nome_stagione");
		$this->id_tariffa=$id;

		$risultato=$this->db->insert($this->config->item('prefix')."tariffe_periodi",$this);
		$lastid=$this->db->insert_id();
		$this->inserisci_messaggio($lastid, Array('nome_stagione'), 'tariffe_periodi', 'id_tperiodo');
		
		return $risultato;

	}

	function modifica_periodo($id){

		if ($this->input->post('cancella')==1)
		{
			$risultato=$this->db->delete($this->config->item('prefix')."tariffe_periodi",array('id_tperiodo'=>$this->input->post("mod_periodo")));
			return $risultato;
		}else{

			$this->id_tariffa=$id;
			$this->stagione_dal=mktime(0, 0, 0, $this->input->post("dal_mese"), $this->input->post("dal_giorno"), $this->input->post("dal_anno"));
			$this->stagione_al=mktime(0, 0, 0, $this->input->post("al_mese"), $this->input->post("al_giorno"), $this->input->post("al_anno"));
			$this->nome_stagione=$this->input->post("nome_stagione");
			$risultato=$this->db->update($this->config->item('prefix').'tariffe_periodi',$this,Array('id_tperiodo'=>$this->input->post("mod_periodo")));
			$this->modifica_messaggio($this->input->post("mod_periodo"), Array('nome_stagione'), 'tariffe_periodi', 'id_tperiodo');
			return $risultato;
		}

	}
	
	function aggiungi_riga($id){

		$this->nome=$this->input->post("nome");
		$this->ordine=$this->input->post("ordine");
		$this->id_tariffa=$id;

		$risultato=$this->db->insert($this->config->item('prefix')."tariffe_righe",$this);
		$lastid=$this->db->insert_id();
		$this->inserisci_messaggio($lastid, Array('nome'), 'tariffe_righe', 'id_triga');
		
		return $risultato;

	}
	
	function modifica_riga($id){
		
		if ($this->input->post('cancella')==1)
		{
			$risultato=$this->db->delete($this->config->item('prefix')."tariffe_righe",array('id_triga'=>$this->input->post("mod_riga")));
			return $risultato;
		}else{
			
		$this->nome=$this->input->post("nome");
		$this->ordine=$this->input->post("ordine");
		
		$risultato=$this->db->update($this->config->item('prefix')."tariffe_righe",$this,Array('id_triga'=>$this->input->post("mod_riga")));
		$this->modifica_messaggio($this->input->post("mod_riga"), Array('nome'), 'tariffe_righe', 'id_triga');
		
		return $risultato;
		
		}
	}

}

?>