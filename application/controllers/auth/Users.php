<?php

defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class User
 */
class Users extends MY_Controller
{
	public $data = [];

	public function __construct()
	{
		parent::__construct();

		// Config
		$this->_name = 'users';
		$this->_path = "auth/{$this->_name}/"; // Contoh 'backend/dashboard/ / 'frontend/home/'

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');

		$this->load->model($this->_path . 'Datatable');   // Load Datatable model

	}

	/**
	 * Redirect if needed, otherwise display the user list
	 */
	public function index()
	{
		has_permission("access-{$this->_name}");
		method('get');

		$config = [
			'title' => ucwords($this->_name),
			'type' => 'backend',
			'breadcrumb' => [
				'Auth', 'Manajemen', ucwords($this->_name)
			],
			'uri_segment' => $this->_path,
			'page' => $this->_path . 'index',
			'script' => $this->_path . 'js/script.js.php',
			'style' => $this->_path . 'css/style.css.php',
			'modals' => []
		];

		render($config);
	}

	public function edit_account()
	{
		method('post');

		$this->form_validation->set_data(post());
		$this->form_validation->set_rules('username', 'username', 'required|trim');
		$this->form_validation->set_rules('password', 'password', 'required|trim|min_length[8]');
		$this->form_validation->set_rules('password_confirmation', 'konfirmasi password', 'required|trim|matches[password]');
		if (!$this->form_validation->run()) {
			response([
				'status' => false,
				'message' => 'Please check your input again!',
				'errors' => $this->form_validation->error_array(),
				'payload' => post()
			], 422);
		}

		$this->db->update('users', [
			'username' => post('username'),
			'password' => $this->ion_auth->hash_password(post('password'))
		], ['id' => get_user_id()]);

		response([
			'status' => true,
			'message' => 'Berhasil mengupdate account',
			'query' => $this->db->last_query(),
			'payload' => post()
		], 200);
	}

	public function data_user()
	{
		has_permission("access-{$this->_name}");
		method('post');

		response($this->Datatable->list());
	}

