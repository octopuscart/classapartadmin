<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 */
defined('BASEPATH') OR exit('No direct script access allowed');
ob_start();

class ProductManager extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Product_model');
        $this->load->model('User_model');
        $this->load->library('session');
        $this->user_id = $this->session->userdata('logged_in')['login_id'];
        $this->user_type = $this->session->logged_in['user_type'];
    }

    public function index() {
        $this->all_query();
    }

    ///Category management 
    public function category_api() {
        $this->db->select('c.id as id, c.category_name as text, p.id as parent, c.description');
        $this->db->join('category as p', 'p.id = c.parent_id', 'left');
        $this->db->from('category as c');
        $query = $this->db->get();
        $result = $query->result();
        $category = array();
        $categorylist = array();
        foreach ($result as $key => $value) {
            $cat = array('id' => $value->id,
                'parent' => $value->parent ? $value->parent : '#',
                'state' => array('opened' => TRUE),
                'description' => $value->description,
                'a_attr' => array('selectCategory' => ($value->id)),
                'text' => $value->text);
            array_push($category, $cat);
            $categorylist[$value->id] = $cat;
        }
        echo json_encode(array('tree' => $category, 'list' => $categorylist));
    }

    //Add Categories
    function categorie_delete($category_id) {
        $this->db->delete('category', array('id' => $category_id));
    }

    //Add Categories
    function categories() {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $this->db->select('c.id as id, c.category_name as text, p.id as parent');
        $this->db->join('category as p', 'p.id = c.parent_id', 'left');
        $this->db->from('category as c');
        $query = $this->db->get();

        $data['category_data'] = $query->result();

        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add Category') {
                $category_array = array(
                    'category_name' => $this->input->post('category_name'),
                    'description' => $this->input->post('description'),
                    'parent_id' => $this->input->post('parent_id'),
                );
                $this->db->insert('category', $category_array);
            }
            if ($_POST['submit'] == 'Edit') {
                echo $id = $this->input->post('parent_id');
                $this->db->set('category_name', $this->input->post('category_name'));
                $this->db->set('description', $this->input->post('description'));
                $this->db->where('id', $id);
                $this->db->update('category');
            }
            redirect('ProductManager/categories');
        }
        $this->load->view('productManager/categories', $data);
    }

    //
    //end of categories
    //----------------------------
    //Attribute 
    function attributeCategoryList($category_id) {
        $categorystr = $this->Product_model->parent_get($category_id);
        $categorylist = $categorystr['category_array'];
        $categorylistattr = array();
        foreach ($categorylist as $key => $value) {
            $category_temp = $value['id'];
            $this->db->from('category_attribute');
            $this->db->where('category_id', $category_temp);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                $temp = $query->result();
                foreach ($temp as $key => $value) {
                    $categorylistattr[$value->id] = $value;
                }
            }
        }
        return array('category_attribute' => $categorylistattr, 'category_id' => $category_id, 'category_str' => $categorystr['category_string']);
    }

    //
    function createAttribute($category_id) {
        if ($category_id > 0) {
            
        } else {
            redirect('ProductManager/createAttribute/1');
        }

        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $catarobj = $this->attributeCategoryList($category_id);
        $data['category_id'] = $catarobj['category_id'];
        $data['category_attribute'] = $catarobj['category_attribute'];
        $data['category_str'] = $catarobj['category_str'];

        if (isset($_POST['save_attr'])) {
            if ($_POST['save_attr'] == 'save_attr') {
                $category_attr_array = array(
                    'attribute_id' => $this->input->post('attribute_id'),
                    'attribute_value' => $this->input->post('attribute_value'),
                );
                $this->db->insert('category_attribute_value', $category_attr_array);
            }
            redirect('ProductManager/createAttribute/' . $category_id);
        }
        if (isset($_POST['submit'])) {
            if ($_POST['submit'] == 'Add Category') {
                $category_array = array(
                    'category_id' => $category_id,
                    'attribute' => $this->input->post('attribute'),
                    'display_index' => $this->input->post('display_index'),
                );
                $this->db->insert('category_attribute', $category_array);
            }
            if ($_POST['submit'] == 'Edit') {
                echo $id = $this->input->post('parent_id');
                $this->db->set('category_name', $this->input->post('category_name'));
                $this->db->set('description', $this->input->post('description'));
                $this->db->where('id', $id);
                $this->db->update('category');
            }
            redirect('ProductManager/createAttribute/' . $category_id);
        }
        $this->load->view('productManager/create_attribute', $data);
    }

    //end of attribute 
