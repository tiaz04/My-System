<?

class Faqclass extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function inserisci_messaggio($lastid, $array) {

        foreach ($array as $arr) {
            $thisMex->messaggio = $this->input->post($arr);
            $thisMex->lang = "it";
            $query = $this->db->insert($this->config->item('prefix') . 'messaggi', $thisMex);



            $id = $this->db->insert_id();
            $this->db->query('UPDATE ' . $this->config->item('prefix') . 'faq SET lang_' . $arr . ' = ' . $id . ' WHERE id_faq = ' . $lastid . '');
        }
    }

    function inserisci_messaggiocat($lastid, $array) {

        foreach ($array as $arr) {
            $data->messaggio = $this->input->post($arr);
            $data->lang = "it";
            $query = $this->db->insert($this->config->item('prefix') . 'messaggi', $data);
            $id = $this->db->insert_id();
            $this->db->query('UPDATE ' . $this->config->item('prefix') . 'faq_cat SET lang_' . $arr . ' = ' . $id . ' WHERE id_faqcat = ' . $lastid . '');
        }
    }

    function modifica_messaggio($lastid, $array) {

        foreach ($array as $arr) {

            $query = $this->db->query('SELECT lang_' . $arr . ' FROM ' . $this->config->item('prefix') . 'faq WHERE id_faq = ' . $lastid . '');
            $row = $query->row();
            $suffisso = 'lang_' . $arr;
            $progressivo = $row->$suffisso;
            $thisMex->messaggio = $this->input->post($arr);
            $query = $this->db->update($this->config->item('prefix') . 'messaggi', $thisMex, Array('progressivo' => $progressivo, 'lang' => "it"));
        }
    }

    function modifica_messaggiocat($lastid, $array) {

        foreach ($array as $arr) {

            $query = $this->db->query('SELECT lang_' . $arr . ' FROM ' . $this->config->item('prefix') . 'faq_cat WHERE id_faqcat = ' . $lastid . '');
            $row = $query->row();
            $suffisso = 'lang_' . $arr;
            $progressivo = $row->$suffisso;
            $data->messaggio = $this->input->post($arr);
            $query = $this->db->update($this->config->item('prefix') . 'messaggi', $data, Array('progressivo' => $progressivo, 'lang' => "it"));
        }
    }

    function inserisci_faq() {

        $data_giorno = date('j', mktime());
        $data_mese = date('n', mktime());
        $data_anno = date('Y', mktime());


        $this->domanda = $this->input->post('domanda'); // please read the below note
        $this->risposta = $this->input->post('risposta');

        if (($this->input->post('data_giorno') == $data_giorno) && ($this->input->post('data_mese') == $data_mese) && ($this->input->post('data_anno') == $data_anno))
            $this->data = mktime();
        else
            $this->data = mktime(12, 0, 0, $this->input->post('data_mese'), $this->input->post('data_giorno'), $this->input->post('data_anno'));

        $this->link = $this->input->post('link');
        $this->id_gallery = $this->input->post('id_gallery');
        $this->id_cat = $this->input->post('id_cat');
        $this->domanda_rewrite = url_title(character_limiter($this->domanda, 20), 'underscore', TRUE);
        $this->data_modifica = mktime();

        $risultato = $this->db->insert($this->config->item('prefix') . 'faq', $this);
        $lastid = $this->db->insert_id();

        $this->inserisci_messaggio($lastid, Array('domanda', 'risposta'));

        $tags = $this->input->post('tags');
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $instag->id_faq = $lastid;
            $instag->tag = $tag;
            $this->db->insert($this->config->item('prefix') . 'faq_tags', $instag);
        }

        return $risultato;
    }

    function lista_faq() {




        $query = $this->db->get($this->config->item('prefix') . 'faq');
        $c = 0;
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {

                foreach ($row as $riga => $key) {
                    $elem[$c]->$riga = $key;
                }
                if ($elem[$c]->id_cat != 0) {
                    $query2 = $this->db->get_where($this->config->item('prefix') . 'faq_cat', Array('id_faqcat' => $elem[$c]->id_cat));
                    $row2 = $query2->row();

                    $elem[$c]->cat_faq = $row2->nome;
                } else {
                    $elem[$c]->cat_faq = "";
                }
                $c++;
            }
        } else {
            return false;
        }
        return $elem;
    }

    function dati_faq($id, $inc_traduzioni = 0) {


        $query = $this->db->query('SELECT *,(SELECT GROUP_CONCAT(tag) FROM ' . $this->config->item('prefix') . 'faq_tags WHERE id_faq = faq.id_faq) tags FROM ' . $this->config->item('prefix') . 'faq WHERE id_faq = ' . $id);
        //return $query->result();
        $c = 0;
        foreach ($query->result() as $row) {

            foreach ($row as $riga => $key) {
                $elem[$c]->$riga = $key;
            }
            if ($inc_traduzioni == 1) {
                $elem[$c]->domanda_traduzioni = $this->getfaqtraduzioni($elem[$c]->lang_domanda);
                $elem[$c]->risposta_traduzioni = $this->getfaqtraduzioni($elem[$c]->lang_risposta);
            }
        }
        return $elem;
    }

    function dati_catfaq($id, $inc_traduzioni = 0) {


        $query = $this->db->query('SELECT * FROM ' . $this->config->item('prefix') . 'faq_cat WHERE id_faqcat = ' . $id);
        //return $query->result();
        $c = 0;
        foreach ($query->result() as $row) {

            foreach ($row as $riga => $key) {
                $elem[$c]->$riga = $key;
            }
            if ($inc_traduzioni == 1) {
                $elem[$c]->nome_traduzioni = $this->getfaqtraduzioni($elem[$c]->lang_nome);
            }
        }
        return $elem;
    }

    function getfaqtraduzioni($id) {

        $query = $this->db->get_where($this->config->item('prefix') . 'messaggi', Array('progressivo' => $id));
        return $query->result();
    }

    function modifica_faq($id) {

        $this->domanda = $this->input->post('domanda'); // please read the below note
        $this->risposta = $this->input->post('risposta');
        $this->link = $this->input->post('link');
        $this->id_gallery = $this->input->post('id_gallery');
        $this->id_cat = $this->input->post('id_cat');
        $this->domanda_rewrite = url_title($this->input->post('domanda_rewrite'), 'underscore', TRUE);
        $this->data = mktime(12, 0, 0, $this->input->post('data_mese'), $this->input->post('data_giorno'), $this->input->post('data_anno'));
        $this->data_modifica = mktime();

        $risultato = $this->db->update($this->config->item('prefix') . 'faq', $this, array('id_faq' => $id));

        $this->modifica_messaggio($id, Array('domanda', 'risposta'));

        /* elimino i tags precedentemente inseriti per rieffettuare l'inserimento (trucchetto magico) */
        $this->db->delete($this->config->item('prefix') . 'faq_tags', array('id_faq' => $id));
        /* reinserisco i tag */
        $tags = $this->input->post('tags');
        $tags = explode(',', $tags);
        foreach ($tags as $tag) {
            $instag->id_faq = $id;
            $instag->tag = $tag;
            $this->db->insert($this->config->item('prefix') . 'faq_tags', $instag);
        }

        return $risultato;
    }

    function cancella_faq($id) {

        return $this->db->delete($this->config->item('prefix') . 'faq', array('id_faq' => $id));
    }

    function lista_catfaq() {

        $query = $this->db->get($this->config->item('prefix') . 'faq_cat');
        return $query->result();
    }

    function inserisci_catfaq() {


        $this->nome = $this->input->post('nome'); // please read the below note
        $this->cat_rewrite = url_title(character_limiter($this->nome, 20), 'underscore', TRUE);

        $risultato = $this->db->insert($this->config->item('prefix') . 'faq_cat', $this);
        $lastid = $this->db->insert_id();

        $this->inserisci_messaggiocat($lastid, Array('nome'));

        return $risultato;
    }

    function modifica_catfaq($id) {

        $this->nome = $this->input->post('nome'); // please read the below note
        $this->cat_rewrite = $this->input->post('rewrite');
        $this->cat_rewrite = url_title($this->cat_rewrite, 'underscore', TRUE);

        $risultato = $this->db->update($this->config->item('prefix') . 'faq_cat', $this, array('id_faqcat' => $id));

        $this->modifica_messaggiocat($id, Array('nome'));


        return $risultato;
    }

    function cancella_faqcat($id) {

        return $this->db->delete($this->config->item('prefix') . 'faq_cat', array('id_faqcat' => $id));
    }

}

?>