	/**
	 * Create a new user
	 */
	public function create_user()
	{
		has_permission("create-{$this->_name}");
		$this->data['title'] = $this->lang->line('create_user_heading');

		$identity_column = $this->config->item('identity', 'ion_auth');
		$this->data['identity_column'] = $identity_column;

		if ($this->input->method() === 'get') :
			// display the create user form
			// set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = [
				'name' => 'first_name',
				'id' => 'first_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			];
			$this->data['last_name'] = [
				'name' => 'last_name',
				'id' => 'last_name',
				'type' => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			];
			$this->data['identity'] = [
				'name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			];
			$this->data['email'] = [
				'name' => 'email',
				'id' => 'email',
				'type' => 'text',
				'value' => $this->form_validation->set_value('email'),
			];
			$this->data['company'] = [
				'name' => 'company',
				'id' => 'company',
				'type' => 'text',
				'value' => $this->form_validation->set_value('company'),
			];
			$this->data['phone'] = [
				'name' => 'phone',
				'id' => 'phone',
				'type' => 'text',
				'value' => $this->form_validation->set_value('phone'),
			];
			$this->data['password'] = [
				'name' => 'password',
				'id' => 'password',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password'),
			];
			$this->data['password_confirm'] = [
				'name' => 'password_confirm',
				'id' => 'password_confirm',
				'type' => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			];

			$config = [
				'title' => $this->data['title'],
				'type' => 'backend',
				'identity_column' => $this->data['identity_column'],
				'breadcrumb' => [
					'Auth', 'Manajemen', ucwords($this->_name), 'Create'
				],
				'first_name' => $this->data['first_name'],
				'last_name' => $this->data['last_name'],
				'identity' => $this->data['identity'],
				'email' => $this->data['email'],
				'company' => $this->data['company'],
				'phone' => $this->data['phone'],
				'password' => $this->data['password'],
				'password_confirm' => $this->data['password_confirm'],
				'message' => $this->data['message'],
				'uri_segment' => $this->_path,
				'page' => $this->_path . 'create/index',
				'script' => $this->_path . 'create/js/script.js.php',
				'style' => $this->_path . 'create/css/style.css.php',
				'modals' => []
			];

			render($config);

		elseif ($this->input->method() === 'post') :

			$email = strtolower(post('email'));
			$identity = ($identity_column === 'email') ? $email : post('identity');
			$password = post('password');

			$additional_data = [
				'uuid' => uuid(),
				'first_name' => post('first_name'),
				'last_name' => post('last_name'),
				'company' => post('company'),
				'phone' => post('phone'),
			];

			if ($this->ion_auth->register($identity, $password, $email, $additional_data)) {
				// check to see if we are creating the user
				// redirect them back to the admin page
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
				// redirect("auth", 'refresh');
				response([
					'status' => true,
					'message' => 'User berhasil ditambahkan',
					'data' => null,
				], 200);
			}
			response([
				'status' => false,
				'message' => 'Gagal',
				'data' => null,
				'errors' => $this->ion_auth->messages(),
			], 400);
		endif;
	}


	/**
	 * Edit a user
	 *
	 * @param int|string $id
	 */
	public function edit_user($uuid = null)
	{
		has_permission("update-{$this->_name}");

		$id = @$this->db->get_where('users', [
			'uuid' => $uuid
		])->row()->id;

		$this->data['title'] = $this->lang->line('edit_user_heading');

		$user = $this->ion_auth->user($id)->row();
		if (!$user || !$id) show_404();

		$groups = $this->ion_auth->groups()->result_array();
		$currentGroups = $this->ion_auth->get_users_groups($id)->result_array();
		//USAGE NOTE - you can do more complicated queries like this

		if ($this->input->method() === 'get') :

			// pass the user to the view
			$this->data['user'] = $user;
			$this->data['groups'] = $groups;
			$this->data['currentGroups'] = $currentGroups;

			$this->data['first_name'] = [
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name', $user->first_name),
			];
			$this->data['last_name'] = [
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name', $user->last_name),
			];
			$this->data['company'] = [
				'name'  => 'company',
				'id'    => 'company',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('company', $user->company),
			];
			$this->data['phone'] = [
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone', $user->phone),
			];
			$this->data['password'] = [
				'name' => 'password',
				'id'   => 'password',
				'type' => 'password'
			];
			$this->data['password_confirm'] = [
				'name' => 'password_confirm',
				'id'   => 'password_confirm',
				'type' => 'password'
			];

			$config = [
				'title' => $this->data['title'],
				'type' => 'backend',
				'breadcrumb' => [
					'Auth', 'Manajemen', ucwords($this->_name), 'Edit'
				],
				'first_name' => $this->data['first_name'],
				'last_name' => $this->data['last_name'],
				'company' => $this->data['company'],
				'phone' => $this->data['phone'],
				'password' => $this->data['password'],
				'password_confirm' => $this->data['password_confirm'],
				'user' => $this->data['user'],
				'groups' => $this->data['groups'],
				'currentGroups' => $this->data['currentGroups'],
				'uri_segment' => $this->_path,
				'page' => $this->_path . 'edit/index',
				'script' => $this->_path . 'edit/js/script.js.php',
				'style' => $this->_path . 'edit/css/style.css.php',
				'modals' => []
			];

			render($config);

		elseif ($this->input->method() == 'post') :

			$data = [
				'uuid' => uuid(),
				'first_name' => post('first_name'),
				'last_name' => post('last_name'),
				'company' => post('company'),
				'phone' => post('phone'),
			];

			// update the password if it was posted
			if (post('password')) {
				$data['password'] = post('password');
			}

			// Only allow updating groups if user is admin
			if ($this->ion_auth->is_admin()) {
				// Update the groups user belongs to
				$this->ion_auth->remove_from_group('', $id);

				$groupData = post('groups');
				if (isset($groupData) && !empty($groupData)) {
					foreach ($groupData as $grp) {
						$this->ion_auth->add_to_group($grp, $id);
					}
				}
			}

			// check to see if we are updating the user
			if ($this->ion_auth->update($user->id, $data)) {
				// redirect them back to the admin page if admin, or to the base url if non admin
				// $this->session->set_flashdata('message', $this->ion_auth->messages());
				// $this->redirectUser();
				response([
					'status' => true,
					'message' => 'User berhasil diubah',
					'data' => null,
				], 200);
			}
			// redirect them back to the admin page if admin, or to the base url if non admin
			// $this->session->set_flashdata('message', $this->ion_auth->errors());
			// $this->redirectUser();
			response([
				'status' => true,
				'message' => "Gagal",
				'data' => null,
				'errors' => $this->ion_auth->errors(),
			], 400);
		endif;
	}

	public function delete_user()
	{
		has_permission("delete-{$this->_name}");
		method('post');

		$id = @$this->db->get_where('users', [
			'uuid' => post('uuid')
		])->row()->id;

		$user = $this->ion_auth->user($id)->row();
		if (!$user || !$id) show_404();

		if ($this->ion_auth->delete_user($id)) {
			response([
				'status' => true,
				'message' => 'User berhasil dihapus',
				'data' => null,
			], 200);
		}

		response([
			'status' => false,
			'message' => 'Gagal',
			'data' => null,
			'errors' => $this->ion_auth->errors(),
		], 400);
	}

	/**
	 * Activate the user
	 *
	 * @param int         $id   The user ID
	 * @param string|bool $code The activation code
	 */
	public function activate($id = null, $code = FALSE)
	{
		method('post');

		$id = (ctype_xdigit($id) && strlen($id) % 2 === 0) ? $this->encryption->decrypt(hex2bin($id)) : null;

		$user = $this->ion_auth->user($id)->row();
		if (!$user || !$id) show_404();

		if ($code !== FALSE) {
			$this->ion_auth->activate($id, $code);
		} else if ($this->ion_auth->is_admin()) {
			$this->ion_auth->activate($id);
		}

		response([
			'status' => true,
			'message' => 'Status berhasil diubah',
			'data' => null,
		], 200);
	}

	/**
	 * Deactivate the user
	 *
	 * @param int|string|null $id The user ID
	 */
	public function deactivate($id = NULL)
	{
		method('post');

		$id = (ctype_xdigit($id) && strlen($id) % 2 === 0) ? $this->encryption->decrypt(hex2bin($id)) : null;

		$user = $this->ion_auth->user($id)->row();
		if (!$user || !$id) show_404();

		if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}

		$id = (int)$id;

		// do we really want to deactivate?
		if (post('confirm') === 'yes') {
			// do we have a valid request?		
			// do we have the right userlevel?
			$this->ion_auth->deactivate($id);
		}

		response([
			'status' => true,
			'message' => 'Status berhasil diubah',
			'data' => null,
		], 200);
	}

