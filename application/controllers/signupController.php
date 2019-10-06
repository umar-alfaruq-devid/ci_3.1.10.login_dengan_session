<?php
	/**
	 * Ini adalah kontroler untuk memanejemen pendaftaran
	 */
	class signupController extends CI_Controller
	{

		public $statusLogin = false;
		
		public function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('account/insertUser');
			if($this->session->userdata('username') != false) {
				$this->statusLogin = true;
			}
		}

		public function index() 
		{
			if($this->statusLogin != true) {
				$this->load->view('auth/signup');
			} else {
				$informasi = array(
					'message' => 'Are you loged in',
					'buttonText' => 'Go home',
					'getLink' => 'home'
				);
				$this->load->view('alert/err', $informasi);
			}
		}

		/**
		 * aksi untuk memanajemen pendaftaran
		 */
		public function signupAct()
		{
			if($this->statusLogin != true) {
				$user = $this->input->post('user');
				$pass = $this->input->post('pass');

				/**
				 * set pesan
				 */

				$this->form_validation->set_message('required', '{field} tidak boleh kosong');
				$this->form_validation->set_message('alpha_numeric', '{field} hanya angka dan huruf');
				$this->form_validation->set_message('min_length', '{field} minimal {param} karakter');
				$this->form_validation->set_message('is_unique', '{field} sudah di gunakan');
				$this->form_validation->set_message('matches', '{field} tidak sama dengan {param}');

				 /**
				 * set peraturan validasi
				 */
				$this->form_validation->set_rules('user', 'Username', 'required|alpha_numeric|min_length[8]|is_unique[accounts.username]');
				$this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric|min_length[8]');
				$this->form_validation->set_rules('retype', 'Ulang password', 'required|alpha_numeric|matches[pass]');
				if($this->form_validation->run() == false) {
					$this->load->view('auth/signup');
				} else {
					$data = array(
						'username' => $user,
						'password' => $pass,
						'created_at' => date('Y-m-d H:i:s')
					);
					$queryIsi = $this->insertUser->inserAccount('accounts', $data);
					if($queryIsi) {
						$informasi = array(
							'message' => 'Account is created',
							'buttonText' => 'Go home',
							'getLink' => 'home'
						);

						$this->load->view('alert/success', $informasi);
					} else {
						$informasi = array(
							'message' => 'Some thing whent wrong',
							'buttonText' => 'Signup',
							'getLink' => 'signup'
						);

						$this->load->view('alert/err', $informasi);
					}
				}
			} else {
				$informasi = array(
					'message' => 'You\'re loged in',
					'buttonText' => 'Logout',
					'getLink' => 'logout'
				);
				$this->load->view('alert/err', $informasi);
			}
		}

	}
?>