<?php
/*
Plugin Name: WPStatus - Base
Plugin URI: http://www.wpstatus.com.au/
Description: Base Class for WPStatus Plugins
Version: 1.0
Author: WPStatus
Author URI: http://www.wpstatus.com.au/
*/

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) exit;

if ( !class_exists('WPStatus_Base') ):

    /**
     * Class WPStatus_Base
     * Base class for Future Transport WPStatus Plugins
     */
    class WPStatus_Base
    {

        public function get_current_plugin_name() {
            $reflector = new ReflectionClass(get_class($this));
            $plugin_data = get_plugin_data($reflector->getFileName());
            return $plugin_data['TextDomain'];
        }

        /**
         * Empty setup function to be overriden
         */
        public function setup() { }

        /**
         * Empty constructor
         */
        public function __construct() { }

        /**
         * Prevent class from being cloned
         */
        public function __clone() { wp_die( "Can't call " . __FUNCTION__ . ' on ' . get_called_class()); }

        /**
         * Prevent class from being serialized
         */
        public function __wakeup() { wp_die( "Can't call " . __FUNCTION__ . ' on ' . get_called_class()); }

        /**
         * Return static singleton instance of class
         * @return static
         */
        public static function instance() {

            static $instance = null;

            if ( null === $instance ) {
                $instance = new static();
                $instance->setup();
            }

            return $instance;

        }

        //
        //  CUSTOM POST TYPES
        //

        /**
         * Simple custom post type registration, override options using options array
         *
         * @param string $key Post type
         * @param $singular $singular Singular label
         * @param $plural $plural Pluralized Label
         * @param null|array $options Override any of the default arguments passed to register_post_type
         */
        protected function register_post_type($key, $singular, $plural, $options = null)
        {

            $labels = array(
                'name'                  => _x($plural, $key),
                'singular_name'         => _x($singular, $key),
                'add_new'               => _x('Add New', $key),
                'add_new_item'          => _x('Add New ' . $singular . '', $key),
                'edit_item'             => _x('Edit ' . $singular . '', $key),
                'new_item'              => _x('New ' . $singular . '', $key),
                'view_item'             => _x('View ' . $singular . '', $key),
                'search_items'          => _x('Search ' . $plural . '', $key),
                'not_found'             => _x('No ' . $plural . ' found', $key),
                'not_found_in_trash'    => _x('No ' . $plural . ' found in Trash', $key),
                'parent_item_colon'     => _x('Parent ' . $singular . ':', $key),
                'menu_name'             => _x($plural, $key),
            );

            $args = array(
                'labels' => $labels,
                'hierarchical' => false,
                'supports' => array('title'),
                'public' => true,
                'show_ui' => true,
                'show_in_menu' => apply_filters('wpstatus/modules/settings/admin_menu', 'wpstatus-modules'),
                'show_in_nav_menus' => true,
                'publicly_queryable' => true,
                'exclude_from_search' => true,
                'has_archive' => false,
                'query_var' => true,
                'can_export' => true,
                'rewrite' => true,
                'capability_type' => 'page',
                'menu_icon' => 'dashicons-book'
            );

            if ($options !== null)
                $args = array_replace_recursive($args, $options);

            register_post_type($key, $args);

        }

        /**
         * Simple taxonomy registration, override options using options array
         *
         * @param string $key Taxonomy type
         * @param string|array $post_type Post types this taxonomy applies to
         * @param string $singular Singular label
         * @param string $plural Pluralized Label
         * @param null|array $options Override any of the default arguments passed to register_post_type
         */
        protected function register_taxonomy($key, $post_type, $singular, $plural, $options = null)
        {

            $labels = array(
                'name'                       => $singular,
                'singular_name'              => $singular,
                'menu_name'                  => $plural,
                'all_items'                  => 'All ' . $plural,
                'parent_item'                => 'Parent ' . $singular,
                'parent_item_colon'          => 'Parent ' . $singular . ':',
                'new_item_name'              => 'New ' . $singular . ' Name',
                'add_new_item'               => 'Add New ' . $singular,
                'edit_item'                  => 'Edit ' . $singular,
                'update_item'                => 'Update ' . $singular,
                'popular_items'              => NULL,
                'separate_items_with_commas' => 'Separate ' . strtolower($plural) . ' with commas',
                'search_items'               => 'Search ' . $plural,
                'add_or_remove_items'        => 'Add or remove ' . strtolower($plural),
                'choose_from_most_used'      => 'Choose from the most used ' . strtolower($plural),
                'not_found'                  => 'No ' . $plural . ' Found',
            );

            $args = array(
                'labels' => $labels,
                'public' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'show_tagcloud' => true,
                'show_in_quick_edit' => true,
                'show_admin_column' => true,
               // 'meta_box_cb' => false,
                'hierarchical' => true,
                'query_var' => $key,
                'label' => $singular,
            );

            if ($options !== null)
                $args = array_replace_recursive($args, $options);

            register_taxonomy($key, $post_type, $args);

        }

        //
        //  DATA ACCESS
        //

        /**
         * Shortcut for querying post types:
         *
         * Example:
         * <code>
         *
         *  // all published pages by post date
         *  $this->page_by_post_status_and_orderby('publish', 'post_date');
         *
         *  // prefix meta key name with meta_ to get custom_post_type where meta_key of price is 100
         *  $this->custom_post_type_by_meta_price('100');
         *
         *  // append first_ to function name to get first result by page title
         *  $this->first_page_by_post_title('My Title');
         *
         *  // prefix debug_ to get information on what was processed and passed to query based on your function name
         *  $this->debug_first_page_by_post_title('My Title');
         *
         * @param $name
         * @param $args
         * @return array|mixed|null|void Returns either null or array of WP_Post (OBJECT_K) objects
         */
        function __call($name, $args) {

            if (preg_match("/(?P<debug>debug_)?(?P<first>first_)?(?P<post_type>[A-Za-z_]+)_by_(?P<query>[A-Za-z_]+)/", $name, $matches))
            {

                //  handle special case for getting single page by post title
                if (!empty($matches['first']) && $matches['query'] == 'post_title') {
                    $post = get_page_by_title($args[0], OBJECT_K, $matches['post_type']);
                    return $this->process_post($post);
                }

                //  add post type to main query
                $query_args = array('post_type' => $matches['post_type']);
                $query_keys = explode("_and_", $matches['query']);
                for( $i = 0; $i < count($query_keys); $i++ ) {

                    //  is this a meta query?
                    if ('meta_' == substr($query_keys[$i], 0, 5) && $query_keys[$i] != 'meta_query' && $query_keys[$i] != 'meta_key') {

                        if (!isset($query_args['meta_query']))
                            $query_args['meta_query'] = array();

                        $query_args['meta_query'][] = array(
                            'key' => substr($query_keys[$i], 5),
                            'value' => $args[$i]
                        );

                    }
                    else
                        $query_args[$query_keys[$i]] = $args[$i];

                }

                //  display debug information if last parameter is debug
                if (!empty($matches['debug'])) {
                    echo '<br /><b>' . $name . '()</b><br />';
                    echo '<pre>';
                    echo '<br />$args = ';
                    var_export($args);
                    echo ';<br />';
                    echo '<br />$matches = ';
                    var_export($matches);
                    echo ';<br />';
                    echo '</pre><br /><hr />';
                }

                //  perform query and return result
                $result = $this->query($query_args, OBJECT_K, !empty($matches['debug']));
                if (!empty($matches['first']))
                    return (count($result) > 0) ? $result[0] : null;
                return $result;

            } else {
                throw new BadMethodCallException();
            }

        }

        /**
         * Shortcut for retrieving data
         *
         * @param array $atts
         * @param string $return_type Returns either WP_Post objects (OBJECT_K) or associative array (ARRAY_A)
         * @param bool $debug Displays final args that where passed into WP_Query
         * @return array
         */
        function query($atts, $return_type = OBJECT_K, $debug = false)
        {
            global $wpdb;

            $args = array_replace_recursive(
                array(
                    'posts_per_page' => -1,
                    'post_type' => 'any',
                    'order' => 'ASC',
                    'orderby' => 'title',
                    'paged' => 1
                ),
                $atts
            );

            $the_query = new WP_Query($args);
            $results = array();
            if ($the_query->have_posts()) {
                $last_query = $wpdb->last_query;
                while ($the_query->have_posts()) {
                    $the_query->the_post();
                    $post = get_post(null, $return_type);
                    $results[] = $this->process_post($post);
                }
            }
            wp_reset_postdata();

            //p($args);
            if ($debug) {
                echo '<br />$query_args = ';
                echo '<pre>';
                var_export($args);
                echo '</pre>';
                echo $last_query;
            }

            return $results;

        }


        /**
         * Performs any additional processing for posts for use with query posts
         * Can be filtered by wpstatus_process_my_post_type
         *
         * @param WP_Post|array $post WP_Post object or associated array
         * @param string $return_type OBJECT_K or ARRAY_A
         * @return mixed|void Processed object
         */
        private function process_post($post, $return_type = OBJECT_K) {

            if ($post == null) return $post;

            if ($return_type == OBJECT_K)
            {

                //  loads custom post fields if available
                if (function_exists('get_fields'))
                    $post->fields = (object)get_fields($post->ID);

                //  runs any filters
                $post = apply_filters('wpstatus_process_' . $post->post_type, $post, $return_type);
            }
            else
            {

                //  loads custom post fields if available
                if (function_exists('get_fields'))
                    $post['fields'] = get_fields($post['ID']);

                //  runs any filters
                $post = apply_filters('wpstatus_process_' . $post['post_type'], $post, $return_type);

            }

            return $post;

        }

        //
        //  ADVANCED CUSTOM FIELDS HELPERS
        //

        /**
         * Saves an associated array of key / value pairs for a specific post
         *
         * @param string $group Either the group key or the field group name as specified
         * @param int $post_id Post id that should be saved
         * @param array $values Associative array of key / value field
         */
        function acf_save_fields($group, $post_id, $values) {

            //  bonus points if I could just pass in a field group name here
            if (is_string($group) && 'group_' != substr($group, 0, 6))
                $group = $this->acf_get_group_key($group);

            $fields = acf_get_fields($group);

            foreach( $values as $key => $value ) {

                $field = wp_list_filter( $fields, array('name' => $key ) );

                if (count($field) > 0) {
                    $field = reset($field);
                    update_field($field['key'], $value, $post_id);
                }

            }

            //  run additional hooks when fields have changed
            do_action('wpstatus_save_fields_' . $group, $post_id, $values, $fields);

        }

        /**
         * Retreives a key for a field group by name
         *
         * @param string $name Name of field group as specified in admin area
         * @return string|null Field group key or null
         */
        function acf_get_group_key($name)
        {

            $groups = acf_get_field_groups();

            foreach( $groups as $group ) {
                if ($group['title'] == $name) {
                    return $group['key'];
                }
            }

            wp_die("Can't find group name: " . $name);

            return null;

        }

        //
        //  HELPER FUNCTIONS
        //

        /**
         * Loads several files in one go
         *
         * @param $includes
         * @param $path
         */
        public function load($includes, $path){
            foreach( $includes as $include )
                include($path . "includes/$include.php");
        }

        /**
         * Loads template content and returns it
         *
         * @param $path
         * @param mixed $data
         * @return string $content
         */
        public function template($path, $data = array()){
            ob_start();
            include($path);
            return ob_get_clean();
        }

    }

endif;