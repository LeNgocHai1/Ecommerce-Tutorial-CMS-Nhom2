<?php

namespace ShopEngine\Core\Builders;

use ShopEngine\Core\PageTemplates\Page_Templates;
use ShopEngine\Core\Template_Cpt;
use ShopEngine\Traits\Singleton;
use ShopEngine\Utils\Helper;

defined('ABSPATH') || exit;

class Hooks {

	use Singleton;

	public $action;
	public $actionPost_type = ['product']; // only for woocommerce product
	public $languages = [];
	public $activated_templates = [];

	public function init() {

		$this->action = new Action();
		$cptName      = Template_Cpt::TYPE;

		// check admin init
		add_action('admin_init', [$this, 'add_author_support'], 10);
		add_filter('manage_' . $cptName . '_posts_columns', [$this, 'set_columns']);
		add_action('manage_' . $cptName . '_posts_custom_column', [$this, 'render_column'], 10, 2);

		// add filter for search
		add_action('restrict_manage_posts', [$this, 'add_filter']);
		// query filter
		add_filter('parse_query', [$this, 'query_filter']);

		add_action('elementor/editor/init', [$this, 'elementor_editor_initialized']);
	}

	/**
	 * On shopengine template elementor editor
	 * Check if the shopengine product id exists for single template
	 *
	 * @since 2.5.0
	 */
	public function elementor_editor_initialized(){
		global $post;

		$post_type             = get_post_type($post);
		$template_type         = get_post_meta($post->ID, 'shopengine_template__post_meta__type', true);
		$shopengine_product_id = (isset($_GET['shopengine_product_id'])) ? sanitize_text_field($_GET['shopengine_product_id']) : false;
		$action                = (isset($_GET['action'])) ? sanitize_text_field($_GET['action']) : false;

		// List of template type that will be needed to check
		$checkable_template_type = ['single', 'quick_view'];

		$shopengine_admin_template_url = Helper::get_admin_list_template_url();
		$product = wc_get_product($shopengine_product_id);

		// check if the post type is not shopengine-template, template type is not single, if action is not elementor and there is no product id
		if ($post_type === 'shopengine-template' && in_array($template_type, $checkable_template_type) && $action === 'elementor' && (!$shopengine_product_id || !$product)) {
			wp_safe_redirect($shopengine_admin_template_url);
			exit();
		}
		return;
	}


	/**
	 * Public function add_author_support.
	 * check author support
	 *
	 * @since 1.0.0
	 */
	public function add_author_support() {
		$this->languages           = apply_filters('shopengine_multi_language', ['status' => false, 'lang_items' => []]);
		$this->activated_templates = Action::get_activated_templates();

		add_post_type_support(Template_Cpt::TYPE, 'author');
	}


	/**
	 * Public function set_columns.
	 * set column for custom post type
	 *
	 * @since 1.0.0
	 */
	public function set_columns($columns) {

		$date_column   = $columns['date'];
		$author_column = $columns['author'];

		unset($columns['date']);
		unset($columns['author']);

		$columns['type']    = esc_html__('Type', 'shopengine');

		if(true === $this->languages['status']) {
			$columns['lang']    = esc_html__('Language', 'shopengine');
		}
	
		$columns['status']  = esc_html__('Status', 'shopengine');
		$columns['builder'] = esc_html__('Builder', 'shopengine');
		$columns['author']  = esc_html($author_column);
		$columns['date']    = esc_html($date_column);

		return $columns;
	}


	/**
	 * Public function render_column.
	 * Render column for custom post type
	 *
	 * @param $column
	 * @param $post_id
	 * @since 1.0.0
	 *
	 */
	public function render_column($column, $post_id) {

		$data                 = get_post_meta($post_id, Action::PK__SHOPENGINE_TEMPLATE, true);
		$template_type        = isset($data['form_type']) ? $data['form_type'] : '';
		$template_config_data = Page_Templates::instance()->getTemplate($template_type);
		$template_class       = $template_config_data['class'] ?? null;
		$category_id          = !empty($data['category_id']) ? $data['category_id'] : 0;
		$template_language    = get_post_meta($post_id, 'language_code', true);

		switch($column) {
			case 'type':
				echo empty($template_config_data) ?  '' : $template_config_data['title'];
				if(class_exists(\ShopEngine_Pro::class)) {
					$cat_name = get_the_category_by_ID($category_id);
					if(isset($cat_name) && !is_wp_error($cat_name)) {
						echo '<br>' . esc_html__('Category', 'shopengine') .' : '. esc_html($cat_name);
					}
				}
				break;

			case 'lang':
				if(!empty($this->languages['lang_items'][$template_language]['country_flag_url'])) {
					?>
						<img src="<?php echo esc_url($this->languages['lang_items'][$template_language]['country_flag_url'])?>">
					<?php
				}
				break;

			case 'builder':
				$builder = Helper::get_template_builder_type($post_id);;
				echo empty($builder) ? 'elementor' : $builder;
				break;

			case 'status':

				$status       = esc_html__('Inactive', 'shopengine');
				$status_class = 'shopengine-deactive';

				if(class_exists($template_class)) {
					$template_data = Action::get_template_data($post_id, $this->activated_templates);
					if('en' === $template_language) {
						if(is_array($template_data) && $template_data['status']) {
							$status       = esc_html__('Active', 'shopengine');
							$status_class = 'shopengine-active';
						}
					} elseif($this->languages['status'] && is_array($template_data) && $template_data['status']) {
						$status       = esc_html__('Active', 'shopengine');
						$status_class = 'shopengine-active';
					}
				}

				echo '<span class="shopengine_default type-'.esc_attr($template_type . ' ' . $status_class).'"> ' . $status . ' </span>';
				break;
		}
	}


