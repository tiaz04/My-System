<?php

class Categoryclass extends CI_Model {

    function __construct()
    {
        parent::__construct();
    }
    
    function getCatList() {
    	
    	$query=$this->db->get($this->config->item('prefix').'news_cat');
    	return $query->result();
    	
    }
    
    function getCatPressList() {
    	
    	$query=$this->db->get($this->config->item('prefix').'press_cat');
    	return $query->result();
    	
    }
    
    function getCatCatalogList() {
    	
    	$query=$this->db->get($this->config->item('prefix').'catalog_cat');
    	return $query->result();
    	
    }
    
     function getCatBlogList() {
    	
    	$query=$this->db->get($this->config->item('prefix').'blog_cat');
    	return $query->result();
    	
    }
    
    function getFaqList() {
    	
    	$query=$this->db->get($this->config->item('prefix').'faq_cat');
    	return $query->result();
    	
    }
    
}
?>