<?php
	/**
	 * Ini adalah controller untuk memenajemen login
	 */
	class loginController extends CI_Controller
	{

		public $statusLogin = false;
		
		public function __construct()
		{
			parent::__construct();
			$this->load->library('form_validation');
			$this->load->model('account/dataUser');
			if($this->session->userdata('username') != false) {
				$this->statusLogin = true;
			}
		}

		public function index()
		{
			if($this->statusLogin != true) {
				$this->load->view('auth/login');
			} else {
				$informasi = array(
					'message' => 'Are you loged in',
					'buttonText' => 'Go home',
					'getLink' => 'home'
				);
				$this->load->view('alert/err', $informasi);
			}
		}

		public function loginAct()
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
				$this->form_validation->set_rules('user', 'Username', 'required|alpha_numeric');
				$this->form_validation->set_rules('pass', 'Password', 'required|alpha_numeric');
				if($this->form_validation->run() == false) {
					$this->load->view('auth/login');
				} else {
					$cekData = $this->dataUser->getUser($user, $pass);
					if($cekData->num_rows() != false) {
						$this->session->set_userdata($cekData->row_array());
						$sessUser = $this->session->userdata('username');
						$sessPass = $this->session->userdata('password');
						
						if($sessUser && $sessPass) {
							$informasi = array(
								'message' => 'Login success selamat datang '.'"'.$this->session->userdata('username').'"',
								'buttonText' => 'Go home',
								'getLink' => 'home'
							);
							$this->load->view('alert/success', $informasi);
						} else {
							$informasi = array(
								'message' => 'Login failed!',
								'buttonText' => 'Login',
								'getLink' => 'login'
							);
							$this->load->view('alert/err', $informasi);
						}
					} else {
						$informasi = array(
							'message' => 'Login failed!',
							'buttonText' => 'Login',
							'getLink' => 'login'
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

		public function logout()
		{
			if($this->statusLogin != false) {
				if(session_destroy()) {
					redirect('login');
				} else {
					$informasi = array(
						'message' => 'Some thing whent wrong!',
						'buttonText' => 'Go home',
						'getLink' => 'home'
					);
					$this->load->view('alert/err', $informasi);
				}
			} else {
				$informasi = array(
					'message' => 'You\'re not loged in',
					'buttonText' => 'Login',
					'getLink' => 'login'
				);
				$this->load->view('alert/err', $informasi);
			}
		}

	}
?>