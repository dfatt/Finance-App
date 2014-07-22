<?php

class Account_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array ('url', 'date'));
    }

    function create_account()
    {
        $post = $this->input->post();

        $item = array(
            'client' => $post['client'],
            'serial' => $post['serial'],
            'balance' => $post['balance'],
            'date_create' => mdate("%Y-%m-%d %H:%i:%s", time())
        );

        return $this->db->insert('accounts', $item);
    }
}