<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @aopyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.4
*
*/

if ( !class_exists('Doothemes_famework') ) {

	/* The class
	========================================================
	*/
	class Doothemes_famework {

        private $options;

        /* Construct Class
		========================================================
		*/
		public function __construct($options) {
			$this->options = $options;
			add_action('admin_menu',array( &$this, 'doothemes_add_menu') );
		}

        /* Menu Framework
		========================================================
		*/
		public function doothemes_add_menu() {
			add_theme_page( DOO_THEME.' options', __d('DooPlay Options'),'manage_options',DOO_THEME_SLUG, array( &$this,'doothemes_display_page' ), 'dashicons-admin-generic');
		}

        /* Display HTML
		========================================================
		*/
		public function doothemes_display_page() {

            $this->save_options();
            $menusect = get_option('dt_menu_framework_secion');
            $msection = ( $menusect['msection'] ) ? $menusect['msection'] : 'general';
            $ssection = ( $menusect['ssection'] ) ? $menusect['ssection'] : 'general';
            add_thickbox();
			echo '<form id="domts-settings" method="post">';
			echo '<div id="domts-sidebar">';
			echo '<ul id="domts-main-menu">';

            // Sections
			foreach ($this->options as $option) {
				if ($option['type'] == "section") {
					$section	= $option['id'];
					$expanded	= ( $option['id'] == $msection ) ? 'default-accordion' : 'normalizer';
					echo '<li><p class="get_msection"><span style="color: '.$option['color'].'" class="dashicons-before '.$option['icon'].'"></span>'.$option['title'].'</p>';
					echo '<ul class="'.$expanded.'">';
					foreach ($this->options as $sections) {
						if ( isset( $sections['section'] ) && ($sections['section'] == $section) && (($sections['type'] == "heading") || ($sections['type'] == "html"))) {
                            $toctos = ( $sections['id'] == $ssection ) ? 'defaulttab selected' : 'normalizer';
                            echo '<li><a href="index.php" class="'.$toctos.' get_ssection" rel="'.$sections['id'].'" data-msection="'.$sections['section'].'" data-ssection="'.$sections['id'].'"><p>'. $sections['title']. '</p></a></li>';
						}
					}
					echo '</ul></li>';
				}
			}

			echo '</ul>';
			echo '<div id="domts-meta-info">';
			echo '<h2><a href="'. DOO_SUPPORT_FORUMS. '?TB_iframe=true&width=1000&height=600" class="thickbox">'. __d('Support forum'). '</a></h2>';
            echo '<h2><a href="'. DOO_SERVER .'/docs/dooplay-documentation/?TB_iframe=true&width=1020&height=600" class="thickbox" target="_blank">'. __d('Documentation'). '</a></h2>';
			echo '<h2><a href="'. DOO_CHANGELOG. '&TB_iframe=true&width=600&height=600" class="thickbox" target="_blank">'. __d('Changelog'). '</a></h2>';
			echo '</div></div>';
			echo '<div id="domts-content">';

            // Contents
			foreach ($this->options as $option) {
				if ($option['type'] == "heading") {
					$under_section = $option['id'];
					echo '<div class="tab-content" id="'. $option['id']. '">';
					echo '<div class="domts-settings-headline">';
					echo '<h2>'. $option['title']. '</h2>';
					echo '<input name="publish" class="dt_button button button-primary button-large dt_save_framework" type="submit" value="'. __d('Save changes'). '" /></div>';

					// Under Section
					foreach ($this->options as $item) {
						if (isset( $item['under_section'] ) && $item['under_section'] == $under_section) {
							switch ($item['type']) {
								case "text":
									$this->display_text($item);
								break;

								case "password":
									$this->display_password($item);
								break;

								case "number":
									$this->display_number($item);
								break;

								case "color":
									$this->display_color($item);
								break;

								case "small_heading":
									$this->display_small_heading($item);
								break;

								case "textarea":
									$this->display_textarea($item);
								break;

								case "image":
									$this->display_image($item);
								break;

								case "checkbox":
									$this->display_checkbox($item);
								break;

								case "radio":
									$this->display_radio($item);
								break;

								case "toggle_div_start":
									$this->display_toggle_div_start($item);
								break;

								case "toggle_div_end":
									$this->display_toggle_div_end();
								break;

								case "select":
									$this->display_select($item);
								break;

								case "pages":
									$this->display_pages($item);
								break;

								case "tips":
									$this->display_tips($item);
								break;

                                case "cleaner":
									$this->display_cleaner($item);
								break;

								case "sortable":
									$this->display_sortable($item);
								break;
							}
						}
					}
					echo '</div>';
				}
				if ($option['type'] == "html") {
					echo '<div class="tab-content" id="'. $option['id']. '">';
					echo $option['source'];
					echo '</div>';
				}
			}

			echo '<div class="dt_footer">';
            echo '<strong>'.DOO_THEME. '</strong> '. DOO_VERSION;
			echo '<input name="save" class="dt_button button button-primary button-large dt_save_framework" type="submit" value="'. __d('Save changes'). '" />';
			echo '</div></div>';
			echo '<input type="hidden" name="action" id="action" value="domts_save_options" /></form>';
		}

		/* Save Options
		========================================================
		*/
		public function save_options() {
			if (isset($_POST['action']) && $_POST['action'] == "domts_save_options") {
				foreach ($this->options as $value) {
					$the_type = $value['type'];
					if ($the_type == "heading" || $the_type == "section" || $the_type == "small_heading")
						continue;
					else if ($the_type != "checkbox" && $_POST[$value['id']] != null ) {
						update_option($value['id'], $_POST[$value['id']]);
					} else if ($the_type == "checkbox") {
							$i = 0;
						foreach ($value['options'] as $box) {
							$curr_id = $value['id'][$i];
							if ( isset( $_POST[$curr_id] ) )
								update_option($curr_id, 'true');
							else
								update_option($curr_id, 'false');
							$i++;
						}
					} else {
						delete_option($value['id']);
					}
				}
			}
		}

		/* SORTABLE
		========================================================
		*/
		public function display_sortable($value) {
			$rel      = isset( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$option   = ( get_option( $value['id'] ) ) ? get_option( $value['id'] ) : $value['items'];
			$enabled  = ( ! empty( $option['enabled'] ) ) ? $option['enabled']      : array();
			$disabled = ( ! empty( $option['disabled'] ) ) ? $option['disabled']    : array();
			echo '<div'.$rel. ' class="dt_separator"><div class="sortable_div">';
			echo '<div class="left"><h3>'. __d('Modules enabled').'</h3><ul id="sortable_enabled" class="dt-sorter-enabled">';
			if( ! empty( $enabled ) ) {
				foreach( $enabled as $en_id => $en_name ) {
					echo '<li id="'.$en_id.'"><input type="hidden" name="'.$value['id'].'[enabled]['.$en_id.']" value="'.$en_name.'">'.$en_name.'</li>';
				}
			}
			echo '</ul></div>';
			echo '<div class="right"><h3>'. __d('Modules disabled').'</h3><ul id="sortable_disabled" class="dt-sorter-disabled">';
			if( ! empty( $disabled ) ) {
				foreach( $disabled as $dis_id => $dis_name ) {
					echo '<li id="'.$dis_id.'"><input type="hidden" name="'.$value['id'].'[disabled]['.$dis_id.']" value="'.$dis_name.'">'.$dis_name.'</li>';
				}
			}
			echo '</ul></div>';
			echo '</div></div>';
		}

        /* CLEANER
		========================================================
		*/
        public function display_cleaner($value) {
            $rel = ( $value['display_checkbox_id'] ) ? ' rel="'. $value['display_checkbox_id']. '"' : null;
            echo '<div'.$rel. ' class="dt_separator cleaner_page">';
                require_once( DOO_DIR. '/inc/core/doothemes/framework/dboptimizer.php');
            echo '</div>';
        }

        /* TIPS
		========================================================
		*/
		public function display_tips($value) {
			$rel = isset( $value['display_checkbox_id'] ) ? ' rel="'. $value['display_checkbox_id']. '"' : null;
			echo '<div'.$rel. ' class="dt_separator info">';
			echo isset( $value['text'] ) ? '<p class="dt_f_tips">'. $value['text']. '</p>' :  null;
			echo isset( $value['code'] ) ? '<pre class="dt_f_code">'. $value['code']. '</pre>' : null;
			echo '</div>';
		}

		/* TEXT
		========================================================
		*/
		public function display_text($value) {

			// DATA
			$default        = isset( $value['default'] ) ? $value['default'] : null;
			$rel			= isset( $value['display_checkbox_id'] ) ? ' rel="'. $value['display_checkbox_id']. '"' : null;
			$placeholder	= isset( $value['placeholder'] ) ? ' placeholder="'. $value['placeholder'] .'"' : null;
			$extra			= isset( $value['extra'] ) ? $value['extra'] : null;
			$option			= ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $default;
			$descr          = isset( $value['desc'] ) ? $value['desc'] : null;
			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<input '.$placeholder.' class="domts-fullwidth" id="'. $value['id']. '" name="'. $value['id']. '" type="text" value="'.$option.'" '.$extra.'/>';
			echo '<p class="description">'. $descr. '</p></div></div>';
		}

        /* PASSWORD
		========================================================
		*/
		public function display_password($value) {

			// DATA
			$rel			= ( $value['display_checkbox_id'] ) ? ' rel="'. $value['display_checkbox_id']. '"' : null;
			$placeholder	= ( $value['placeholder'] ) ? ' placeholder="'. $value['placeholder'] .'"' : null;
			$extra			= ( $value['extra'] ) ? $value['extra'] : null;
			$option			= ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $value['default'];

			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo ( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<input '.$placeholder.' class="domts-fullwidth" id="'. $value['id']. '" name="'. $value['id']. '" type="password" value="'.$option.'" '.$extra.'/>';
			echo '<p class="description">'. $value['desc']. '</p></div></div>';
		}

        /* NUMBER
		========================================================
		*/
		public function display_number($value) {

			// DATA
			$rel			= ( $value['display_checkbox_id'] ) ? ' rel="'. $value['display_checkbox_id']. '"' : null;
			$placeholder	= isset( $value['placeholder'] ) ? ' placeholder="'. $value['placeholder'] .'"' : null;
			$option			= ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $value['default'];

            // HTML
            echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<input '.$placeholder.' class="number" min="'.$value['min'].'" max="'.$value['max'].'" step="'.$value['step'].'" id="'.$value['id'].'" name="'.$value['id'].'" type="number" value="'.$option.'" />';
			echo '<p class="description">'. $value['desc']. '</p></div></div>';
		}

        /* COLOR
		========================================================
		*/
		public function display_color($value) {

			// DATA
			$rel	= isset( $value['display_checkbox_id'] ) ? ' rel="'. $value['display_checkbox_id']. '"' : null;
			$option	= ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $value['default'];

			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<input class="domts-color-picker" type="text" maxlength="7" data-default-color="'.$value['default'].'" style="display:inline-block" id="'.$value['id'].'" name="'.$value['id'].'" value="'.$option.'">';
			echo '<p class="description">'. $value['desc']. '</p></div></div>';
		}

		/* IMAGE
		========================================================
		*/
		public function display_image($value) {

			// DATA
			$default        = isset( $value['default'] ) ? $value['default'] : null;
			$rel			= ( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$placeholder	= isset( $value['placeholder'] ) ? ' placeholder ="'. $value['placeholder'] .'"' : null;
			$option			= ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $default;
			$option2		= get_option( $value['id'] );

			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo '<input'.$placeholder.' id="'.$value['id'].'" class="domts-fullwidth dt_upload" type="text" value="'.$option.'" name="'.$value['id'].'" />';
			echo '<span class="upload domts_upload button button-small doobtn" data-id="'.$value['id'].'">'. __d('Upload'). '</span>';

			// Delete buttom
			if ( $option2 ) {
				echo '<span type="button" class="domts_remove button button-small doobtn" id="remove_'.$value['id'].'" data-id="'.$value['id'].'">'. __d('Remove'). '</span>';
			} else {
				echo '<span type="button" class="domts_remove hiddenex button button-small doobtn" id="remove_'. $value['id']. '" data-id="'.$value['id']. '">'. __d('Remove'). '</span>';
			}
			echo '<div id="preview_'.$value['id'].'" class="domts_image_preview">';

			// Define Image preview
			if($option2) {
				echo '<img src="'.$option2.'" />';
			} elseif( $default != null ) {
				echo '<img src="'.$value['default'].'" />';
			}
			echo '</div><p class="description">'. $value['desc']. '</p></div></div>';
		}

		/* TEXTAREA
		========================================================
		*/
		public function display_textarea($value) {

			$desc = isset( $value['desc'] ) ? $value['desc'] : null;
			// DATA
			$rel = isset( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$pch = isset( $value['placeholder'] ) ? ' placeholder ="'. $value['placeholder'] .'"' : null;
			$opt = ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $value['default'];
			$cod = isset( $value['code'] ) ? $value['code'] : null;
			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label><pre class="dt_f_code">'.$cod.'</pre></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<textarea'.$pch.' id="'.$value['id'].'" name="'.$value['id'].'" cols="70" rows="'.$value['rows'].'">'.$opt.'</textarea>';
			echo '<p class="description">'.$desc.'</p></div></div>';
		}

		/* SELECT
		========================================================
		*/
		public function display_select($value) {

			// DATA
			$rel = isset( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$got = ( get_option( $value['id'] ) ) ? stripslashes( get_option( $value['id'] ) ) : $value['default'];

			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<select name="'.$value['id'].'" id="'.$value['id'].'">';
			foreach ($value['options'] as $valor => $option) {
				echo '<option value="'.$valor.'" '. selected( $valor, $got, false ) .'>'.$option.'</option>';
			}
			echo '</select>';
			echo '<p class="description">'. $value['desc']. '</p></div></div>';
		}

		/* PAGES
		========================================================
		*/
		public function display_pages($value) {

			// DATA
			$rel = isset( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$opt = get_option( $value['id'] );
			$pag = get_pages();

			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			echo '<select name="'.$value['id'].'" id="'.$value['id'].'">';
			foreach ($pag as $page) {
				echo '<option value="'.get_page_link($page->ID).'" ' . selected( $opt, get_page_link( $page->ID ), false ) . '>'. $page->post_title. '</option>';
			}
			echo '</select>';
			echo '<p class="description">'. $value['desc']. '</p></div></div>';
		}

		/* CHECKBOX
		========================================================
		*/
		public function display_checkbox($value) {

			// DATA
			$rel  = isset( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$desc = isset( $value['desc'] ) ? $value['desc'] : null;
			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label>'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			$i = 0;
			foreach ($value['options'] as $box) {
				$checked = '';
				if (get_option($value['id'][$i])) {
					if ( get_option($value['id'][$i] ) == 'true') {
						$checked = ' checked="checked"';
					} else {
						$checked = null;
					}
				} else {
					if ($value['default'][$i] == "checked") {
						$checked = ' checked="checked"';
					}
				}
				echo '<label for="'.$value['id'][$i].'"><input type="checkbox"'. $checked. ' name="'. $value['id'][$i]. '" id="'. $value['id'][$i]. '" />'.$box.'</label>';
				$i++;
			}
			echo '<p class="description">'. $desc. '</p></div></div>';
		}

		/* RADIO
		========================================================
		*/
		public function display_radio($value) {

			// DATA
			$rel = isset( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;
			$dfl = ( get_option( $value['id'] ) ) ? get_option( $value['id'] ) : $value['default'];

			// HTML
			echo '<div'.$rel. ' class="dt_separator">';
			echo '<div class="label"><label for="'.$value['id'].'">'.$value['name'].'</label></div>';
			echo '<div class="settings-content">';
			echo isset( $value['img_desc'] ) ? '<div class="domts_image_preview"><img src="'. $value['img_desc']. '" /></div>' : null;
			$i = 0;
			foreach ($value['options'] as $valor => $option) {
				$checked = ($valor == $dfl) ? ' checked="checked"' : null;
				echo '<label for="'.$value['id'] . $i.'"><input type="radio" id="'. $value['id'] . $i.'" name="'.$value['id'].'" value="'.$valor.'" '.$checked.' />'.$option.'</label>';
				$i++;
			}
			echo '<p class="description">'. $value['desc']. '</p></div></div>';
		}

		/* SMALL HEADING
		========================================================
		*/
		public function display_small_heading($value) {

			// DATA
			$rel = ( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;

			// HTML
			echo '<div'.$rel. ' class="dt_separator"><h4>'.$value['title'].'</h4></div>';
		}

		/* HIDING DIV START
		========================================================
		*/
		public function display_toggle_div_start($value) {

			// DATA
			$rel = ( $value['display_checkbox_id'] ) ? ' rel ="'. $value['display_checkbox_id']. '"' : null;

			//HTML
			echo '<div'. $rel. '>';

		}

		/* HIDING DIV END
		========================================================
		*/
		public function display_toggle_div_end() {

			// HTML
			echo '</div>';

		}

	} // End Class

} // End page Theme options
