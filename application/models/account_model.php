<?php

class Account_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();
        $this->load->helper(array ('url', 'date'));
    }

    /**
     * Список счетов
     *
     * @return array
     */
    public function get_accounts()
    {
        $query = $this->db->get_where('accounts', array('serial !=' => 0));

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    /**
     * Создание счёта
     *
     * @return boolean
     */
    public function create_account()
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

    /**
     * Перевод средств
     *
     * @return boolean
     */
    public function create_transfer()
    {
        $post = $this->input->post();

        $from = $post['from'];
        $to = $post['to'];

        // Получаем сумму средств отправителя
        $from_b = $this->db->get_where('accounts', array('serial' => $from))
                           ->row()
                           ->balance;

        // Получаем сумму средств получателя
        $to_b = $this->db->get_where('accounts', array('serial' => $to))
                         ->row()
                         ->balance;

        // Подсчитываем нашу коммисию
        $commission_price = round($from_b * 0.0099);

        // Списываем средства у отправителя
        $this->db->where('serial', $from)
                 ->update('accounts', array('balance' => '0'));

        // Начисляем средства получателю
        $this->db->where('serial', $to)
                 ->update('accounts', array('balance' => $from_b + $to_b - $commission_price));

        // Начисляем средства на наш счёт
        $this->db->where('serial', 0)
                 ->update('accounts', array('balance' => $commission_price));

        // Добавляем информацию в таблицу переводов средств
        $item = array(
            'from' => $from,
            'to' => $to,
            'amount' => $from_b,
            'date_create' => mdate("%Y-%m-%d %H:%i:%s", time())
        );

        // Если запись добавлена, списываем средства со счёта отправителя
        if ($this->db->insert('transfers', $item)) {
            return true;
        } else {
            return false;
        }
    }
}