<?

class Glossaryclass extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}

	function inserisci_messaggio($lastid,$array) {
			
		foreach ($array as $arr){
		
		$data->messaggio=$this->input->post($arr);
		$data->lang='it';
		$this->db->insert($this->config->item('prefix').'messaggi',$data);
			$id=$this->db->insert_id();
			$this->db->query('UPDATE '.$this->config->item('prefix').'glossario SET lang_'.$arr.' = '.$id.' WHERE id = '.$lastid.'');

		}
			
	}

	function modifica_messaggio($lastid,$array) {
			
		foreach ($array as $arr){

			$query=$this->db->query('SELECT lang_'.$arr.' FROM '.$this->config->item('prefix').'glossario WHERE id = '.$lastid.'');

			$row = $query->row();
			$suffisso='lang_'.$arr;
			$progressivo=$row->$suffisso;
			$data2->messaggio=$this->input->post($arr);
			$this->db->update($this->config->item('prefix').'messaggi',$data2,Array('progressivo'=>$progressivo,'lang'=>'it'));


		}
			
	}

	function inserisci_glossario(){
			

		$this->testo   = $this->input->post('testo'); // please read the below note

		$risultato=$this->db->insert($this->config->item('prefix').'glossario', $this);
		$lastid=$this->db->insert_id();

		$this->inserisci_messaggio($lastid,Array('testo'));

		return $risultato;

	}

	function lista_glossario(){

				$query=$this->db->query('SELECT *, lang_testo as ltesto, (SELECT COUNT( * ) 
FROM '.$this->config->item('prefix').'messaggi, '.$this->config->item('prefix').'glossario
WHERE progressivo = lang_testo AND lang_testo = ltesto 
GROUP BY progressivo
) as tradotte, (SELECT GROUP_CONCAT( lang SEPARATOR " - " ) 
FROM '.$this->config->item('prefix').'messaggi, '.$this->config->item('prefix').'glossario
WHERE progressivo = lang_testo AND lang_testo = ltesto 
GROUP BY progressivo
) as lingue FROM `'.$this->config->item('prefix').'glossario` ORDER BY id');
				
				
		return $query->result();
	}

	function dati_glossario($id,$inc_traduzioni=0){


		$query = $this->db->query('SELECT * FROM '.$this->config->item('prefix').'glossario WHERE id = '.$id);
		//return $query->result();
		$c=0;
		foreach ($query->result() as $row)
		{

			foreach ($row as $riga => $key)
			{
				$elem[$c]->$riga = $key;

			}
			if ($inc_traduzioni==1){
			$elem[$c]->traduzioni = $this->getGlossariotraduzioni($elem[$c]->lang_testo);
			}
		}
		return $elem;

	}

	function getGlossariotraduzioni($id) {

		$query = $this->db->get_where($this->config->item('prefix').'messaggi',Array('progressivo'=>$id));
		return $query->result();

	}

	function modifica_glossario($id){

		$this->testo   = $this->input->post('testo'); // please read the below note


		$risultato=$this->db->update($this->config->item('prefix').'glossario',$this, array('id' => $id));

		$this->modifica_messaggio($id,Array('testo'));

		return $risultato;
	}

	function cancella_glossario($id){

		return $this->db->delete($this->config->item('prefix').'glossario',array('id' => $id));

	}

}

?>