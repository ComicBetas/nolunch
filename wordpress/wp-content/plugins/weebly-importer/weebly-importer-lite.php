<?php
/*
 * Weebly Importer Lite plugin for importing posts from a Weebly blog.
 *
 * @package Weebly_Importer
 * @author  Gregor Zorc <gregor.zorc@hotmail.com>
 * @copyright 2014 Gregor Zorc
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: Weebly Importer Lite
 * Description: Import your Weebly blog to Wordpress
 * Author: Gregor Zorc
 * Version: 1.0
 * Text Domain: weebly-importer-lite-locale
*/

define('STATUS_DONE', 'DONE_CRAWLING');
define('STATUS_CRAWLING', 'CRAWLING');


set_time_limit(0);

// Load Importer API
require_once ABSPATH . 'wp-admin/includes/import.php';

if ( !class_exists( 'WP_Importer' ) ) {
	$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
	if ( file_exists( $class_wp_importer ) )
		require_once $class_wp_importer;
}

if(!class_exists('weebly_crawler_lite')) {
    require_once('class-weebly_crawler_lite.php');
}

/**
 * Weebly Importer Lite
 *
 * @package WordPress
 * @subpackage Importer
 */
if (class_exists( 'WP_Importer' )) {
class Weebly_Importer extends WP_Importer {

    private $post_crawler;

    const WEEBLY_IMPORT_PROGRESS_POST = 'weebly_import_progress_post';

    public function __construct() {
    }

	function render_html() {
        $strings = array(
            'header' => __('Import Weebly', 'weebly-importer-lite'),
            'instructions_a' => __('
                Heya! This importer allows you to import posts from your Weebly blog into your WordPress site.',
                'weebly-importer-lite'
            ),
            'instructions_b' => __('
                <strong>Before you proceed, make sure to enable &#8220;Archives" section on your Weebly blog.</strong>
                If it&#8217;s not there already, look under &#8220;Blog sidebar&#8221; in Weebly&#8217;s site builder
                and drag&#8217;n&#8217;drop &#8220;Blog archives&#8221; component on your blog.',
                'weebly-importer-lite'
            ),
            'instructions_c' => __('
                When you are ready, you should provide a URL pointing directly to your Weebly blog. So if your
                site is at www.example.com and your blog lives at www.example.com/myblog.html, you should input
                the second address.',
                'weebly-importer-lite'
            ),
            'instructions_d' => __('
                NOTE: this importer does not import your images from Weebly. You\'ll have to do this manually by
                using  <a href="http://wordpress.org/plugins/import-external-images" target="_blank">this</a> free plugin.',
                'weebly-importer-lite'
            ),
            'url' => __('URL of your Weebly blog', 'weebly-importer-lite'),
            'import_posts' => __('Import', 'weebly-importer-lite'),
            'advanced' => __('Advanced', 'weebly-importer-lite'),
            'posts' => __('Posts processed', 'weebly-importer-lite'),
            'status' => __('Status', 'weebly-importer-lite'),
            'progress_posts' => __('Posts progress report', 'weebly-importer-lite'),
        );

        extract($strings);
        $html = <<<HTML
            <div class="wrap">
                <h2>{$header}</h2>
                <p>{$instructions_a}</p>
                <p>{$instructions_b}</p>
                <p>{$instructions_c}</p>
                <p>{$instructions_d}</p>

                <form method="post" id="import_form" enctype="multipart/form-data">
                <div class="form-wrap">
                    <div>
                        <label for="url">{$url}</label>
                        <input name="url" id="weebly2wp-url" type="text" value="" size="40" aria-required="true">
                    </div>

                    <p class="submit">
                        <input type="submit" name="importposts" id="import" class="button button-primary"
                        value="{$import_posts}">
                    </p>

                    <h3>Progress report: <span id="progress"></span></h3>
                </div>
                </form>

            </div>
HTML;
		echo $html;
	}

    public function import() {
        update_option(self::WEEBLY_IMPORT_PROGRESS_POST, array('status' => 'Waiting for crawler ...'));

        if (!isset($this->post_crawler) && isset($_POST['url'])) {
            $crawl_id = uniqid();

            $options = $_POST['options'] ?: array();
            update_option(self::WEEBLY_IMPORT_PROGRESS_POST, array('status' => 'Preparing posts crawler ...'));
            $this->post_crawler = new post_crawler(
                $_POST['url'],
                in_array('style', $options),
                in_array('class', $options)
            );

            update_option(self::WEEBLY_IMPORT_PROGRESS_POST, array('status' => 'Ready to import posts ...'));
            $post_with_comments_stack = array();
            $posts_imported = false;
            while ($post = $this->post_crawler->next()) {

                $wp_post_id = wp_insert_post(
                    array(
                        'comment_status' => 'open',
                        'ping_status' => 'open',
                        'post_title' =>	$post['title'],
                        'post_content' => $post['content'],
                        'post_date' => $post['date']->format('Y-m-d H:i:s'),
                        'post_status' => 'publish',
                        'post_type' =>	'post',
                        'comment_count' => in_array('comments', $options) ? $post['comment_count'] : 0
                    )
                );

                if (in_array('comments', $options) && $post['comment_count'] > 0) {
                    $post_with_comments_stack[] = $wp_post_id;
                }

                add_post_meta($wp_post_id, 'weebly-post-id', $post['id'], true);
                add_post_meta($wp_post_id, 'weebly-crawl-id', $crawl_id, true);
                add_post_meta($wp_post_id, 'weebly-post-url', $post['link'], true);

                update_option(self::WEEBLY_IMPORT_PROGRESS_POST, $this->post_crawler->stats());
                $posts_imported = true;
            }


            if (!$posts_imported) {
                $stats = array(
                    'method' => 'sitemap',
                    'status' => STATUS_DONE,
                    'processed_posts' => 0,
                    'total_posts' => 0
                );
                update_option(self::WEEBLY_IMPORT_PROGRESS_POST, $stats);
            }

            $stats = array(
                'post' => get_option(self::WEEBLY_IMPORT_PROGRESS_POST),
            );

            header("Content-type: application/json");
            echo json_encode($stats);
        }

        delete_option(self::WEEBLY_IMPORT_PROGRESS_POST);

        die();
    }

    /**
     * This gets called by the JS poll function.
     */
    public function import_status() {
        header("Content-type: application/json");
        $data = array(
            'post' => get_option(self::WEEBLY_IMPORT_PROGRESS_POST, array('status' => 'Waiting for crawler ...')),

        );
        echo json_encode($data);
        die();
    }
}

$weebly_importer = new Weebly_Importer();

register_importer('weebly', __('Weebly', 'weebly-importer-lite'), __('Import posts from a Weebly blog.', 'weebly-importer-lite'),
    array ($weebly_importer, 'render_html'));

add_action('wp_ajax_import', array($weebly_importer, 'import'));
add_action('wp_ajax_import_status', array($weebly_importer, 'import_status'));

function pw_load_scripts() {
    wp_enqueue_script( 'weebly-importer-lite-js', plugins_url( 'weebly-importer-lite.js' , __FILE__ ), array( 'jquery' ) );
}
add_action('admin_enqueue_scripts', 'pw_load_scripts');

}