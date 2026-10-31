<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: background
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'CDX_Field_background' ) ) {
  class CDX_Field_background extends CDX_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args                             = wp_parse_args( $this->field, array(
        'background_color'              => true,
        'background_image'              => true,
        'background_position'           => true,
        'background_repeat'             => true,
        'background_attachment'         => true,
        'background_size'               => true,
        'background_origin'             => false,
        'background_clip'               => false,
        'background_blend_mode'         => false,
        'background_gradient'           => false,
        'background_gradient_color'     => true,
        'background_gradient_direction' => true,
        'background_image_preview'      => true,
        'background_auto_attributes'    => false,
        'compact'                       => false,
        'background_image_library'      => 'image',
        'background_image_placeholder'  => esc_html__( 'Not selected', 'cdx' ),
      ) );

      if ( $args['compact'] ) {
        $args['background_color']           = false;
        $args['background_auto_attributes'] = true;
      }

      $default_value                    = array(
        'background-color'              => '',
        'background-image'              => '',
        'background-position'           => '',
        'background-repeat'             => '',
        'background-attachment'         => '',
        'background-size'               => '',
        'background-origin'             => '',
        'background-clip'               => '',
        'background-blend-mode'         => '',
        'background-gradient-color'     => '',
        'background-gradient-direction' => '',
      );

      $default_value = ( ! empty( $this->field['default'] ) ) ? wp_parse_args( $this->field['default'], $default_value ) : $default_value;

      $this->value = wp_parse_args( $this->value, $default_value );

      echo $this->field_before();

      echo '<div class="cdx--background-colors">';

      //
      // Background Color
      if ( ! empty( $args['background_color'] ) ) {

        echo '<div class="cdx--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="cdx--title">'. esc_html__( 'From', 'cdx' ) .'</div>' : '';

        CDX::field( array(
          'id'      => 'background-color',
          'type'    => 'color',
          'default' => $default_value['background-color'],
        ), $this->value['background-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Color
      if ( ! empty( $args['background_gradient_color'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="cdx--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="cdx--title">'. esc_html__( 'To', 'cdx' ) .'</div>' : '';

        CDX::field( array(
          'id'      => 'background-gradient-color',
          'type'    => 'color',
          'default' => $default_value['background-gradient-color'],
        ), $this->value['background-gradient-color'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      //
      // Background Gradient Direction
      if ( ! empty( $args['background_gradient_direction'] ) && ! empty( $args['background_gradient'] ) ) {

        echo '<div class="cdx--color">';

        echo ( ! empty( $args['background_gradient'] ) ) ? '<div class="cdx---title">'. esc_html__( 'Direction', 'cdx' ) .'</div>' : '';

        CDX::field( array(
          'id'          => 'background-gradient-direction',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Gradient Direction', 'cdx' ),
            'to bottom' => esc_html__( '&#8659; top to bottom', 'cdx' ),
            'to right'  => esc_html__( '&#8658; left to right', 'cdx' ),
            '135deg'    => esc_html__( '&#8664; corner top to right', 'cdx' ),
            '-135deg'   => esc_html__( '&#8665; corner top to left', 'cdx' ),
          ),
        ), $this->value['background-gradient-direction'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      echo '</div>';

      //
      // Background Image
      if ( ! empty( $args['background_image'] ) ) {

        echo '<div class="cdx--background-image">';

        CDX::field( array(
          'id'          => 'background-image',
          'type'        => 'media',
          'class'       => 'cdx-assign-field-background',
          'library'     => $args['background_image_library'],
          'preview'     => $args['background_image_preview'],
          'placeholder' => $args['background_image_placeholder'],
          'attributes'  => array( 'data-depend-id' => $this->field['id'] ),
        ), $this->value['background-image'], $this->field_name(), 'field/background' );

        echo '</div>';

      }

      $auto_class   = ( ! empty( $args['background_auto_attributes'] ) ) ? ' cdx--auto-attributes' : '';
      $hidden_class = ( ! empty( $args['background_auto_attributes'] ) && empty( $this->value['background-image']['url'] ) ) ? ' cdx--attributes-hidden' : '';

      echo '<div class="cdx--background-attributes'. esc_attr( $auto_class . $hidden_class ) .'">';

      //
      // Background Position
      if ( ! empty( $args['background_position'] ) ) {

        CDX::field( array(
          'id'              => 'background-position',
          'type'            => 'select',
          'options'         => array(
            ''              => esc_html__( 'Background Position', 'cdx' ),
            'left top'      => esc_html__( 'Left Top', 'cdx' ),
            'left center'   => esc_html__( 'Left Center', 'cdx' ),
            'left bottom'   => esc_html__( 'Left Bottom', 'cdx' ),
            'center top'    => esc_html__( 'Center Top', 'cdx' ),
            'center center' => esc_html__( 'Center Center', 'cdx' ),
            'center bottom' => esc_html__( 'Center Bottom', 'cdx' ),
            'right top'     => esc_html__( 'Right Top', 'cdx' ),
            'right center'  => esc_html__( 'Right Center', 'cdx' ),
            'right bottom'  => esc_html__( 'Right Bottom', 'cdx' ),
          ),
        ), $this->value['background-position'], $this->field_name(), 'field/background' );

      }

      //
      // Background Repeat
      if ( ! empty( $args['background_repeat'] ) ) {

        CDX::field( array(
          'id'          => 'background-repeat',
          'type'        => 'select',
          'options'     => array(
            ''          => esc_html__( 'Background Repeat', 'cdx' ),
            'repeat'    => esc_html__( 'Repeat', 'cdx' ),
            'no-repeat' => esc_html__( 'No Repeat', 'cdx' ),
            'repeat-x'  => esc_html__( 'Repeat Horizontally', 'cdx' ),
            'repeat-y'  => esc_html__( 'Repeat Vertically', 'cdx' ),
          ),
        ), $this->value['background-repeat'], $this->field_name(), 'field/background' );

      }

      //
      // Background Attachment
      if ( ! empty( $args['background_attachment'] ) ) {

        CDX::field( array(
          'id'       => 'background-attachment',
          'type'     => 'select',
          'options'  => array(
            ''       => esc_html__( 'Background Attachment', 'cdx' ),
            'scroll' => esc_html__( 'Scroll', 'cdx' ),
            'fixed'  => esc_html__( 'Fixed', 'cdx' ),
          ),
        ), $this->value['background-attachment'], $this->field_name(), 'field/background' );

      }

      //
      // Background Size
      if ( ! empty( $args['background_size'] ) ) {

        CDX::field( array(
          'id'        => 'background-size',
          'type'      => 'select',
          'options'   => array(
            ''        => esc_html__( 'Background Size', 'cdx' ),
            'cover'   => esc_html__( 'Cover', 'cdx' ),
            'contain' => esc_html__( 'Contain', 'cdx' ),
            'auto'    => esc_html__( 'Auto', 'cdx' ),
          ),
        ), $this->value['background-size'], $this->field_name(), 'field/background' );

      }

      //
      // Background Origin
      if ( ! empty( $args['background_origin'] ) ) {

        CDX::field( array(
          'id'            => 'background-origin',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Origin', 'cdx' ),
            'padding-box' => esc_html__( 'Padding Box', 'cdx' ),
            'border-box'  => esc_html__( 'Border Box', 'cdx' ),
            'content-box' => esc_html__( 'Content Box', 'cdx' ),
          ),
        ), $this->value['background-origin'], $this->field_name(), 'field/background' );

      }

      //
      // Background Clip
      if ( ! empty( $args['background_clip'] ) ) {

        CDX::field( array(
          'id'            => 'background-clip',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Clip', 'cdx' ),
            'border-box'  => esc_html__( 'Border Box', 'cdx' ),
            'padding-box' => esc_html__( 'Padding Box', 'cdx' ),
            'content-box' => esc_html__( 'Content Box', 'cdx' ),
          ),
        ), $this->value['background-clip'], $this->field_name(), 'field/background' );

      }

      //
      // Background Blend Mode
      if ( ! empty( $args['background_blend_mode'] ) ) {

        CDX::field( array(
          'id'            => 'background-blend-mode',
          'type'          => 'select',
          'options'       => array(
            ''            => esc_html__( 'Background Blend Mode', 'cdx' ),
            'normal'      => esc_html__( 'Normal', 'cdx' ),
            'multiply'    => esc_html__( 'Multiply', 'cdx' ),
            'screen'      => esc_html__( 'Screen', 'cdx' ),
            'overlay'     => esc_html__( 'Overlay', 'cdx' ),
            'darken'      => esc_html__( 'Darken', 'cdx' ),
            'lighten'     => esc_html__( 'Lighten', 'cdx' ),
            'color-dodge' => esc_html__( 'Color Dodge', 'cdx' ),
            'saturation'  => esc_html__( 'Saturation', 'cdx' ),
            'color'       => esc_html__( 'Color', 'cdx' ),
            'luminosity'  => esc_html__( 'Luminosity', 'cdx' ),
          ),
        ), $this->value['background-blend-mode'], $this->field_name(), 'field/background' );

      }

      echo '</div>';

      echo $this->field_after();

    }

    public function output() {

      $output    = '';
      $bg_image  = array();
      $important = ( ! empty( $this->field['output_important'] ) ) ? '!important' : '';
      $element   = ( is_array( $this->field['output'] ) ) ? join( ',', $this->field['output'] ) : $this->field['output'];

      // Background image and gradient
      $background_color        = ( ! empty( $this->value['background-color']              ) ) ? $this->value['background-color']              : '';
      $background_gd_color     = ( ! empty( $this->value['background-gradient-color']     ) ) ? $this->value['background-gradient-color']     : '';
      $background_gd_direction = ( ! empty( $this->value['background-gradient-direction'] ) ) ? $this->value['background-gradient-direction'] : '';
      $background_image        = ( ! empty( $this->value['background-image']['url']       ) ) ? $this->value['background-image']['url']       : '';


      if ( $background_color && $background_gd_color ) {
        $gd_direction   = ( $background_gd_direction ) ? $background_gd_direction .',' : '';
        $bg_image[] = 'linear-gradient('. $gd_direction . $background_color .','. $background_gd_color .')';
        unset( $this->value['background-color'] );
      }

      if ( $background_image ) {
        $bg_image[] = 'url('. $background_image .')';
      }

      if ( ! empty( $bg_image ) ) {
        $output .= 'background-image:'. implode( ',', $bg_image ) . $important .';';
      }

      // Common background properties
      $properties = array( 'color', 'position', 'repeat', 'attachment', 'size', 'origin', 'clip', 'blend-mode' );

      foreach ( $properties as $property ) {
        $property = 'background-'. $property;
        if ( ! empty( $this->value[$property] ) ) {
          $output .= $property .':'. $this->value[$property] . $important .';';
        }
      }

      if ( $output ) {
        $output = $element .'{'. $output .'}';
      }

      $this->parent->output_css .= $output;

      return $output;

    }

  }
}
