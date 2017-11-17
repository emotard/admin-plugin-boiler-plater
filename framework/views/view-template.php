<?php

$route = new Route();
$input = new Input();

$current_tab = $_GET['current_tab'];

if ( $current_tab && $current_tab != 'general-settings' ) {
	$header_title = ucfirst( str_replace( '-', ' ', $current_tab ) );
} else {
	$header_title = PLUGIN_NAME . ' Settings';
}

$page_options = get_option( PLUGIN_SLUG . '-' . $current_tab );

require_once RL_PLUGIN_PATH . 'views/template-parts/header.php';

?>

<section id="main-content">
    <form id="<?php echo( $current_tab ? $current_tab : 'general-settings' ); ?>" action=" ">
		<?php
		if ( $current_tab ) {
			require_once RL_PLUGIN_PATH . 'views/' . $current_tab . '.php';
		} else {
			require_once RL_PLUGIN_PATH . 'views/general-settings.php';
		}
		?>

    </form>

</section> <!-- end main content section -->

<?php

require_once RL_PLUGIN_PATH . 'views/template-parts/footer.php';