	public function dark_mode()
	{
		method('post');

		$this->db->trans_begin();

		$update = $this->db->update('users', [
			'dark_mode' => post('dark_mode'),
		], ['id' => get_user_id()]);

		if (!$update || !$this->db->trans_status()) {    // Check transaction status
			$this->db->trans_rollback();		// Rollback transaction
			response([
				'status' => false,
				'message' => 'Failed',
				'errors' => $this->db->error(),
				'query' => $this->db->last_query(),
			], 404);
		}

		session('dark_mode', post('dark_mode'));
		$this->db->trans_commit();		// Commit transaction

		response([
			'status' => true,
			'message' => 'Berhasil mengubah mode',
		], 200);
	}

	public function sidebar()
	{
		method('post');

		$this->db->trans_begin();

		$update = $this->db->update('users', [
			'sidebar' => post('sidebar'),
		], ['id' => get_user_id()]);

		if (!$update || !$this->db->trans_status()) {    // Check transaction status
			$this->db->trans_rollback();		// Rollback transaction
			response([
				'status' => false,
				'message' => 'Failed',
				'errors' => $this->db->error(),
				'query' => $this->db->last_query(),
			], 404);
		}

		session('sidebar', post('sidebar'));
		$this->db->trans_commit();		// Commit transaction

		response([
			'status' => true,
			'message' => 'Berhasil mengubah sidebar',
		], 200);
	}
}
