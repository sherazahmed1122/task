<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Common_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }


    function add_product($name,$description,$price){

    	$data = array(
    		"name" => $name,
    		"description" => $description,
    		"price" => $price
    	);

    	$res = $this->db->insert('product_details', $data);

    	if ($res) {
    		return $res;
    	}

    }

    function all_products(){
    	$data = $this->db->select("*")->from("product_details")->where('deleted_at',NULL)->get()->result();
    	return $data;
    }

}