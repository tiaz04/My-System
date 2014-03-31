<?

class Eventiclass extends CI_Model {

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
			$this->db->query('UPDATE '.$this->config->item('prefix').'eventi SET lang_'.$arr.' = '.$id.' WHERE id_evento = '.$lastid.'');

		}
			
	}

	function modifica_messaggio($lastid,$array) {
			
		foreach ($array as $arr){

			$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').'eventi WHERE id_evento = '.$lastid.'');
			$row = $query->row();
			$suffisso='lang_'.$arr;
			$progressivo=$row->$suffisso;
			$data->messaggio = $this->input->post($arr);
			$query = $this->db->update($this->config->item('prefix').'messaggi',$data,Array('progressivo' => $progressivo, 'lang' => "it"));
			
		}
			
	}

	function inserisci_evento($data_img){
		
		if ($data_img!="")
		$this->img=($data_img['upload_data']['file_name']);
		
		$data_giorno=date('j',mktime());
		$data_mese=date('n',mktime());
		$data_anno=date('Y',mktime());
			

		$this->titolo   = $this->input->post('titolo'); // please read the below note
		$this->sottotitolo = $this->input->post('sottotitolo');
		$this->testo    = $this->input->post('testo');
		
		if (($this->input->post('data_giorno')==$data_giorno)&&($this->input->post('data_mese')==$data_mese)&&($this->input->post('data_anno')==$data_anno))
		$this->data=mktime();
		else
		$this->data=mktime(12, 0, 0, $this->input->post('data_mese'), $this->input->post('data_giorno'), $this->input->post('data_anno'));
		
		$this->data_end=mktime(12, 0, 0, $this->input->post('datafine_mese'), $this->input->post('datafine_giorno'), $this->input->post('datafine_anno'));
			
		$this->link = $this->input->post('link');
		
		$this->id_gallery = $this->input->post('id_gallery');
		$this->titolo_rewrite = url_title(character_limiter($this->titolo, 20), 'underscore', TRUE);
		$this->data_modifica=mktime();

		$risultato=$this->db->insert($this->config->item('prefix').'eventi', $this);
		$lastid=$this->db->insert_id();

		$this->inserisci_messaggio($lastid,Array('titolo','sottotitolo','testo'));

		$tags=$this->input->post('tags');
		$tags=explode(',',$tags);
		foreach ($tags as $tag){
			$instag->id_evento = $lastid;
			$instag->tag = $tag;
			$this->db->insert($this->config->item('prefix').'eventi_tags',$instag);
		}

		return $risultato;

	}

	function lista_eventi(){

		$query = $this->db->get($this->config->item('prefix').'eventi');
		return $query->result();
	}

	function dati_evento($id,$inc_traduzioni=0){


		$query = $this->db->query('SELECT *,(SELECT GROUP_CONCAT(tag) FROM '.$this->config->item('prefix').'eventi_tags WHERE id_evento = '.$this->config->item('prefix').'eventi.id_evento) tags FROM '.$this->config->item('prefix').'eventi WHERE id_evento = '.$id);
		//return $query->result();
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($inc_traduzioni==1){
			$elem[$c]->titolo_traduzioni = $this->getEventitraduzioni($elem[$c]->lang_titolo);
			$elem[$c]->sottotitolo_traduzioni = $this->getEventitraduzioni($elem[$c]->lang_sottotitolo);
			$elem[$c]->testo_traduzioni = $this->getEventitraduzioni($elem[$c]->lang_testo);
			}
		}
		return $elem;

	}

	function getEventitraduzioni($id) {

		$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo'=>$id));
		return $query->result();

	}

	function modifica_evento($id,$data_img){
		
		
		if ($this->input->post('del_img')==1)
		$this->img="";
		if ($data_img!="")
		$this->img=($data_img['upload_data']['file_name']);

		$this->titolo   = $this->input->post('titolo'); // please read the below note
		$this->sottotitolo = $this->input->post('sottotitolo');
		$this->testo    = $this->input->post('testo');
		$this->link = $this->input->post('link');
		$this->id_gallery = $this->input->post('id_gallery');
		$this->titolo_rewrite = url_title($this->input->post('titolo_rewrite'), 'underscore', TRUE);
		$this->data=mktime(12, 0, 0, $this->input->post('data_mese'), $this->input->post('data_giorno'), $this->input->post('data_anno'));
		$this->data_end=mktime(12, 0, 0, $this->input->post('datafine_mese'), $this->input->post('datafine_giorno'), $this->input->post('datafine_anno'));
		$this->data_modifica=mktime();

		$risultato=$this->db->update($this->config->item('prefix').'eventi',$this, array('id_evento' => $id));

		$this->modifica_messaggio($id,Array('titolo','sottotitolo','testo'));

		/* elimino i tags precedentemente inseriti per rieffettuare l'inserimento (trucchetto magico) */
		$this->db->delete($this->config->item('prefix').'eventi_tags', array('id_evento' => $id));
		/* reinserisco i tag */
		$tags=$this->input->post('tags');
		$tags=explode(',',$tags);
		foreach ($tags as $tag){
			$instag->id_evento = $id;
			$instag->tag = $tag;
			$this->db->insert($this->config->item('prefix').'eventi_tags',$instag);
		}

		return $risultato;
	}

	function cancella_evento($id){

		return $this->db->delete($this->config->item('prefix').'eventi',array('id_evento' => $id));

	}
	
	

}

?>