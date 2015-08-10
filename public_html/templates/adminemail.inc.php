<?php

$emailHeaders = [
	'from' =>		'sosediNZ <mailgun@sandbox17dfe9019f0147ff87ec685ab690c2b2.mailgun.org>',
	'to' =>			'<lena.plaksina@gmail.com>',
	'subject' =>	$email . ' needs support on sosediNZ'
]

?>

Hi there,

The user "<?= $email ?>" sent you a message.
Subject: "<?= $title ?>"
Content: "<?= $message ?>"

Thanks,

Your Neighbours
sosediNZ