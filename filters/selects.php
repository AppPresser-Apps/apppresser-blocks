<?php

function apppresser_enqueue_icons() {

	$icons = appp_dynamic_icons();

		// Enqueue your script file
		wp_enqueue_script( 'apppresser_blocks', APPPRESSER_BLOCKS_URL . '/filters/script.js', array( 'jquery' ), '1.0.0', true );

		// Localize the script with new data
		$script_data = array(
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'my_nonce' ),
			'icons'    => $icons,
		);
		wp_localize_script( 'apppresser_blocks', 'appp_icons', $script_data );
}
add_action( 'init', 'apppresser_enqueue_icons' );
