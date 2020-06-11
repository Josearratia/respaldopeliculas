<?php
/*
* ----------------------------------------------------
* @author: Doothemes
* @author URI: https://doothemes.com/
* @copyright: (c) 2017 Doothemes. All rights reserved
* ----------------------------------------------------
*
* @since 2.1.4
*
*/

if ( !class_exists('Doofields') ) {

    /* The class
	========================================================
	*/
    class Doofields {

        // Attributes
        public $args = null;

        /* Construct
        =============================*/
        public function __construct($args = null) {

            // Generate fields
            foreach($args as $item ){
                $this->fields_html($item);
            }
        }

        /* Get postmeta
        =============================*/
        public function meta( $value ) {
            global $post;
            $field = get_post_meta( $post->ID, $value, true );
            if ( ! empty( $field ) ) {
                return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
            } else {
                return false;
            }
        }

        /* Get fields
        =============================*/
        public function fields_html( $item ) {

            switch ( $item['type'] ) {

                case 'text':
                    return $this->text($item);
                break;

                case 'textarea':
                    return $this->textarea($item);
                break;

                case 'date':
                    return $this->tdate($item);
                break;

                case 'generator':
                    return $this->generator($item);
                break;

                case 'checkbox':
                    return $this->checkbox($item);
                break;

                case 'upload':
                    return $this->upload($item);
                break;

                case 'heading':
                    return $this->heading($item);
                break;

            }

        }

        /* Field Text
        =============================*/
        public function text($args) {

            // Parameters
            $label = isset( $args['label'] ) ? $args['label'] : null;
            $id    = isset( $args['id'] ) ? $args['id']       : null;
            $id2   = isset( $args['id2'] ) ? $args['id2']     : null;
            $class = isset( $args['class'] ) ? $args['class'] : null;
            $fdesc = isset( $args['fdesc'] ) ? $args['fdesc'] : null;
            $desc  = isset( $args['desc'] ) ? $args['desc']   : null;
            $doubl = isset( $args['double'] ) ? $args['double'] : null;

            // View
            echo '<tr id="'.$id.'_box"><td class="label"><label for="'.$id.'">'.$label.'</label>';
    		echo '<p class="description">'.$desc.'</p></td>';
    		echo '<td class="field">';
            if( $doubl != null ) {
                echo '<input class="extra-small-text" type="text" name="'.$id.'" id="'.$id.'" value="'.$this->meta( $id ).'"> - ';
                echo '<input class="extra-small-text" type="text" name="'.$id2.'" id="'.$id2.'" value="'.$this->meta( $id2 ).'">';
            } else {
                echo '<input class="'.$class.'" type="text" name="'.$id.'" id="'.$id.'" value="'.$this->meta( $id ).'">';
            }
            if( $fdesc != null ) {
                echo '<p class="description">'.$fdesc.'</p>';
            }
            echo '</td></tr>';
        }

        /* Field textarea
        =============================*/
        public function textarea($args) {

            // Parameters
            $id     = isset( $args['id'] ) ? $args['id'] : null;
            $desc   = isset( $args['desc'] ) ? $args['desc'] : null;
            $upload = isset( $args['upload'] ) ? $args['upload'] : null;
            $aid    = isset( $args['aid'] ) ? $args['aid'] : null;
            $label  = isset( $args['label'] ) ? $args['label'] : null;
            $rows   = isset( $args['rows'] ) ? $args['rows'] : null;

            // View
            echo '<tr id="'.$id.'_box"><td class="label"><label for="'.$id.'">'.$label.'</label>';
    		echo '<p class="description">'.$desc.'</p></td>';
    		echo '<td class="field"><textarea name="'.$id.'" id="'.$id.'" rows="'.$rows.'">'.$this->meta( $id ).'</textarea>';
            if( $upload != null ) {
                echo '<input class="'.$aid.' button-secondary" type="button" value="'. __d('Upload').'" />';
            }
    		echo '</td></tr>';
        }

        /* Field Date
        =============================*/
        public function tdate($args) {

            // Parameters
            $id    = isset( $args['id'] ) ? $args['id'] : null;
            $label = isset( $args['label'] ) ? $args['label'] : null;
            $fdesc = isset( $args['fdesc'] ) ? $args['fdesc'] : null;

            // View
            echo '<tr id="'.$id.'_box">';
    		echo '<td class="label"><label for="'.$id.'">'.$label.'</label></td>';
    		echo '<td class="field">';
            echo '<input class="small-text" type="date" name="'.$id.'" id="'.$id.'" value="'. $this->meta( $id ) .'">';
            if( $fdesc != null ) {
                echo '<p class="description">'.$fdesc.'</p>';
            }
            echo '</td></tr>';
        }

        /* Field Generator
        =============================*/
        public function generator($args) {

            // Parameters
            $id           = isset( $args['id'] ) ? $args['id'] : null;
            $id2          = isset( $args['id2'] ) ? $args['id2'] : null;
            $id3          = isset( $args['id3'] ) ? $args['id3'] : null;
            $label        = isset( $args['label'] ) ? $args['label'] : null;
            $desc         = isset( $args['desc'] ) ? $args['desc'] : null;
            $style        = isset( $args['style'] ) ? $args['style'] : null;
            $fdesc        = isset( $args['fdesc'] ) ? $args['fdesc'] : null;
            $class        = isset( $args['class'] ) ? $args['class'] : null;
            $placeholder  = isset( $args['placeholder'] ) ? $args['placeholder'] : null;
            $placeholder2 = isset( $args['placeholder2'] ) ? $args['placeholder2'] : null;
            $placeholder3 = isset( $args['placeholder3'] ) ? $args['placeholder3'] : null;
            $text_buttom  = ( $this->meta( $args['id'] ) ) ? __('Update data') : __('Generate');

            // View
            echo '<tr id="'.$id.'_box"><td class="label">';
    		echo '<label for="'.$id.'">'.$label.'</label>';
    		echo '<p class="description">'.$desc.'</p></td>';
            echo '<td '.$style.' class="field">';
    		if( $id != null ) echo '<input class="'.$class.'" type="text" name="'.$id.'" id="'.$id.'" placeholder="'.$placeholder.'" value="'.$this->meta( $id ).'"> ';
			if( $id2 != null ) echo '<input class="'.$class.'" type="text" name="'.$id2.'" id="'.$id2.'" placeholder="'.$placeholder2.'" value="'.$this->meta( $id2 ).'"> ';
			if( $id3 != null ) echo '<input class="'.$class.'" type="text" name="'.$id3.'" id="'.$id3.'" placeholder="'.$placeholder3.'" value="'.$this->meta( $id3 ).'"> ';
    		echo '<input type="button" class="button button-primary" name="generate_data_api" id="generate_data_api" value="'.$text_buttom.'">';
    		echo '<p class="description">'.$fdesc.'</p>';
    		echo '<p id="verificador" style="display:none"><a class="button button-secundary" id="comprovate">'.__d('Check duplicate content').'</a><p>';
    		echo '</td></tr>';
        }

        /* Field Checkbox
        =============================*/
        public function checkbox($args) {

            // Parameters
            $id      = isset( $args['id'] ) ? $args['id'] : null;
            $label   = isset( $args['label'] ) ? $args['label'] : null;
            $clabel  = isset( $args['clabel'] ) ? $args['clabel'] : null;
            $checked = ( $this->meta( $id ) == 1 ) ? 'checked' : null;

            // View
            echo '<tr id="'.$id.'_box"><td class="label"><label>'.$label.'</label></td>';
            echo '<td class="field"><label for="'.$id.'_clik"><input type="checkbox" name="'.$id.'" value="1" id="'.$id.'_clik" '.$checked.'> '.$clabel.'</label></td></tr>';
        }

        /* Fiel simple Upload text
        =============================*/
        public function upload($args) {

            // Parameters
            $id      = isset( $args['id'] ) ? $args['id'] : null;
            $aid     = isset( $args['aid'] ) ? $args['aid'] : null;
            $label   = isset( $args['label'] ) ? $args['label'] : null;
            $desc    = isset( $args['desc'] ) ? $args['desc'] : null;
            $ajax    = isset( $args['ajax'] ) ? $args['ajax'] : null;
            $prelink = isset( $args['prelink'] ) ? $args['prelink'] : null;

            // View
            echo '<tr id="'.$id.'_box"><td class="label"><label for="dt_poster">'.$label.'</label><p class="description">'.$desc.'</p></td>';
    		echo '<td class="field"><input class="regular-text" type="text" name="'.$id.'" id="'.$id.'" value="'.$this->meta( $id ).'"> ';
    		echo '<input class="'.$aid.' button-secondary" type="button" value="'. __d('Upload') .'" /> ';
            if( $ajax != null ) {
                if( !filter_var( $this->meta( $id ), FILTER_VALIDATE_URL) ) {
                    echo '<input class="import-upload-image button-secondary" type="button" data-field="'.$id.'" data-postid="'.get_the_ID().'" data-nonce="'. wp_create_nonce('dt-ajax-upload-image').'" data-prelink="'.$prelink.'" value="'. __d('Upload now').'" />';
                }
            }
    		echo '</td></tr>';
        }

        /* Field Heading
        =============================*/
        public function heading($args) {

            // Parameters
            $colspan = isset( $args['colspan'] ) ? $args['colspan'] : null;
            $text    = isset( $args['text'] ) ? $args['text'] : null;

            // View
            echo '<tr><td colspan="'.$colspan.'"><h3>'.$text.'</h3></td></tr>';
        }
    }
}
