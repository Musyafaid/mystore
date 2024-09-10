<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$config['protocol'] = 'smtp'; // Change to 'mail' for PHP mail() function or 'sendmail' if using sendmail
$config['smtp_host'] = 'smtp.yourdomain.com'; // Your SMTP server address
$config['smtp_port'] = 587; // Your SMTP port (usually 587 for TLS, 465 for SSL)
$config['smtp_user'] = 'muss'; // Your SMTP username (email address)
$config['smtp_pass'] = 'your-email-password'; // Your SMTP password
$config['mailtype'] = 'html'; // Email format (text or html)
$config['charset'] = 'iso-8859-1'; // Character set
$config['wordwrap'] = TRUE; // Whether to wrap email text
