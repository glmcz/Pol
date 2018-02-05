<?php
class Auth extends MY_Controller
{
	// Used for registering and changing password form validation
	var $min_username = 4;
	var $max_username = 20;
	var $min_password = 4;
	var $max_password = 20;

    public function __construct()
    {
        parent::__construct();

		$this->load->library('Form_validation');
		$this->load->library('dx_auth');
    }

	function index()
	{
		$this->login();
	}

    function my_account()
	{

		if ( $this->dx_auth->is_logged_in())
		{
		    $this->load->model('dx_auth/users', 'users');
            //language for links
            if(LANGUAGE == 'cz'){

                $data['lang'] = '';
                $data['content'] = array(
                    'title' => $this->lang->line('my_account')
                );

			}
			else{
                $data['lang'] = LANGUAGE.'/';
                $data['content'] = array(
                    'title' => $this->lang->line('my_account')
                );
			}
//			dump($this->session->all_userdata());
            //USER DATA
            $user_id                        = $this->dx_auth->get_user_id();
            $user_name                      = $this->dx_auth->get_username();
            $user_email                     = $this->dx_auth->get_user_email();
            $data['user_profile']           = $this->users->get_user_by_id($user_id)->row();
//			dump($data['user_profile']);
            $data['user_created_articles']  = $this->users->get_user_created_articles($user_id)->result_array();
            $data['user_updated_articles']  = $this->users->get_user_updated_articles($user_id)->result_array();
            $data['user_comments']          = $this->users->get_user_comments($user_email, $user_id)->result_array();

            //VALIDATION
            $val = $this->form_validation;

			// Set form validation rules
            $val->set_rules('id', 'User ID', 'trim|required|xss_clean|integer|max_length[11]');

            if($this->input->post('username') != $user_name){
                $val->set_rules('username', 'Jméno', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
            }else{
                $val->set_rules('username', 'Jméno', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|alpha_dash');
            }

            if($this->input->post('email') != $data['user_profile']->email){
                $val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');
            }else{
                $val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            }

            if($this->input->post('password') != '' && $this->input->post('confirm_password') != ''){
                $val->set_rules('password', 'Heslo', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
                $val->set_rules('confirm_password', 'Potvrďte heslo', 'trim|required|xss_clean');
            }

			// Загружаем библиотеку аплоада файлов с определённой конфигурацией
			$config['upload_path']      = 'assets/uploads/avatars/';
			$config['allowed_types']    = 'gif|jpg|png';
			$config['max_size']         = $this->config->item('size_limit');
			$config['max_width']        = '1024';
			$config['max_height']       = '768';
			$config['encrypt_name']     = true;
			$this->load->library('upload', $config);
			// Загружаем аватар
			$uploaded   = $this->upload->do_upload('image');

			$image_file_name = '';
//			dump($uploaded);
//			dump_exit($_FILES);
			// Если это существующий каталог и загрузка изображения прошла
			if($user_id && $uploaded)
			{
				// Удаляем оригинайльный файл если был загружен другой файл
				$this->users->delete_user_image($data['user_profile']->image);
				// Получаем новый файл
				$image = $this->upload->data();
				$image_file_name = $image['file_name'];
				// Обрабатываем изображение
				$this->do_moo($image);
			}
			elseif(!empty($_FILES) && $_FILES['image']['error'] != 4){
				$data['message'] = $this->upload->display_errors();
			}
            // Run form validation and register user if it's pass the validation
			if ($val->run() && $this->dx_auth->update_user($val->set_value('id'), $val->set_value('username'), $val->set_value('email'), $val->set_value('password'), $image_file_name))
			{

                $data['message'] = 'Úspěšně jste změnili své osobní údaje!';
				// Обновляем данные по пользователю
				$data['user_profile'] = $this->users->get_user_by_id($user_id)->row();

				$name = 'my_account';

                $this->display_lib->auth_page($data, $name);

			}
			else
			{
				$name = 'my_account';

                $this->display_lib->auth_page($data, $name);
			}


        }else{

            $this->login();

        }

	}

    private function do_moo($image)
    {
        $source_file = $image['file_path'].$image['file_name'];
        $avatar = 'assets/uploads/avatars/'.$image['file_name'];

        $this->load->library('image_moo');

		$this->image_moo->load($source_file)
                        ->set_jpeg_quality(60)
                        ->resize_crop(128,128)
                        ->save($avatar,true);

        // if($this->image_moo->errors) print $this->image_moo->display_errors();
        if($this->image_moo->errors){
			return false;
		}
		else{
			return true;
		}

    }

	/* Callback function */

	function username_check($username)
	{
		$result = $this->dx_auth->is_username_available($username);
		if ( ! $result)
		{
			$this->form_validation->set_message('username_check', 'Uživatelské jméno již existuje. Prosím, vyberte jiný uživatelské jméno.');
		}

		return $result;
	}

	function email_check($email)
	{
		$result = $this->dx_auth->is_email_available($email);
		if ( ! $result)
		{
			$this->form_validation->set_message('email_check', 'E-mail je již používán jiným uživatelem. Prosím, vyberte jinou e-mailovou adresu.');
		}

		return $result;
	}

	function captcha_check($code)
	{
		$result = TRUE;

		if ($this->dx_auth->is_captcha_expired())
		{
			// Will replace this error msg with $lang
			$this->form_validation->set_message('captcha_check', 'Váš potvrzovací kód vypršel. Prosím zkuste to znovu.');
			$result = FALSE;
		}
		elseif ( ! $this->dx_auth->is_captcha_match($code))
		{
			$this->form_validation->set_message('captcha_check', 'Váš potvrzovací kód neodpovídá jeden v obraze. Zkus to znovu.');
			$result = FALSE;
		}

		return $result;
	}

	function recaptcha_check()
	{
		$result = $this->dx_auth->is_recaptcha_match();
		if ( ! $result)
		{
			$this->form_validation->set_message('recaptcha_check', 'Váš potvrzovací kód neodpovídá jeden v obraze. Zkus to znovu.');
		}

		return $result;
	}

	/* End of Callback function */


	function login()
	{
		//language for links
        //language for links
        if(LANGUAGE == 'ru'):

            $data['lang'] = '';
            $data['content'] = array(
                'title' => 'Авторизация'
            );

        elseif(LANGUAGE == 'ua'):

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Авторізація'
            );

        else:

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Oprávnění'
            );

        endif;

        if ( ! $this->dx_auth->is_logged_in())
		{

            $val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', 'Jméno', 'trim|required|xss_clean');
			$val->set_rules('password', 'Heslo', 'trim|required|xss_clean');
			$val->set_rules('remember', 'Zapamatovat', 'integer');

			// Set captcha rules if login attempts exceed max attempts in config
			if ($this->dx_auth->is_max_login_attempts_exceeded())
			{
				$val->set_rules('captcha', 'Potvrzovací kód', 'trim|required|xss_clean|callback_captcha_check');
			}

			if ($val->run() AND $this->dx_auth->login($val->set_value('username'), $val->set_value('password'), $val->set_value('remember')))
			{
                if ($this->dx_auth->is_role(array('admin','moderator','author')))
                {
                    redirect('adminpanel');
                }else{
                    // Redirect to homepage
				    redirect('', 'location');
                }

			}
			else
			{
				// Check if the user is failed logged in because user is banned user or not
				if ($this->dx_auth->is_banned())
				{
					// Redirect to banned uri
					$this->dx_auth->deny_access('banned');
				}
				else
				{
					// Default is we don't show captcha until max login attempts eceeded
					$data['show_captcha'] = FALSE;

					// Show captcha if login attempts exceed max attempts in config
					if ($this->dx_auth->is_max_login_attempts_exceeded())
					{
						// Create catpcha
						$this->dx_auth->captcha();

						// Set view data to show captcha on view file
						$data['show_captcha'] = TRUE;
					}

                    $name = 'login_form';

					// Load login page view
					$this->display_lib->auth_page($data, $name);
				}
			}
		}
		else
		{
			$data['auth_message'] = 'Již jste přihlášeni.';
            $name = 'general_message';

            $this->display_lib->auth_page($data, $name);

		}
	}

	function logout()
	{
		//language for links
        if(LANGUAGE == 'ru'):

            $data['lang'] = '';
            $data['content'] = array(
                'title' => 'Информационная страница'
            );

        elseif(LANGUAGE == 'ua'):

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Інформаційна сторінка'
            );

        else:

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Informace o stránky'
            );

