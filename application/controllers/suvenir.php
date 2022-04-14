<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';

use Restserver\Libraries\REST_Controller;

class Suvenir extends REST_Controller {
    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        if ($this->get('id') != '') {
            $this->db->where('id', $this->get('id'));
        }
        $suvenir = $this->db->get('suvenir')->result();
        
        $this->response(array('suvenir' => $suvenir), 200);
    }

    function index_post() {
        $data = array(
            'nama' => $this->post('nama'),
            'jumlah' => $this->post('jumlah'));
        
        if ($this->db->insert('suvenir', $data)) {
            $this->response(array('msg' => 'insert success', 'newData' => $data), 200);
        } else {
            $this->response(array('msg' => 'insert fail', 502));
        }
    }

    function index_put() {
        $data = array(
            'nama' => $this->put('nama'),
            'jumlah' => $this->put('jumlah'));
        
        $this->db->where('id', $this->put('id'));
        
        if ($this->db->update('suvenir', $data)) {
            $this->response(array('msg' => 'update success', 'newData' => $data), 200);
        } else {
            $this->response(array('msg' => 'update fail', 502));
        }
    }

    function index_delete() {   
        $this->db->where('id', $this->delete('id'));
        
        if ($this->db->delete('suvenir')) {
            $this->response(array('msg' => 'delete success'), 201);
        } else {
            $this->response(array('msg' => 'delete fail', 502));
        }
    }


}
?>
