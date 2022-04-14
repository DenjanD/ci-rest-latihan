<?php

    class CemilanModel extends CI_Model {
        public function get_data(){
            return $this->db->get('cemilan')->result();
        }
    }