	/**
	 * Public function add_filter.
	 * Added search filter for type of template
	 *
	 * @since 1.0.0
	 */
	public function add_filter() {

		global $typenow;

		if($typenow == Template_Cpt::TYPE) {

			$selected = isset($_GET['type']) ? sanitize_key($_GET['type']) : ''; ?>

            <select name="type" id="type">

                <option value="all" <?php selected('all', $selected); ?>><?php esc_html_e('Template Type ', 'shopengine'); ?></option> <?php

				foreach(Templates::get_template_types() as $key => $value) { ?>
                    <option value="<?php echo esc_attr($key); ?>" <?php selected($key, $selected); ?>><?php esc_html_e($value['title'], 'shopengine'); ?></option>
				<?php } ?>

            </select>
			<?php
		}
	}


	/**
	 * Public function query_filter.
	 * Search query filter added in search query
	 *
	 * @param $query
	 * @since 1.0.0
	 */
	public function query_filter($query) {

		global $pagenow;

		$current_page = isset($_GET['post_type']) ? sanitize_key($_GET['post_type']) : '';

		if(
			is_admin()
			&& Template_Cpt::TYPE == $current_page
			&& 'edit.php' == $pagenow
			&& isset($_GET['type'])
			&& $_GET['type'] != ''
			&& $_GET['type'] != 'all'
		) {
			$type                              = isset($_GET['type']) ? sanitize_key($_GET['type']) : '';
			$query->query_vars['meta_key']     = Action::get_meta_key_for_type();
			$query->query_vars['meta_value']   = $type;
			$query->query_vars['meta_compare'] = '=';
		}
	}


	/**
	 * Public function template_selected.
	 * add meta box for choose template ShopEngine
	 *
	 * @since 1.0.0
	 */
	public function template_selected() {
		global $post;

		if(in_array($post->post_type, $this->actionPost_type)):
			foreach($this->actionPost_type as $k => $v):
				add_meta_box(
					'shopengine_template',
					esc_html__('ShopEngine Template', 'shopengine'),
					[$this, 'shopengine_template'],
					$v,
					'side',
					'low'
				);
			endforeach;
		endif;
	}


	/**
	 * Public function template_save.
	 * ShopEngine Template save for product
	 *
	 * @since 1.0.0
	 */
	public function template_save($post_id, $post) {
		if(!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}

		if(in_array($post->post_type, $this->actionPost_type)):
			if(isset($_POST['shopengine-template'])) {
				update_post_meta($post_id, Action::PK__SHOPENGINE_TEMPLATE . '__template', sanitize_key($_POST['shopengine-template']));
			}
		endif;
	}


	/**
	 * Public function shopengine_template.
	 * ShopEngine Template Html
	 *
	 * @since 1.0.0
	 */
	public function shopengine_template() {
		global $post;

		if(!isset($post->ID)) {
			return '';
		}

		$page_template = get_post_meta($post->ID, Action::PK__SHOPENGINE_TEMPLATE . '__template', true);

		$template = $this->get_post_single();
		echo '<select name="shopengine-template">';
		echo '<option value="0"> ' . esc_html__('Default', 'shopengine') . ' </option>';
		if(is_array($template) && sizeof($template) > 0) {
			foreach($template as $k => $v) {
				$select = '';
				if($page_template == $k) {
					$select = 'selected';
				}
				echo '<option value="' . $k . '" ' . $select . '> ' . esc_html($v, 'shopengine') . ' </option>';
			}
		}
		echo '</select>';
	}


	/**
	 * get query post query
	 *
	 * @return array
	 */
	public function get_post_single() {

		$args['post_status'] = 'publish';
		$args['post_type']   = Template_Cpt::TYPE;
		$args['meta_query']  = [
			'relation' => 'AND',
			[
				'key'     => Action::get_meta_key_for_type(),
				'value'   => 'single',
				'compare' => '=',
			],
		];

		$posts   = get_posts($args);
		$options = [];
		$count   = count($posts);
		if($count > 0):
			foreach($posts as $post) {
				$options[$post->ID] = $post->post_title;
			}
		endif;

		return $options;
	}
}
