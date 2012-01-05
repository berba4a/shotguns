<?php
	require_once HTDOCS . '/configs/config.php';
	class Mail {
		static function sendMail($to, $subject, $message, $from = EMAIL_SENDER) {
			$headers =
				'From: ' . $from . "\r\n" .
				'Reply-To: ' . $from . "\r\n" .
				'MIME-Version: 1.0'."\r\n". 
				'Content-type: text/plain; charset=UTF-8'."\r\n".
				'X-Mailer: PHP/' . phpversion();
			ini_set("SMTP", EMAIL_SERVER);
			mail($to, $subject, $message, $headers);
		}
	}