//
//Add product function
    function add_product() {
        $this->db->select('id, category_name');
        $query = $this->db->get('category');
        $data['category_data'] = $query->result();
        if (isset($_POST['submit'])) {
            $cat_name = $this->input->post('category_name');
            //$dat = date('Y-m-d ');
            //$tm = date('H:i:s');
            //$datetime = $dat . ' ' . $tm;
            $datetime = date("F j, Y, g:i a");
            //Check whether user upload picture
            if (!empty($_FILES['picture']['name'])) {

                $config['upload_path'] = 'assets_main/productimages';
                $config['allowed_types'] = '*';
                $temp1 = rand(100, 1000000);

                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "1." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }

                $ext2 = explode('.', $_FILES['picture1']['name']);
                $ext3 = strtolower(end($ext2));
                $file_newname1 = $temp1 . "2." . $ext3;
                $config['file_name'] = $file_newname1;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture1')) {
                    $uploadData1 = $this->upload->data();
                    $picture1 = $uploadData1['file_name'];
                } else {
                    $picture1 = '';
                }


                $ext4 = explode('.', $_FILES['picture2']['name']);
                $ext5 = strtolower(end($ext4));
                $file_newname2 = $temp1 . "3." . $ext5;
                $config['file_name'] = $file_newname2;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture2')) {
                    $uploadData2 = $this->upload->data();
                    $picture2 = $uploadData2['file_name'];
                } else {
                    $picture2 = '';
                }
            } else {
                $picture = '';
            }
            $user_id = $this->session->userdata('logged_in')['login_id'];
            $post_data = array(
                'title' => $this->input->post('title'),
                'category_id' => $this->input->post('category_name'),
                'short_description' => $this->input->post('short_description'),
                'description' => $this->input->post('description'),
                'regular_price' => $this->input->post('regular_price'),
                'sale_price' => $this->input->post('sale_price'),
                'price' => $this->input->post('price'),
                'file_name' => $file_newname,
                'file_name1' => $file_newname1,
                'file_name2' => $file_newname2,
                'status' => 1,
                'op_date_time' => $datetime,
                'user_id' => $user_id);

            $this->db->insert('products', $post_data);
            $last_id = $this->db->insert_id();
            $sku = "CAS" . $user_id . $last_id;
            $this->db->set('sku', $sku);
            $this->db->where('id', $last_id); //set column_name and value in which row need to update
            $this->db->update('products'); //
            //
            //Storing insertion status message.
            if ($last_id) {
                redirect('ProductManager/edit_product/' . $last_id);
                $this->session->set_flashdata('success_msg', 'User data have been added successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
        }
        $this->load->view('productManager/addProducts', $data);
    }

    //Edit product 
    function edit_product($product_id) {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;
        $data['product_attributes'] = $product_model->product_attribute_list($product_id);

        $data['attributefunction'] = $product_model;

        $data['product_detail_attrs'] = $product_model->productAttributes($product_id);

        $this->db->select('*');
        $this->db->where('id', $product_id);
        $query = $this->db->get('products');

        if ($query->num_rows() > 0) {
            $productobj = $query->result()[0];
            $data['product_obj'] = $productobj;
        } else {
            redirect('ProductManager/productReport');
        }
        $vproduct_id = $product_id;
        if ($productobj->variant_product_of) {
            $vproduct_id = $productobj->variant_product_of;
        }

        $category_id = $productobj->category_id;
        $product_query = "select pt.id as product_id, sku, pt.short_description, pt.title, pt.sale_price, pt.regular_price, pt.price, pt.file_name 
            from products as pt where (pt.id  = $vproduct_id) or (variant_product_of = $vproduct_id) ";
        $query = $this->db->query($product_query);
        $product_result_variant = $query->result();
        $data['variant_products'] = $product_result_variant;


        $category_id = $productobj->category_id;
        $product_query = "select pt.id as product_id,sku, pt.short_description, pt.title, pt.sale_price, pt.regular_price, pt.price, pt.file_name 
            from products as pt where pt.category_id in ($category_id) and pt.id !=$product_id and pt.id not in (select related_product_id from product_related where product_id = $product_id) and variant_product_of=0 ";
        $query = $this->db->query($product_query);
        $product_result_related = $query->result();
        $data['related_products_check'] = $product_result_related;


        $category_id = $productobj->category_id;
        $product_query = "select pr.id as related_product_id, pt.id as product_id,sku, pt.short_description, pt.title, pt.sale_price, pt.regular_price, pt.price, pt.file_name 
            from products as pt join product_related as pr on pr.product_id = pt.id
            where pr.product_id =$product_id  ";
        $query = $this->db->query($product_query);
        $product_result_related = $query->result();
        $data['related_products'] = $product_result_related;


        $this->db->select('id, category_name');
        $query = $this->db->get('category');
        $data['category_data'] = $query->result();
        $catarobj = $this->attributeCategoryList($productobj->category_id);
        $data['category_id'] = $catarobj['category_id'];
        $data['category_attribute'] = $catarobj['category_attribute'];
        $data['category_str'] = $catarobj['category_str'];

        //add new attr
        if (isset($_POST['save_attr'])) {
            $category_attr_array = array(
                'attribute_id' => $this->input->post('attribute_id'),
                'attribute_value' => $this->input->post('attribute_value'),
            );
            $this->db->insert('category_attribute_value', $category_attr_array);
            $last_id = $this->db->insert_id();
            $this->db->delete('product_attribute', array('product_id' => $product_id, "attribute_id" => $this->input->post('attribute_id')));
            $productattr = array('product_id' => $product_id,
                'attribute_id' => $this->input->post('attribute_id'),
                'attribute' => $this->input->post('attribute_name'),
                'attribute_value_id' => $last_id);
            $this->db->insert('product_attribute', $productattr);
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //end of new attr
        //update procuct
        if (isset($_POST['editdata'])) {
            $cat_name = $this->input->post('category_name');
            //$dat = date('Y-m-d ');
            //$tm = date('H:i:s');
            //$datetime = $dat . ' ' . $tm;
            $datetime = date("F j, Y, g:i a");
            //Check whether user upload picture
            $temp1 = rand(100, 1000000);
            $picture = $data['product_obj']->file_name;
            $picture1 = $data['product_obj']->file_name1;
            $picture2 = $data['product_obj']->file_name2;
            
            $video_link = $data['product_obj']->video_link;
            
            $config['upload_path'] = 'assets_main/productimages';
            $config['allowed_types'] = '*';
//            $config['overwrite'] = TRUE;

            if (!empty($_FILES['picture']['name'])) {
                $ext2 = explode('.', $_FILES['picture']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $picture);
                $ext33 = strtolower(end($ext22));
                $filename = $ext22[0];
                $file_newname = $filename . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $file_newname = $uploadData['file_name'];
                    $this->db->set('file_name', $file_newname);
                }
            }

            if (!empty($_FILES['picture1']['name'])) {
                $ext2 = explode('.', $_FILES['picture1']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $picture1);
                $ext33 = strtolower(end($ext22));
                if ($picture1) {
                    $filename = $ext22[0];
                } else {
                    $filename = $temp1 . "1";
                }
                $file_newname = $filename . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture1')) {
                    $uploadData = $this->upload->data();
                    $uploadData = $this->upload->data();
                    $file_newname = $uploadData['file_name'];
                    $this->db->set('file_name1', $file_newname);
                    $this->db->where('id', $product_id); //set column_name and value in which row need to update
                    $this->db->update('products'); //
                }
            }


            if (!empty($_FILES['picture2']['name'])) {
                $ext2 = explode('.', $_FILES['picture2']['name']);
                $ext3 = strtolower(end($ext2));
                $ext22 = explode('.', $picture2);
                $ext33 = strtolower(end($ext22));
                if ($picture2) {
                    $filename = $ext22[0];
                } else {
                    $filename = $temp1 . "3";
                }
                $file_newname = $filename . '.' . $ext3;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture2')) {
                    $uploadData = $this->upload->data();
                    $file_newname = $uploadData['file_name'];
                    $this->db->set('file_name2', $file_newname);
                    $this->db->where('id', $product_id); //set column_name and value in which row need to update
                    $this->db->update('products'); //
                }
            }


            $attrid = $this->input->post('attr_id');
            $attrval = $this->input->post('attr_value');
            $attrname = $this->input->post('attr_name');
            $this->db->delete('product_attribute', array('product_id' => $product_id));
            if ($attrval) {
                foreach ($attrid as $key => $value) {
                    $attr_id = $attrid[$key];
                    $attr_val = $attrval[$key];
                    $attr_name = $attrname[$key];
                    if ($attr_val) {
                        $productattr = array('product_id' => $product_id,
                            'attribute_id' => $attr_id,
                            'attribute' => $attr_name,
                            'attribute_value_id' => $attr_val);
                        $this->db->insert('product_attribute', $productattr);
                    }
                }
            }

            $user_id = $this->session->userdata('logged_in')['login_id'];

            $this->db->set('category_id', $this->input->post('category_name'));
            $this->db->set('description', $this->input->post('description'));
            $this->db->set('title', $this->input->post('title'));
            $this->db->set('short_description', $this->input->post('short_description'));
            $this->db->set('regular_price', $this->input->post('regular_price'));
            $this->db->set('sale_price', $this->input->post('sale_price'));
            $this->db->set('price', $this->input->post('price'));
            $this->db->set('credit_limit', $this->input->post('credit_limit'));
            $this->db->set('stock_status', $this->input->post('stock_status'));
            $this->db->set('keywords', $this->input->post('keywords'));
            $this->db->set('video_link', $this->input->post('video_link'));
            
            

            $this->db->set('home_slider', $this->input->post('home_slider'));
            $this->db->set('home_bottom', $this->input->post('home_bottom'));

            $this->db->where('id', $product_id); //set column_name and value in which row need to update
            $this->db->update('products'); //
            //Storing insertion status message.
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //end of update product
        //add related products
        if (isset($_POST['add_realted_products'])) {
            $productlists = $this->input->post('related_product_id');

            foreach ($productlists as $key => $value) {
                $related_product_array = array(
                    'related_product_id' => $value,
                    'product_id' => $product_id,
                );
                $this->db->insert('product_related', $related_product_array);
            }

            //$last_id = $this->db->insert_id();
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //end of realted products
        //remove related products
        if (isset($_POST['remove_realted_products'])) {
            $productlists = $this->input->post('related_product_id');

            foreach ($productlists as $key => $value) {
                $related_product_id = $value;
                $this->db->where('id', $related_product_id);
                $this->db->delete('product_related');
            }

            //$last_id = $this->db->insert_id();
            redirect('ProductManager/edit_product/' . $product_id);
        }
        //remove of realted products

        $this->load->view('productManager/editProducts', $data);
    }

    //variant_product
    function variant_product($product_id) {
        $this->db->where('id', $product_id);
        $query = $this->db->get('products');
        $product = $query->row_array();
        unset($product['id']);
        $product['variant_product_of'] = $product_id;
        $this->db->insert('products', $product);
        $last_id = $this->db->insert_id();
        $sku = "CAS" . $user_id . $last_id;
        $this->db->set('sku', $sku);
        $this->db->where('id', $last_id); //set column_name and value in which row need to update
        $this->db->update('products');

        redirect('ProductManager/edit_product/' . $last_id);
    }

    function productReport() {
        $product_model = $this->Product_model;
        $data['product_model'] = $product_model;

        $query = "select p.*, c.category_name, au.first_name, au.last_name, au.email, au.image from products as p"
                . " join category as c on c.id = p.category_id "
                . "left join admin_users as au on au.id = p.user_id ";
        if ($this->user_type == 'Admin') {
            $query = $query . "  order by id desc";
            $data['product_data'] = $this->Product_model->query_exe($query);
            $this->load->view('productManager/productReport', $data);
        } else {
            $query = $query . " where p.user_id='" . $this->user_id . "' order by p.id desc";
            $data['product_data'] = $this->Product_model->query_exe($query);
            $this->load->view('productManager/productReport', $data);
        }
    }

    //Add product function
    function add_sliders() {
        $query = $this->db->get('sliders');
        $data['sliders'] = $query->result();
        if (isset($_POST['submit'])) {
            if (!empty($_FILES['picture']['name'])) {
                $config['upload_path'] = 'assets/paymentstatus';
                $config['allowed_types'] = '*';
                $temp1 = rand(100, 1000000);
                $ext1 = explode('.', $_FILES['picture']['name']);
                $ext = strtolower(end($ext1));
                $file_newname = $temp1 . "1." . $ext;
                $config['file_name'] = $file_newname;
                //Load upload library and initialize configuration
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('picture')) {
                    $uploadData = $this->upload->data();
                    $picture = $uploadData['file_name'];
                } else {
                    $picture = '';
                }
            } else {
                $picture = '';
            }
            $user_id = $this->session->userdata('logged_in')['login_id'];
            $post_data = array(
                'title' => $this->input->post('title'),
                'line1' => $this->input->post('line1'),
                'line2' => $this->input->post('line2'),
                'link' => $this->input->post('link'),
                'link_text' => $this->input->post('link_text'),
                'file_name' => $file_newname);

           
            $this->db->insert('sliders', $post_data);
            $last_id = $this->db->insert_id();
            redirect('ProductManager/add_sliders');
        }
        $this->load->view('productManager/add_sliders', $data);
    }

}
