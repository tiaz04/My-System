<?

class Newsclass extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserisci_messaggio($lastid, $array) {

        foreach ($array as $arr) {
            $data->messaggio = $this->input->post($arr);
            $data->lang = "it";
            $query = $this->db->insert($this->config->item('prefix') . 'messaggi', $data);
            $id = $this->db->insert_id();
            $this->db->query('UPDATE ' . $this->config->item('prefix') . 'news SET lang_' . $arr . ' = ' . $id . ' WHERE id_news = ' . $lastid . '');
        }
    }

    function inserisci_messaggiocat($lastid, $array) {

        foreach ($array as $arr) {
            $data->messaggio = $this->input->post($arr);
            $data->lang = "it";
            $query = $this->db->insert($this->config->item('prefix') . 'messaggi', $data);
            $id = $this->db->insert_id();
            $this->db->query('UPDATE ' . $this->config->item('prefix') . 'news_cat SET lang_' . $arr . ' = ' . $id . ' WHERE id_newscat = ' . $lastid . '');
        }
    }

    function modifica_messaggio($lastid, $array) {

        foreach ($array as $arr) {

            $query = $this->db->query('SELECT lang_' . $arr . ' FROM ' . $this->config->item('prefix') . 'news WHERE id_news = ' . $lastid . '');
            $row = $query->row();
            $suffisso = 'lang_' . $arr;
            $progressivo = $row->$suffisso;
            $data->messaggio = $this->input->post($arr);
            $query = $this->db->update($this->config->item('prefix') . 'messaggi', $data, Array('progressivo' => $progressivo, 'lang' => "it"));
        }
    }

    function modifica_messaggiocat($lastid, $array) {

        foreach ($array as $arr) {

            $query = $this->db->query('SELECT lang_' . $arr . ' FROM ' . $this->config->item('prefix') . 'news_cat WHERE id_newscat = ' . $lastid . '');
            $row = $query->row();
            $suffisso = 'lang_' . $arr;
            $progressivo = $row->$suffisso;
            $data->messaggio = $this->input->post($arr);
            $query = $this->db->update($this->config->item('prefix') . 'messaggi', $data, Array('progressivo' => $progressivo, 'lang' => "it"));
        }
    }

    function inserisci_news($data_img) {

        $info_base = $this->Generals->informazionibase();
        $x=$info_base['thumb_width'];
    	$y=$info_base['thumb_height'];
    	$x2=$info_base['mid_width'];
    	$y2=$info_base['mid_height'];
        $enableretina = $info_base['enable_retina'];



        if ($data_img != "") {
            $this->img = ($data_img['upload_data']['file_name']);
            
                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop($x,$y);
		$this->image_moo->save_pa("", "_thumb",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop($x2,$y2);
		$this->image_moo->save_pa("", "_mid",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
            

            if ($enableretina == 1) {

                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
                $this->image_moo->save_pa("", "@2x", TRUE);

                $this->image_moo->clear();


                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
                $this->image_moo->resize_crop(($this->image_moo->width / 2), ($this->image_moo->height / 2));
                $this->image_moo->save_pa("", "", TRUE);
                
                $this->image_moo->clear();
                
                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop(($x*2),($x*2));
		$this->image_moo->save_pa("", "_thumb@2x",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop(($x2*2),($y2*2));
		$this->image_moo->save_pa("", "_mid@2x",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
                
            }
        }

        $data_giorno = date('j', mktime());
        $data_mese = date('n', mktime());
        $data_anno = date('Y', mktime());


        $this->titolo = $this->input->post('titolo'); // please read the below note
        $this->sottotitolo = $this->input->post('sottotitolo');
        $this->testo = $this->input->post('testo');

        if (($this->input->post('data_giorno') == $data_giorno) && ($this->input->post('data_mese') == $data_mese) && ($this->input->post('data_anno') == $data_anno))
            $this->data = mktime();
        else
            $this->data = mktime(12, 0, 0, $this->input->post('data_mese'), $this->input->post('data_giorno'), $this->input->post('data_anno'));

        $this->link = $this->input->post('link');
        $this->id_cat = $this->input->post('id_cat');
        $this->id_gallery = $this->input->post('id_gallery');
        $this->titolo_rewrite = url_title(character_limiter($this->titolo, 20), 'underscore', TRUE);
        $this->data_modifica = mktime();

        $risultato = $this->db->insert($this->config->item('prefix') . 'news', $this);
        $lastid = $this->db->insert_id();

        $this->inserisci_messaggio($lastid, Array('titolo', 'sottotitolo', 'testo'));

        $tags = $this->input->post('tags');
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $instag->id_news = $lastid;
            $instag->tag = $tag;
            $this->db->insert($this->config->item('prefix') . 'news_tags', $instag);
        }

        return $risultato;
    }

    function lista_news() {


        $query = $this->db->get($this->config->item('prefix') . 'news');
        $c = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                foreach ($row as $riga => $key) {
                    $elem[$c]->$riga = $key;
                }
                if ($elem[$c]->id_cat != 0) {
                    $query2 = $this->db->get_where($this->config->item('prefix') . 'news_cat', Array('id_newscat' => $elem[$c]->id_cat));
                    $row2 = $query2->row();

                    $elem[$c]->cat_news = $row2->nome;
                } else {
                    $elem[$c]->cat_news = "";
                }
                $c++;
            }
        } else {
            return false;
        }
        return $elem;





        /* 	$query = $this->db->get($this->config->item('prefix').'news');
          return $query->result(); */
    }

    function dati_catnews($id, $inc_traduzioni = 0) {



        $query = $this->db->query('SELECT * FROM ' . $this->config->item('prefix') . 'news_cat WHERE id_newscat = ' . $id);
        //return $query->result();
        $c = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                foreach ($row as $riga => $key) {
                    $elem[$c]->$riga = $key;
                }
                if ($inc_traduzioni == 1) {
                    $elem[$c]->nome_traduzioni = $this->getPagtraduzioni($elem[$c]->lang_nome);
                }
            }
        } else {
            return false;
        }
        return $elem;
    }

    function dati_news($id, $inc_traduzioni = 0) {


        $query = $this->db->query('SELECT *,(SELECT GROUP_CONCAT(tag) FROM ' . $this->config->item('prefix') . 'news_tags WHERE id_news = ' . $this->config->item('prefix') . 'news.id_news) tags FROM ' . $this->config->item('prefix') . 'news WHERE id_news = ' . $id);
        //return $query->result();
        $c = 0;
        foreach ($query->result() as $row) {

            foreach ($row as $riga => $key) {
                $elem[$c]->$riga = $key;
            }
            if ($inc_traduzioni == 1) {
                $elem[$c]->titolo_traduzioni = $this->getNewstraduzioni($elem[$c]->lang_titolo);
                $elem[$c]->sottotitolo_traduzioni = $this->getNewstraduzioni($elem[$c]->lang_sottotitolo);
                $elem[$c]->testo_traduzioni = $this->getNewstraduzioni($elem[$c]->lang_testo);
            }
        }
        return $elem;
    }

    function getNewstraduzioni($id) {

        $query = $this->db->get_where($this->config->item('prefix') . 'messaggi', Array('progressivo' => $id));
        return $query->result();
    }

    function modifica_news($id, $data_img) {
        
        $info_base = $this->Generals->informazionibase();
        $x=$info_base['thumb_width'];
    	$y=$info_base['thumb_height'];
    	$x2=$info_base['mid_width'];
    	$y2=$info_base['mid_height'];
        $enableretina = $info_base['enable_retina'];


        if ($this->input->post('del_img') == 1)
            $this->img = "";
        if ($data_img != "") {
            $this->img = ($data_img['upload_data']['file_name']);
        
            
                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop($x,$y);
		$this->image_moo->save_pa("", "_thumb",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop($x2,$y2);
		$this->image_moo->save_pa("", "_mid",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
            

            if ($enableretina == 1) {

                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
                $this->image_moo->save_pa("", "@2x", TRUE);

                $this->image_moo->clear();


                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
                $this->image_moo->resize_crop(($this->image_moo->width / 2), ($this->image_moo->height / 2));
                $this->image_moo->save_pa("", "", TRUE);
                
                $this->image_moo->clear();
                
                $this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop(($x*2),($x*2));
		$this->image_moo->save_pa("", "_thumb@2x",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
		
		$this->image_moo->load($this->config->item('uploadabsolute_url') . ($data_img['upload_data']['file_name']));
		$this->image_moo->resize_crop(($x2*2),($y2*2));
		$this->image_moo->save_pa("", "_mid@2x",TRUE);
		
		print $this->image_moo->display_errors();
		
		$this->image_moo->clear();
                
            }   
            
        }

        $this->titolo = $this->input->post('titolo'); // please read the below note
        $this->sottotitolo = $this->input->post('sottotitolo');
        $this->testo = $this->input->post('testo');
        $this->link = $this->input->post('link');
        $this->id_cat = $this->input->post('id_cat');
        $this->id_gallery = $this->input->post('id_gallery');
        $this->titolo_rewrite = url_title($this->input->post('titolo_rewrite'), 'underscore', TRUE);
        $this->data = mktime(12, 0, 0, $this->input->post('data_mese'), $this->input->post('data_giorno'), $this->input->post('data_anno'));
        $this->data_modifica = mktime();

        $risultato = $this->db->update($this->config->item('prefix') . 'news', $this, array('id_news' => $id));

        $this->modifica_messaggio($id, Array('titolo', 'sottotitolo', 'testo'));

        /* elimino i tags precedentemente inseriti per rieffettuare l'inserimento (trucchetto magico) */
        $this->db->delete($this->config->item('prefix') . 'news_tags', array('id_news' => $id));
        /* reinserisco i tag */
        $tags = $this->input->post('tags');
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $instag->id_news = $id;
            $instag->tag = $tag;
            $this->db->insert($this->config->item('prefix') . 'news_tags', $instag);
        }

        return $risultato;
    }

    function cancella_news($id) {

        return $this->db->delete($this->config->item('prefix') . 'news', array('id_news' => $id));
    }

    function lista_catnews() {

        $query = $this->db->get($this->config->item('prefix') . 'news_cat');
        return $query->result();
    }

    function inserisci_catnews() {


        $this->nome = $this->input->post('nome'); // please read the below note
        $this->cat_rewrite = url_title(character_limiter($this->nome, 20), 'underscore', TRUE);

        $risultato = $this->db->insert($this->config->item('prefix') . 'news_cat', $this);
        $lastid = $this->db->insert_id();

        $this->inserisci_messaggiocat($lastid, Array('nome'));

        return $risultato;
    }

    function modifica_catnews($id) {

        $this->nome = $this->input->post('nome'); // please read the below note
        $this->cat_rewrite = $this->input->post('rewrite');
        $this->cat_rewrite = url_title($this->cat_rewrite, 'underscore', TRUE);

        $risultato = $this->db->update($this->config->item('prefix') . 'news_cat', $this, array('id_newscat' => $id));

        $this->modifica_messaggiocat($id, Array('nome'));


        return $risultato;
    }

    function cancella_newscat($id) {

        return $this->db->delete($this->config->item('prefix') . 'news_cat', array('id_newscat' => $id));
    }

}

?>