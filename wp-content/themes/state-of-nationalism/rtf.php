<?php
	require_once '/wp-content/themes/state-of-nationalism/convert/PHPRtfLite/lib/PHPRtfLite.php';
	$rtf = new PHPRtfLite();
	$sect = $rtf->addSection();
	$sect->writeText('Hello world!',
		new PHPRtfLite_Font(),
		new PHPRtfLite_ParFormat());
	$rtf->save('hello_world.rtf');