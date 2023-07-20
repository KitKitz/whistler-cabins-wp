<?php
function whi_login_logo(){
	?>
	<style type ="text/css">
		#login h1 a, .login h1 a {
        background-image: url(<?php echo get_template_directory_uri(); ?>/assets/alpenglow-cabins-login-logo.png);
		height:140px;
		width:320px;
		background-size: 140px 140px;
		background-repeat: no-repeat;
        padding-bottom: 30px;
		}
	</style>
	<?php
}
add_action('login_enqueue_scripts', 'whi_login_logo'); 

//Add link to homepage for Logo
function whi_login_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'whi_login_logo_url' );

//Add title for homepage link logo
function whi_login_logo_url_title() {
    return 'Alpenglow Cabins | Home';
}
add_filter( 'login_headertext', 'whi_login_logo_url_title' );

function whi_login_stylesheet() {
    wp_enqueue_style( 'custom-login', get_template_directory_uri() . '/css/style-login.css' );
}
add_action( 'login_enqueue_scripts', 'whi_login_stylesheet' );