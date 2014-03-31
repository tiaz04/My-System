<?php

class Headerimgclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    
	function getHeaderimgList(){
		$this->db->group_by("nome_gallery"); 
		$query=$this->db->get($this->config->item('prefix').'header_img');
		return $query->result();
	}
    
}
?>