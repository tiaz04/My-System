<?php

class Menuclass extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function getMenuList() {

        $query = $this->db->query('SELECT *, (SELECT COUNT(*) FROM ' . $this->config->item('prefix') . 'menu_item WHERE id_menu = ' . $this->config->item('prefix') . 'menu.id_menu) as n_pagine FROM ' . $this->config->item('prefix') . 'menu');

        return $query->result();
    }

    function inserisci_menu() {

        $this->nome_menu = $_POST['nome']; // please read the below note


        $risultato = $this->db->insert($this->config->item('prefix') . 'menu', $this);

        return $risultato;
    }

    function modifica_menu($id) {

        $this->nome_menu = $_POST['nome']; // please read the below note


        $risultato = $this->db->update($this->config->item('prefix') . 'menu', $this, array('id_menu' => $id));

        return $risultato;
    }

    function dati_menu($id) {

        $query = $this->db->query('SELECT *, (SELECT COUNT(*) FROM ' . $this->config->item('prefix') . 'menu_item WHERE id_menu = ' . $this->config->item('prefix') . 'menu.id_menu) as n_pagine FROM ' . $this->config->item('prefix') . 'menu WHERE id_menu = ' . $id);
        return $query->result();
    }

    function cancella_menu($id) {

        return $this->db->delete($this->config->item('prefix') . 'menu', array('id_menu' => $id));
    }

    public function del_pagina($id_pagina, $id) {



        return $this->db->delete('menu_item', Array('id_rif' => $id_pagina, 'id_menu' => $id));
    }

    function ins_pagina($id_pagina, $id) {
        $this->db->select_max('ordine');
        $this->db->where('id_menu', $id);
        $query = $this->db->get($this->config->item('prefix') . 'menu_item');
        $result = $query->result();
        $ordine = $result[0]->ordine + 1;

        $that->id_menu = $id;
        $that->id_rif = $id_pagina;
        $that->ordine = $ordine;

        $risultato = $this->db->insert($this->config->item('prefix') . 'menu_item', $that);

        return $risultato;
    }

    function update_posizione($array) {

        foreach ($array as $position => $item) :
            $item = explode('_', $item);

            $this->ordine = $position;
            $this->db->update($this->config->item('prefix') . 'menu_item', $this, Array('id_rif' => $item[1]));

        endforeach;
    }

    function lista_elem($id) {

        $query = $this->db->query('select * from ' . $this->config->item('prefix') . 'menu_item INNER JOIN ' . $this->config->item('prefix') . 'pagine ON ' . $this->config->item('prefix') . 'pagine.id_pagina = ' . $this->config->item('prefix') . 'menu_item.id_rif WHERE `id_menu` = ' . $id . ' ORDER BY ordine ASC');
        return $query->result();
    }

}

?>