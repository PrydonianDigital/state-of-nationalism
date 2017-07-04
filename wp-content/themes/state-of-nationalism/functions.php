<?php

	// Init CMB2
	if ( file_exists( dirname( __FILE__ ) . '/cmb2/init.php' ) ) {
		require_once dirname( __FILE__ ) . '/cmb2/init.php';
	} elseif ( file_exists( dirname( __FILE__ ) . '/CMB2/init.php' ) ) {
		require_once dirname( __FILE__ ) . '/CMB2/init.php';
	}

	require_once('functions/theme.php');
	require_once('functions/widgets.php');
	require_once('functions/post_types.php');
	require_once('functions/meta.php');