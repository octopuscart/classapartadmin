<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Order extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->model('Order_model');
        $this->load->library('session');
        $session_user = $this->session->userdata('logged_in');
        if ($session_user) {
            $this->user_id = $session_user['login_id'];
        } else {
            $this->user_id = 0;
        }
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    //list of data according to date list
    public function date_graph_data($date1, $date2, $datalist) {
        $period = new DatePeriod(
                new DateTime($date1), new DateInterval('P1D'), new DateTime($date2)
        );
        $daterangearray = [$date1];
        foreach ($period as $key => $value) {
            array_push($daterangearray, $value->format('Y-m-d'));
        }
        array_push($daterangearray, $date2);

        $date_list_data = array();

        foreach ($daterangearray as $key => $value) {
            if (isset($datalist[$value])) {
                $date_list_data[$value] = $datalist[$value];
            } else {
                $date_list_data[$value] = 0;
            }
        }
        return $date_list_data;
    }

    public function index() {
        redirect('/');
    }

    //order details
    public function orderdetails($order_key) {
        if ($this->user_type == 'Vendor' || $this->user_type == 'Customer') {
            redirect('UserManager/not_granted');
        }
        $order_details = $this->Order_model->getOrderDetails($order_key, 'key');
        $vendor_order_details = $this->Order_model->getVendorsOrder($order_key);
        $data['vendor_order'] = $vendor_order_details;
        if ($order_details) {
            $order_id = $order_details['order_data']->id;
            $data['ordersdetails'] = $order_details;
            $data['order_key'] = $order_key;
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $order_id);
            $query = $this->db->get('user_order_status');
            $orderstatuslist = $query->result();
            $data['user_order_status'] = $orderstatuslist;
            if (isset($_POST['submit'])) {
                $productattr = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'status' => $this->input->post('status'),
                    'remark' => $this->input->post('remark'),
                    'description' => $this->input->post('description'),
                    'order_id' => $order_id
                );
                $this->db->insert('user_order_status', $productattr);
                redirect("Order/orderdetails/$order_key");
            }
            try {
                $order_id = $order_id;
                // $this->Product_model->order_mail($order_id);
                //redirect("Order/orderdetails/$order_key");
            } catch (customException $e) {
                //display custom message
                // redirect("Order/orderdetails/$order_key");
            }
        } else {
            redirect('/');
        }
        $this->load->view('Order/orderdetails', $data);
    }

    public function remove_order_status($status_id, $orderkey) {
        $this->db->delete('user_order_status', array('id' => $status_id));
        redirect("Order/orderdetails/$orderkey");
    }

    //order list accroding to user type
    public function orderslist() {
        $data['exportdata'] = 'yes';
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        if ($this->user_type == 'Admin' || $this->user_type == 'Manager') {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
            $query = $this->db->get('user_order');
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {
                $this->db->order_by('id', 'desc');
                $this->db->where('order_id', $value->id);
                $query = $this->db->get('user_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $this->load->view('Order/orderslist', $data);
        }
        if ($this->user_type == 'Vendor') {
            $this->db->order_by('vo.id', 'desc');
            $this->db->group_by('vo.id');
            $this->db->select('o.order_no, vo.id, o.name, o.email, o.address, o.city,'
                    . 'o.state, vo.vendor_order_no, vo.total_price, vo.total_quantity, vo.c_date, vo.c_time');
            $this->db->join('user_order as o', 'o.id = vo.order_id', 'left');
            $this->db->where('vo.vendor_id', $this->user_id);
            $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');

            $this->db->from('vendor_order as vo');
            $query = $this->db->get();
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {

                $this->db->order_by('id', 'desc');
                $this->db->where('vendor_order_id', $value->id);
                $query = $this->db->get('vendor_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $this->load->view('Order/vendororderslist', $data);
        }
    }

    //order list accroding to user type
    public function orderslistvendor() {
        $data['exportdata'] = 'yes';
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        if ($this->user_type == 'Admin' || $this->user_type == 'Manager') {
            $this->db->order_by('vo.id', 'desc');
            $this->db->group_by('vo.id');
            $this->db->select('o.order_no, vo.id, o.name, o.email, o.address, o.city, o.status,'
                    . 'o.state, vo.vendor_order_no, vo.total_price, vo.total_quantity, vo.c_date, vo.c_time');
            $this->db->join('user_order as o', 'o.id = vo.order_id', 'left');
            $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');

            $this->db->from('vendor_order as vo');
            $query = $this->db->get();
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {
                $this->db->order_by('id', 'desc');
                $this->db->where('vendor_order_id', $value->id);
                $query = $this->db->get('vendor_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $this->load->view('Order/vendororderslist', $data);
        }
    }

    //order list xls 
    public function orderslistxls($daterange) {
        $datelist = explode(" to ", urldecode($daterange));
        $date1 = $datelist[0];
        $date2 = $datelist[1];
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        if ($this->user_type == 'Admin' || $this->user_type == 'Manager') {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
            $query = $this->db->get('user_order');
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {
                $this->db->order_by('id', 'desc');
                $this->db->where('order_id', $value->id);
                $query = $this->db->get('user_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $html = $this->load->view('Order/orderslist_xls', $data, TRUE);
        }
        if ($this->user_type == 'Vendor') {
            $this->db->order_by('vo.id', 'desc');
            $this->db->group_by('vo.id');
            $this->db->select('o.order_no, vo.id, o.name, o.email, o.address, o.city, o.contact_no, o.pincode,'
                    . 'o.state, vo.vendor_order_no, vo.total_price, vo.total_quantity, vo.c_date, vo.c_time');
            $this->db->join('user_order as o', 'o.id = vo.order_id', 'left');
            $this->db->where('vo.vendor_id', $this->user_id);
            $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');

            $this->db->from('vendor_order as vo');
            $query = $this->db->get();
            $orderlist = $query->result();
            $orderslistr = [];
            foreach ($orderlist as $key => $value) {

                $this->db->order_by('id', 'desc');
                $this->db->where('vendor_order_id', $value->id);
                $query = $this->db->get('vendor_order_status');
                $status = $query->row();
                $value->status = $status ? $status->status : $value->status;
                array_push($orderslistr, $value);
            }
            $data['orderslist'] = $orderslistr;
            $html = $this->load->view('Order/vendororderslist_xls', $data, TRUE);
        }
        $filename = 'orders_report_' . $daterange . ".xls";
        ob_clean();
        //header("Content-Disposition: attachment; filename='$filename'");
        //header("Content-Type: application/vnd.ms-excel");
        echo $html;
    }

    //vendor order details
    public function vendor_order_details($order_id) {
        $this->db->where('id', $order_id);
        $query = $this->db->get('vendor_order');
        $vendor_order_details = $query->row();
        $data['vendor_order'] = $vendor_order_details;

        $this->db->where('id', $vendor_order_details->order_id);
        $query = $this->db->get('user_order');
        $order_details = $query->row();
        $data['order_details'] = $order_details;
//
//        if ($this->user_id != $vendor_order_details->vendor_id) {
//            redirect('UserManager/not_granted');
//        }

        $this->db->where('order_id', $order_details->id);
        $this->db->where('vendor_id', $this->user_id);
        $query = $this->db->get('cart');
        $data['cart_items'] = $query->result();

        $data['cstatus'] = '';

        if ($order_details) {
            $order_id = $vendor_order_details->id;
            $data['order_id'] = $order_id;
            $this->db->order_by('id', 'desc');
            $this->db->where('vendor_order_id', $order_id);
            $query = $this->db->get('vendor_order_status');
            $orderstatuslist = $query->result();

            $data['cstatus'] = count($orderstatuslist) > 0 ? $orderstatuslist[0]->status : '';

            $data['vendor_order_status'] = $orderstatuslist;
            if (isset($_POST['submit'])) {
                $productattr = array(
                    'c_date' => date('Y-m-d'),
                    'c_time' => date('H:i:s'),
                    'status' => $this->input->post('status'),
                    'remark' => $this->input->post('remark'),
                    'description' => $this->input->post('description'),
                    'order_id' => $vendor_order_details->order_id,
                    'vendor_order_id' => $vendor_order_details->id,
                    'vendor_id' => $vendor_order_details->vendor_id,
                );
                $this->db->insert('vendor_order_status', $productattr);
                redirect("Order/vendor_order_details/$order_id");
            }
            try {
                $order_id = $order_id;
                // $this->Product_model->order_mail($order_id);
                //redirect("Order/orderdetails/$order_key");
            } catch (customException $e) {
                //display custom message
                // redirect("Order/orderdetails/$order_key");
            }
        } else {
            redirect('/');
        }
        $this->load->view('Order/vendororderdetails', $data);
    }

    //vendor order status
    public function remove_vendor_order_status($status_id, $order_id) {
        $this->db->delete('vendor_order_status', array('id' => $status_id));
        redirect("Order/vendor_order_details/$order_id");
    }

    //order analisys
    public function orderAnalysis() {
        $data['exportdata'] = 'no';
        if ($this->user_type == 'Vendor' || $this->user_type == 'Customer') {
            redirect('UserManager/not_granted');
        }
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        $this->db->order_by('id', 'desc');
        $this->db->where('order_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('user_order');
        $orderlist = $query->result_array();
        $orderslistr = [];
        $total_amount = 0;
        foreach ($orderlist as $key => $value) {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $value['id']);
            $total_amount += $value['total_price'];
            $query = $this->db->get('user_order_status');
            $status = $query->row();
            $value['status'] = $status ? $status->status : $value['status'];
            array_push($orderslistr, $value);
        }
        $data['total_amount'] = $total_amount;



        $this->db->order_by('id', 'desc');
        $this->db->where('op_date_time between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('admin_users');
        $userlist = $query->result_array();

        $this->db->order_by('id', 'desc');
        $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('vendor_order');
        $vendororderlist = $query->result_array();


        $data['vendor_orders'] = count($vendororderlist);
        $data['total_order'] = count($orderslistr);
        $data['total_users'] = count($userlist);
        $data['orderslist'] = $orderslistr;
        $this->load->library('JsonSorting', $orderslistr);
        $orderstatus = $this->jsonsorting->collect_data('status');
        $orderuser = $this->jsonsorting->collect_data('name');
        $orderdate = $this->jsonsorting->collect_data('order_date');
        $data['orderstatus'] = $orderstatus;
        $data['orderuser'] = $orderuser;
        $data['orderdate'] = $orderdate;




        //order graph date
        $dategraphdata = $this->date_graph_data($date1, $date2, $orderdate);
        $data['order_date_graph'] = $dategraphdata;


        $amount_date = $this->jsonsorting->data_combination_quantity('total_price', 'order_date');

        $salesgraph = array();

        foreach ($dategraphdata as $key => $value) {
            $salesgraph[$key] = 0;
            if (isset($amount_date[$key])) {
                $salesgraph[$key] = $amount_date[$key];
            }
        }

        $data['salesgraph'] = $salesgraph;

        $this->load->view('Order/orderanalysis', $data);
    }

    //order analisys
    public function orderAnalysisVendor() {
        $data['exportdata'] = 'no';
        if ($this->user_type != 'Vendor') {
            redirect('Order/orderAnalysis');
        }
        $user_id = $this->user_id;
        $date1 = date('Y-m-') . "01";
        $date2 = date('Y-m-d');
        if (isset($_GET['daterange'])) {
            $daterange = $this->input->get('daterange');
            $datelist = explode(" to ", $daterange);
            $date1 = $datelist[0];
            $date2 = $datelist[1];
        }
        $daterange = $date1 . " to " . $date2;
        $data['daterange'] = $daterange;
        $this->db->order_by('id', 'desc');
        $this->db->where("vendor_id", $user_id);
        $this->db->where('c_date between "' . $date1 . '" and "' . $date2 . '"');
        $query = $this->db->get('vendor_order');
        $orderlist = $query->result_array();
        $orderslistr = [];
        $total_amount = 0;
        foreach ($orderlist as $key => $value) {
            $this->db->order_by('id', 'desc');
            $this->db->where('order_id', $value['id']);

            $total_amount += $value['total_price'];

            $query = $this->db->get('user_order_status');
            $status = $query->row();
            $value['status'] = $status ? $status->status : $value['status'];
            array_push($orderslistr, $value);
        }
        $data['total_amount'] = $total_amount;
        $this->db->order_by('id', 'desc');
        $query = $this->db->get('vendor_order');
        $vendororderlist = $query->result_array();
        $data['total_order'] = count($orderlist);
        $data['orderslist'] = $orderslistr;
        $this->load->library('JsonSorting', $orderslistr);
        $orderstatus = $this->jsonsorting->collect_data('status');
        $orderuser = ''; //$this->jsonsorting->collect_data('name');
        $orderdate = $this->jsonsorting->collect_data('c_date');
        $data['orderstatus'] = $orderstatus;
        $data['orderuser'] = $orderuser;
        $data['orderdate'] = $orderdate;



        $this->load->view('Order/orderanalysisvendor', $data);
    }

}

?>
