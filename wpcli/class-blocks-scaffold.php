<?php
/**
 * Add a CLI command for scaffolding a block.
 *
 * @package ABS
 */

namespace WebDevStudios\abs;

// Import wpcli.
use \WP_CLI as WP_CLI;

/**
 * Class Blocks_Scaffold
 *
 * @package WebDevStudios\abs
 */
class Blocks_Scaffold {

	/**
	 * Block Name
	 *
	 * @var string
	 */
	public $name = '';

	/**
	 * Block Title
	 *
	 * @var string
	 */
	public $title = '';

	/**
	 * Block Description
	 *
	 * @var string
	 */
	public $desc = '';

	/**
	 * Block Keywords
	 *
	 * @var string
	 */
	public $keywords = '';

	/**
	 * Block Icon
	 *
	 * @var string
	 */
	public $icon = '';

	/**
	 * Create a new block.
	 *
	 * @since ??
	 * @param string $name The block name.
	 * @param array  $args The block args.
	 */
	public function create_portable_block( $name, $args ) {
		$this->name = esc_html( $name[0] );

		// validate name.
		if ( ! preg_match( '/^[a-zA-Z0-9]+$/', $this->name ) ) {
			WP_CLI::error( 'Invalid name, Block name must only contain alphabets.', true );
		}

		// Merge with default args.
		$args = wp_parse_args(
			$assoc_args,
			[
				'title'    => ucfirst( $this->name ),
				'desc'     => '',
				'keywords' => strtolower( $this->name ),
				'icon'     => 'table-row-before',
			]
		);

		// create the directory.
		$this->create_block_dir();

		// create block json.
		$this->create_block_json();

		// create block renderer.
		$this->create_block_render_php();

		// create editor assets.
		$this->create_block_editor_assets();

		// create FE assets.
		$this->create_block_assets();

		WP_CLI::success( $this->name . ' block created.' );
	}

	/**
	 * Init file system.
	 *
	 * @since ??
	 */
	public function init_filesystem() {
		// File system support.
		global $wp_filesystem;
		require_once ABSPATH . '/wp-admin/includes/file.php';
		WP_Filesystem();

		return $wp_filesystem;
	}

	/**
	 * Create the block directory.
	 *
	 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
	 * @since ??
	 */
	public function create_block_dir() {
		$dir = ABS_ROOT_PATH . 'src/blocks/' . $this->name;

		if ( ! $this->init_filesystem()->exists( $dir ) ) {
			$this->init_filesystem()->mkdir( $dir, 0755 );

			WP_CLI::success( 'Block directory created.' );
		} else {
			WP_CLI::error( 'Block directory already exists.', true );
		}
	}

	/**
	 * Create the block render file.
	 *
	 * @since ??
	 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
	 */
	public function create_block_render_php() {
		$dir = ABS_ROOT_PATH . 'wpcli/block-starter/block.php';

		// copy block render file.
		if ( ! $this->init_filesystem()->copy( $dir, ABS_ROOT_PATH . 'src/blocks/' . $this->name . '/' . $this->name . '.php' ) ) {
			WP_CLI::error( 'ERROR :: Could not create render file.', true );
		}

		WP_CLI::success( 'Block render file created.' );
	}

	/**
	 * Create the block json.
	 *
	 * @since ??
	 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
	 */
	public function create_block_json() {
		$local_file = ABS_ROOT_PATH . 'wpcli/block-starter/block.json';
		$content    = '';

		if ( $this->init_filesystem()->exists( $local_file ) ) {
			$content = $this->init_filesystem()->get_contents( $local_file );
			$content = str_replace(
				[
					'{{name}}',
					'{{title}}',
					'{{description}}',
					'{{icon}}',
				],
				[
					$this->name,
					$this->title,
					$this->desc,
					$this->icon,
				],
				$content
			);
		}

		if ( ! $this->init_filesystem()->put_contents( ABS_ROOT_PATH . 'src/blocks/' . $this->name . '/block.json', $content ) ) {
			WP_CLI::error( 'ERROR :: Could not create a block json file.', true );
		}

		WP_CLI::success( 'Created block json file.' );
	}

	/**
	 * Create the block editor styles.
	 *
	 * @since ??
	 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
	 */
	public function create_block_editor_assets() {
		$assets_js  = ABS_ROOT_PATH . 'wpcli/block-starter/editor.js';
		$assets_css = ABS_ROOT_PATH . 'wpcli/block-starter/editor.scss';

		if ( ! $this->init_filesystem()->exists( $assets_js ) || ! $this->init_filesystem()->exists( $assets_css ) ) {
			WP_CLI::error( 'ERROR :: Could not find editor assets.', true );
		}

		// copy editor js.
		if ( ! $this->init_filesystem()->copy( $assets_js, ABS_ROOT_PATH . 'src/blocks/' . $this->name . '/editor.js' ) ) {
			WP_CLI::error( 'ERROR :: Could not create editor js file.', true );
		}

		// copy editor css.
		if ( ! $this->init_filesystem()->copy( $assets_css, ABS_ROOT_PATH . 'src/blocks/' . $this->name . '/editor.scss' ) ) {
			WP_CLI::error( 'ERROR :: Could not create editor js file.', true );
		}

		WP_CLI::success( 'Editor assets created.' );
	}

	/**
	 * Create the block main styles.
	 *
	 * @since ??
	 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
	 */
	public function create_block_assets() {
		$assets_js  = ABS_ROOT_PATH . 'wpcli/block-starter/script.js';
		$assets_css = ABS_ROOT_PATH . 'wpcli/block-starter/style.scss';

		if ( ! $this->init_filesystem()->exists( $assets_js ) || ! $this->init_filesystem()->exists( $assets_css ) ) {
			WP_CLI::error( 'ERROR :: Could not find block assets.', true );
		}

		// copy editor js.
		if ( ! $this->init_filesystem()->copy( $assets_js, ABS_ROOT_PATH . 'src/blocks/' . $this->name . '/script.js' ) ) {
			WP_CLI::error( 'ERROR :: Could not create editor js file.', true );
		}

		// copy editor css.
		if ( ! $this->init_filesystem()->copy( $assets_css, ABS_ROOT_PATH . 'src/blocks/' . $this->name . '/style.scss' ) ) {
			WP_CLI::error( 'ERROR :: Could not create editor js file.', true );
		}

		WP_CLI::success( 'Block assets created.' );

	}

}

/**
 * Registers our command when cli get's initialized.
 *
 * @since  ??
 * @author Biplav Subedi <biplav.subedi@webdevstudios.com>
 * @return void
 */
function abs_cli_register_commands() {
	WP_CLI::add_command( 'abs', __NAMESPACE__ . '\Blocks_Scaffold' );
}
add_action( 'cli_init', __NAMESPACE__ . '\abs_cli_register_commands' );
