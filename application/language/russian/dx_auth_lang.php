<?php

/*
	It is recommended for you to change 'auth_login_incorrect_password' and 'auth_login_username_not_exist' into something vague.
	For example: Username and password do not match.
*/

$lang['auth_login_incorrect_password'] = "Неверно введен пароль.";
$lang['auth_login_username_not_exist'] = "Пользователя с таким именем не существует.";

$lang['auth_username_or_email_not_exist'] = "Такого пользователя либо Email адресса не существует.";
$lang['auth_not_activated'] = "Ваш аккаунт еще не был активирован. Пожалуйста, проверьте свой почтовый ящик.";
$lang['auth_request_sent'] = "Ваш запрос на смену пароля принят. Пожалуйста, проверьте свой почтовый ящик.";
$lang['auth_incorrect_old_password'] = "Неверно введен старый пароль.";
$lang['auth_incorrect_password'] = "Неверно введен пароль.";

// Email subject
$lang['auth_account_subject'] = "%s детали аккаунта";
$lang['auth_activate_subject'] = "%s активация";
$lang['auth_forgot_password_subject'] = "Запрос нового пароля";

// Email content
$lang['auth_account_content'] = "Добро пожаловать на %s,

Спасибо за регистрацию. Ваш аккаунт был успешно создан.

Вы можете авторизироватся со следующими логином и паролем:

Логин: %s
Email: %s
Пароль: %s

You can try logging in now by going to %s

We hope that you enjoy your stay with us.

Regards,
The %s Team";

$lang['auth_activate_content'] = "Welcome to %s,

To activate your account, you must follow the activation link below:
%s

Please activate your account within %s hours, otherwise your registration will become invalid and you will have to register again.

You can use either you username or email address to login.
Your login details are as follows:

Login: %s
Email: %s
Password: %s

We hope that you enjoy your stay with us :)

Regards,
The %s Team";

$lang['auth_forgot_password_content'] = "%s,

You have requested your password to be changed, because you forgot the password.
Please follow this link in order to complete change password process:
%s

Your New Password: %s
Key for Activation: %s

After you successfully complete the process, you can change this new password into password that you want.

If you have any more problems with gaining access to your account please contact %s.

Regards,
The %s Team";

/* End of file dx_auth_lang.php */
/* Location: ./application/language/english/dx_auth_lang.php */