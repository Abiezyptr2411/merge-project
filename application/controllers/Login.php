<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function index()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$data['title'] = 'Sign In';
			$this->load->view('login', $data);
		} else {
			$email_or_username = $this->input->post('email_or_username');
			$password = $this->input->post('password');

			if (empty($email_or_username) || empty($password)) {
				$_SESSION["gagal"] = 'Silahkan periksa username dan password anda';
				redirect('login');
			}

			$cek = $this->model->cek_auth($email_or_username, $password);

			if ($cek == FALSE) {
				$_SESSION["gagal"] = 'Silahkan periksa username dan password anda';
				redirect('login');
			} else {
				$this->session->set_userdata('username', $cek->username);
				$this->session->set_userdata('email', $cek->email);
				$this->session->set_userdata('user_id', $cek->user_id);
				$this->session->set_userdata('role', $cek->role);

				switch ($cek->role) {
					case 1:
						redirect('admin/dashboard');
						break;
					case 2:
						redirect('pengurus/dashboard');
						break;
					case 3:
						redirect('pegawai/dashboard');
						break;
					default:
						// Tindakan default jika tidak ada peran yang cocok
						break;
				}
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('email_or_username', 'Email or Username', 'required');
		$this->form_validation->set_rules('password', 'password', 'required');
	}

	public function logout()
	{
		session_destroy();
		$url = base_url('login');
		redirect($url);
	}
}
