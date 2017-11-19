<?php

$route = new Route();
$input = new Input();

$current_tab = $_GET['current_tab'];

if ( $current_tab && $current_tab != 'general-settings' ) {
	$header_title = ucfirst( str_replace( '-', ' ', $current_tab ) );
} else {
	$header_title = PLUGIN_NAME . ' Settings';
	$current_tab = 'general-settings';
}

$page_options = get_option( PLUGIN_SLUG . '-' . $current_tab );


?>


<div class="bd-klmn-gaps"></div>
<div id="plugin-wrapper" class="container">

	<div class="columns is-variable bd-klmn-columns is-3">
		<div id="plugin-nav" class="column is-3">
			<div class="plugin-nav-header">
				<span class="dashicons dashicons-dashboard"></span>
				<div class="subtitle">Navigation</div>
			</div>
			<ul class="menu-list">
				<?php require_once RL_PLUGIN_PATH . 'views/template-parts/navigation.php'; ?>
			</ul>
		</div>

		<div id="plugin-content" class="column is-9">
			<div class="subtitle"><?php echo $header_title; ?></div>
			<section class="plugin-content-section">
				<form id="<?php echo( $current_tab ? $current_tab : 'general-settings' ); ?>" action=" ">
					<?php
					if ( $current_tab ) {
						require_once RL_PLUGIN_PATH . 'views/' . $current_tab . '.php';
					}
					?>
				</form>
			</section>
			<section id="footer">
				<div class="control">
					<button type="submit" id="submit-page" class="button is-primary">Save Changes</button>
					<div id="saving_settings"><h3>Now Saving Your Settings</h3></div>
				</div>
			</section>
		</div>

	</div>
</div>