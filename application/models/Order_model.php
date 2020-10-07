<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order_model extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    //get order details  
    public function getOrderDetails($key_id, $is_key = 0) {
        $order_data = array();
        if ($is_key === 'key') {
            $this->db->where('order_key', $key_id);
        } else {
            $this->db->where('id', $key_id);
        }
        $query = $this->db->get('user_order');
        $order_details = $query->row();
        if ($order_details) {

            $order_data['order_data'] = $order_details;
            $this->db->where('order_id', $order_details->id);
            $query = $this->db->get('cart');
            $cart_items = $query->result();
            $order_data['cart_data'] = $cart_items;
        }
        return $order_data;
    }

    public function getVendorsOrder($key_id) {
        $order_data = array();
        $this->db->where('order_key', $key_id);
        $query = $this->db->get('user_order');
        $order_details = $query->row();
        $venderarray = array();
        if ($order_details) {
            $order_id = $order_details->id;
            $order_data['order_data'] = $order_details;
            $this->db->where('order_id', $order_id);
            $query = $this->db->get('vendor_order');
            $vendor_orders = $query->result();
            $order_data['vendor'] = array();
            foreach ($vendor_orders as $key => $value) {
                $vid = $value->vendor_id;
                $order_data['vendor'][$vid] = array();
                $order_data['vendor'][$vid]['vendor'] = $value;
                
                $this->db->order_by('id', 'desc');
                $this->db->where('vendor_order_id', $value->id);
                $query = $this->db->get('vendor_order_status');
                $status = $query->row();
                
                $order_data['vendor'][$vid]['status'] = $status ? $status->status : $value->status;
                $order_data['vendor'][$vid]['remark'] = $status ? $status->remark : $value->status;
                
                $this->db->where('order_id', $order_id);
                $this->db->where('vendor_id', $vid);
                $query = $this->db->get('cart');
                $order_data['vendor'][$vid]['cart_items'] = $query->result();
            }
        }

        return $order_data;
    }

}

?>