        endif;

        $this->dx_auth->logout();

        $data['alert'] = 'Jste přihlášeni ven.';

        $name = 'login_form';

		// Load login page view
		$this->display_lib->user_info_page($data, $name);
	}

	function register()
	{
		//language for links
        if(LANGUAGE == 'ru'):

            $data['lang'] = '';
            $data['content'] = array(
                'title' => 'Регистрация'
            );

        elseif(LANGUAGE == 'ua'):

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Регістрація'
            );

        else:

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Registrace'
            );

        endif;

        if ( ! $this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration)
		{

            $val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', 'Jméno', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
			$val->set_rules('password', 'Heslo', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Opakujte heslo', 'trim|required|xss_clean');
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');

			if ($this->dx_auth->captcha_registration)
			{
				$val->set_rules('captcha', 'Potvrzovací kód', 'trim|xss_clean|required|callback_captcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email')))
			{
				// Set success message accordingly
				if ($this->dx_auth->email_activation)
				{
					$data['auth_message'] = 'Byli jste úspěšně zaregistrován. Zkontrolujte, zda váš e-mail pro aktivaci účtu.';
				}
				else
				{
					$data['auth_message'] = 'Byli jste úspěšně zaregistrován. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
				}

				$name = 'info_form';

				// Load login page view
				$this->display_lib->auth_page($data, $name);

			}
			else
			{
				// Is registration using captcha
				if ($this->dx_auth->captcha_registration)
				{
					$this->dx_auth->captcha();
				}

				$name = 'register_form';

				// Load login page view
				$this->display_lib->auth_page($data, $name);
			}
		}
		elseif ( ! $this->dx_auth->allow_registration)
		{
            $data['auth_message'] = 'Funkce registrace není aktivní.';
            $name = 'general_message';

			// Load login page view
			$this->display_lib->auth_page($data, $name);
		}
		else
		{
		    $data['auth_message'] = 'Pro úspěšnou registraci je nutné nejprve výjezd.';
            $name = 'general_message';

			// Load login page view
			$this->display_lib->auth_page($data, $name);
		}
	}

	function register_recaptcha()
	{
		//language for links
        if(LANGUAGE == 'cz'): $data['lang'] = ''; else: $data['lang'] = LANGUAGE.'/'; endif;

        if ( ! $this->dx_auth->is_logged_in() AND $this->dx_auth->allow_registration)
		{
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('username', 'Jméno', 'trim|required|xss_clean|min_length['.$this->min_username.']|max_length['.$this->max_username.']|callback_username_check|alpha_dash');
			$val->set_rules('password', 'Heslo', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_password]');
			$val->set_rules('confirm_password', 'Opakujte heslo', 'trim|required|xss_clean');
			$val->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_email_check');

			// Is registration using captcha
			if ($this->dx_auth->captcha_registration)
			{
				// Set recaptcha rules.
				// IMPORTANT: Do not change 'recaptcha_response_field' because it's used by reCAPTCHA API,
				// This is because the limitation of reCAPTCHA, not DX Auth library
				$val->set_rules('recaptcha_response_field', 'Potvrzovací kód', 'trim|xss_clean|required|callback_recaptcha_check');
			}

			// Run form validation and register user if it's pass the validation
			if ($val->run() AND $this->dx_auth->register($val->set_value('username'), $val->set_value('password'), $val->set_value('email')))
			{
				// Set success message accordingly
				if ($this->dx_auth->email_activation)
				{
					$data['auth_message'] = 'Byli jste úspěšně zaregistrován. Zkontrolujte, zda váš e-mail pro aktivaci účtu.';
				}
				else
				{
					$data['auth_message'] = 'Byli jste úspěšně zaregistrován. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
				}

				// Load registration success page
				$this->load->view($this->dx_auth->register_success_view, $data);
			}
			else
			{
				// Load registration page
				$this->load->view('auth/register_recaptcha_form');
			}
		}
		elseif ( ! $this->dx_auth->allow_registration)
		{
			$data['auth_message'] = 'Funkce registrace není aktivní.';
			$this->load->view($this->dx_auth->register_disabled_view, $data);
		}
		else
		{
			$data['auth_message'] = 'Pro úspěšnou registraci je nutné nejprve výjezd.';
			$this->load->view($this->dx_auth->logged_in_view, $data);
		}
	}

	function activate()
	{
		// Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Activate user
		if ($this->dx_auth->activate($username, $key))
		{
			$data['auth_message'] = 'Your account have been successfully activated. '.anchor(site_url($this->dx_auth->login_uri), 'Login');
			$this->load->view($this->dx_auth->activate_success_view, $data);
		}
		else
		{
			$data['auth_message'] = 'The activation code you entered was incorrect. Please check your email again.';
			$this->load->view($this->dx_auth->activate_failed_view, $data);
		}
	}

	function forgot_password()
	{
        //language for links
        if(LANGUAGE == 'ru'):

            $data['lang'] = '';
            $data['content'] = array(
                'title' => 'Восстановление пароля'
            );

        elseif(LANGUAGE == 'ua'):

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Відновлення паролю'
            );

        else:

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Resetování hesla'
            );

        endif;

        $val = $this->form_validation;

		// Set form validation rules
		$val->set_rules('login', 'Uživatelské jméno nebo e-mail adresa', 'trim|required|xss_clean');

		// Validate rules and call forgot password function
		if ($val->run() AND $this->dx_auth->forgot_password($val->set_value('login')))
		{
			$data['auth_message'] = 'E-mail byl zaslán na Váš email s instrukcemi s tím, jak aktivovat nové heslo.';
            $name = 'general_message';

			$this->display_lib->auth_page($data, $name);
		}
		else
		{
            $name = 'forgot_password_form';

		    $this->display_lib->auth_page($data, $name);
		}
	}

	function reset_password()
	{
        //language for links
        if(LANGUAGE == 'ru'):

            $data['lang'] = '';
            $data['content'] = array(
                'title' => 'Восстановление пароля'
            );

        elseif(LANGUAGE == 'ua'):

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Відновлення паролю'
            );

        else:

            $data['lang'] = LANGUAGE.'/';
            $data['content'] = array(
                'title' => 'Resetování hesla'
            );

        endif;

        // Get username and key
		$username = $this->uri->segment(3);
		$key = $this->uri->segment(4);

		// Reset password
		if ($this->dx_auth->reset_password($username, $key))
		{
			$data['auth_message'] = 'Úspěšně jste heslo resetovat, '.anchor(site_url($this->dx_auth->login_uri), 'Login');

            $name = 'general_message';

		    $this->display_lib->auth_page($data, $name);
		}
		else
		{
			$data['auth_message'] = 'Reset se nezdařilo. Vaše uživatelské jméno a klíč jsou nesprávné. Zkontrolujte svůj e-mail znovu a postupujte podle pokynů.';

            $name = 'general_message';

		    $this->display_lib->auth_page($data, $name);
		}
	}

	function change_password()
	{
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;

			// Set form validation
			$val->set_rules('old_password', 'Staré heslo', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']');
			$val->set_rules('new_password', 'Nové heslo', 'trim|required|xss_clean|min_length['.$this->min_password.']|max_length['.$this->max_password.']|matches[confirm_new_password]');
			$val->set_rules('confirm_new_password', 'Potvrďte nové heslo', 'trim|required|xss_clean');

			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->change_password($val->set_value('old_password'), $val->set_value('new_password')))
			{
				$data['auth_message'] = 'Vaše heslo bylo úspěšně změněno.';
				$this->load->view($this->dx_auth->change_password_success_view, $data);
			}
			else
			{
				$this->load->view($this->dx_auth->change_password_view);
			}
		}
		else
		{
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	function cancel_account()
	{
		// Check if user logged in or not
		if ($this->dx_auth->is_logged_in())
		{
			$val = $this->form_validation;

			// Set form validation rules
			$val->set_rules('password', 'Heslo', "trim|required|xss_clean");

			// Validate rules and change password
			if ($val->run() AND $this->dx_auth->cancel_account($val->set_value('password')))
			{
				// Redirect to homepage
				redirect('', 'location');
			}
			else
			{
				$this->load->view($this->dx_auth->cancel_account_view);
			}
		}
		else
		{
			// Redirect to login page
			$this->dx_auth->deny_access('login');
		}
	}

	// Example how to get permissions you set permission in /backend/custom_permissions/
	function custom_permissions()
	{
		if ($this->dx_auth->is_logged_in())
		{
			echo 'My role: '.$this->dx_auth->get_role_name().'<br/>';
			echo 'My permission: <br/>';

			if ($this->dx_auth->get_permission_value('edit') != NULL AND $this->dx_auth->get_permission_value('edit'))
			{
				echo 'Edit is allowed';
			}
			else
			{
				echo 'Edit is not allowed';
			}

			echo '<br/>';

			if ($this->dx_auth->get_permission_value('delete') != NULL AND $this->dx_auth->get_permission_value('delete'))
			{
				echo 'Delete is allowed';
			}
			else
			{
				echo 'Delete is not allowed';
			}
		}
	}
}
?>