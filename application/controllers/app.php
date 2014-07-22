<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class App extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->load->model('account_model');
        $this->load->helper(array('html', 'form'));
        $this->load->library('form_validation');
    }

    /**
     * Стартовая страница приложения
     */
	public function index()
	{
		$this->load->view('hello');
	}

    /**
     * Создание счёта
     */
    public function create_account()
    {
        $rules = array(
            array(
                'field'   => 'client',
                'label'   => 'Имя клиента',
                'rules'   => 'required|trim'
            ),
            array(
                'field'   => 'serial',
                'label'   => 'Номер счёта',
                'rules'   => 'required'
            ),
            array(
                'field'   => 'balance',
                'label'   => 'Баланс',
                'rules'   => 'required|numeric'
            )
        );

        $this->form_validation->set_rules($rules);

        if ($this->form_validation->run() === FALSE) {
            $this->load->view('/accounts/create');
        } else {
            $this->account_model->create_account();

            redirect('/', 'refresh');
        }
    }

    /**
     * Перевод средств
     */
    public function transfer()
    {
        // Если произвели отправку формы
        if ($this->input->post()) {
            if ($this->account_model->create_transfer()) {
                redirect('/', 'refresh');
            }
        }

        $this->load->view('/accounts/transfer', array('accounts' => $this->account_model->get_accounts()));
    }

    /**
     * Список счетов
     */
    public function accounts()
    {
        $this->load->helper('url');
        $this->load->view('/accounts/list', array('accounts' => $this->account_model->get_accounts()));
    }
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */