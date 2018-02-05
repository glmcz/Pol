<?php

/*
	It is recommended for you to change 'auth_login_incorrect_password' and 'auth_login_username_not_exist' into something vague.
	For example: Username and password do not match.
*/

$lang['auth_login_incorrect_password'] = "Nesprávně uvedené heslo.";
$lang['auth_login_username_not_exist'] = "Uživatel s tohoto jména neexistuje.";

$lang['auth_username_or_email_not_exist'] = "Takový uživatel nebo e-mailová adresa neexistuje.";
$lang['auth_not_activated'] = "Váš účet ještě nebyl aktivován. Prosím, zkontrolujte svoji poštu.";
$lang['auth_request_sent'] = "Vaše žádost na změnu hesla byla přijata. Prosím, zkontrolujte svoji poštu.";
$lang['auth_incorrect_old_password'] = "Nesprávně zadané staré heslo.";
$lang['auth_incorrect_password'] = "Nesprávně uvedené heslo.";

// Email subject
$lang['auth_account_subject'] = "%s podrobnosti účtu";
$lang['auth_activate_subject'] = "%s aktivace";
$lang['auth_forgot_password_subject'] = "Žádost o nové heslo";

// Email content
$lang['auth_account_content'] = "Vítáme Vás na %s,

Děkujeme za registraci. Váš účet byl úspěšně vytvořen. 

Můžete se přihlásit pomocí následujícího uživatelského jména a hesla:

Jméno: %s
E-mail: %s
Heslo: %s

Můžete zkusit protokolování potřeba se tím, že půjdete do %s

Věříme, že Vám Váš pobyt u nás.

Pozdravy,
Polahoda %s";

$lang['auth_activate_content'] = "Vítáme Vás na %s,

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