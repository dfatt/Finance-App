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
            $data = $this->input->post();
            $this->account_model->create_account($data);

            redirect('/', 'refresh');
        }
    }

    /**
     * Перевод средств
     */
    public function transfer()
    {
        $errors = '';

        // Если произвели отправку формы
        if ($data = $this->input->post()) {
            $errors = $this->account_model->create_transfer($data);

            // Если всё прошло без ошибок, переадресовываем на главную
            if ($errors === false) {
                redirect('/', 'refresh');
            }
        }

        $this->load->view('/accounts/transfer', array('accounts' => $this->account_model->get_accounts(), 'errors' => $errors));
    }

    /**
     * Список счетов
     */
    public function accounts()
    {
        $this->load->helper('url');
        $this->load->view('/accounts/list', array('accounts' => $this->account_model->get_accounts()));
    }

    /**
     * Просмотр истории по конкретному счёту
     *
     * @param $serial
     * @internal param $account_number
     */
    public function account($serial)
    {
        $data = array(
            'history' => $this->account_model->get_history_by_account_number($serial),
            'account' => $this->account_model->get_account_by_serial($serial)

        );

        $this->load->view('/accounts/history', $data);
    }
}

/* End of file app.php */
/* Location: ./application/controllers/app.php */