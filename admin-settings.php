<?php
class PHProtSettingsPage {
	/**
	 * Holds the values to be used in the fields callbacks
	 */
	private $options;

	/**
	 * Start up
	 */
	public function __construct() {
		add_action ( 'admin_menu', array (
				$this,
				'add_plugin_page'
		) );
		add_action ( 'admin_init', array (
				$this,
				'page_init'
		) );
	}

	/**
	 * Add options page
	 */
	public function add_plugin_page() {
		// This page will be under "Settings"
		add_options_page ( 'Proxy Hacking Protection (WordPress Plugin)', 'Proxy Hacking Protection', 'manage_options', PHPROT_MENU_SLUG, array (
				$this,
				'create_admin_page'
		) );
	}

	/**
	 * Options page callback
	 */
	public function create_admin_page() {
		// Set class property
		$this->options = get_option ( 'ph_prot_options' );
		?>
<div class="wrap">
<?php screen_icon(); ?>
<h2>Proxy Hacking Protection (WordPress Plugin)</h2>
	<form method="post" action="options.php">
	<?php
		// This prints out all hidden setting fields
		settings_fields ( 'ph_prpt_option_group' );
		do_settings_sections ( PHPROT_MENU_SLUG );
		submit_button ();
		?>
	</form>
</div>
<?php
	}

	/**
	 * Register and add settings
	 */
	public function page_init() {
		/* example */
		// register_setting(
		// 'ph_prpt_option_group', // Option group
		// 'ph_prot_options', // Option name
		// array( $this, 'sanitize' ) // Sanitize
		// );
		register_setting ( 'ph_prpt_option_group', 'ph_prot_options', array (
				$this,
				'sanitize'
		) );

		/* example */
		// add_settings_section(
		// 'setting_section_id', // ID
		// 'オプション設定', // Title
		// array( $this, 'print_section_info' ), // Callback
		// PHPROT_MENU_SLUG // Page
		// );
		add_settings_section ( 'setting_section_id', 'オプション設定', array (
				$this,
				'print_section_info'
		), PHPROT_MENU_SLUG );

		/* example */
		// add_settings_field(
		// 'id_number', // ID
		// 'ID', // Title
		// array( $this, 'id_number_callback' ), // Callback
		// PHPROT_MENU_SLUG, // Page
		// 'setting_section_id' // Section
		// );

// 		add_settings_field ( 'id_number', 'ID', array (
// 				$this,
// 				'id_number_callback'
// 		), PHPROT_MENU_SLUG, 'setting_section_id' );

		add_settings_field ( 'custom_notice_css', 'カスタムCSS(未実装)', array (
				$this,
				'custom_notice_css_callback'
		), PHPROT_MENU_SLUG, 'setting_section_id' );

		add_settings_field ( 'donate', '支援', array (
				$this,
				'donate_box_callback'
		), PHPROT_MENU_SLUG, 'setting_section_id' );
	}

	/**
	 * Sanitize each setting field as needed
	 *
	 * @param array $input
	 *        	Contains all settings fields as array keys
	 */
	public function sanitize( $input ) {
		$new_input = array ();
// 		if ( isset ( $input ['id_number'] ) )
// 			$new_input ['id_number'] = absint ( $input ['id_number'] );

		if ( isset ( $input ['custom_notice_css'] ) )
			$new_input ['custom_notice_css'] = sanitize_text_field ( $input ['custom_notice_css'] );

		if ( isset ( $input ['donate_box'] ) && $input ['donate_box'] === 'yes' ) {
			$new_input ['donate_box'] = true;
		} else {
			$new_input ['donate_box'] = false;
		}

		return $new_input;
	}

	/**
	 * Print the Section text
	 */
	public function print_section_info() {
		print '入力してください:';
	}

	/**
	 * Get the settings option array and print one of its values
	 */
// 	public function id_number_callback() {
// 		printf ( '<input type="text" id="id_number" name="ph_prot_options[id_number]" value="%s" />', isset ( $this->options ['id_number'] ) ? esc_attr ( $this->options ['id_number'] ) : '-1' );
// 	}

	/**
	 * Get the settings option array and print one of its values
	 */
	public function custom_notice_css_callback() {
		printf ( '<input type="text" id="custom_notice_css" name="ph_prot_options[custom_notice_css]" value="%s" />', isset ( $this->options ['custom_notice_css'] ) ? esc_attr ( $this->options ['custom_notice_css'] ) : '' );
	}
	public function donate_box_callback() {
		?>
<select id="donate_box" name="ph_prot_options[donate_box]">
	<option value="">まだ</option>
		<?php
		printf ( '<option value="yes" %s >OK</option>', isset ( $this->options ['donate_box'] ) && $this->options ['donate_box'] === true ? 'selected' : '' );
		?>
		</select>
		<?php
		printf ( '<div>%s</div>', isset ( $this->options ['donate_box'] ) && $this->options ['donate_box'] === true ? 'ありがとう' : '' );
	}
}

if ( is_admin () )
	$phprot_settings_page = new PHProtSettingsPage ();