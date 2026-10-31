<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: icon
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'CDX_Field_icon' ) ) {
  class CDX_Field_icon extends CDX_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $args = wp_parse_args( $this->field, array(
        'button_title' => esc_html__( 'Add Icon', 'cdx' ),
        'remove_title' => esc_html__( 'Remove Icon', 'cdx' ),
      ) );

      echo $this->field_before();

      $nonce  = wp_create_nonce( 'cdx_icon_nonce' );
      $hidden = ( empty( $this->value ) ) ? ' hidden' : '';

      echo '<div class="cdx-icon-select">';
      echo '<span class="cdx-icon-preview'. esc_attr( $hidden ) .'"><i class="'. esc_attr( $this->value ) .'"></i></span>';
      echo '<a href="#" class="button button-primary cdx-icon-add" data-nonce="'. esc_attr( $nonce ) .'">'. $args['button_title'] .'</a>';
      echo '<a href="#" class="button cdx-warning-primary cdx-icon-remove'. esc_attr( $hidden ) .'">'. $args['remove_title'] .'</a>';
      echo '<input type="hidden" name="'. esc_attr( $this->field_name() ) .'" value="'. esc_attr( $this->value ) .'" class="cdx-icon-value"'. $this->field_attributes() .' />';
      echo '</div>';

      echo $this->field_after();

    }

    public function enqueue() {
      add_action( 'admin_footer', array( 'CDX_Field_icon', 'add_footer_modal_icon' ) );
      add_action( 'customize_controls_print_footer_scripts', array( 'CDX_Field_icon', 'add_footer_modal_icon' ) );
    }

    public static function add_footer_modal_icon() {
    ?>
      <div id="cdx-modal-icon" class="cdx-modal cdx-modal-icon hidden">
        <div class="cdx-modal-table">
          <div class="cdx-modal-table-cell">
            <div class="cdx-modal-overlay"></div>
            <div class="cdx-modal-inner">
              <div class="cdx-modal-title">
                <?php esc_html_e( 'Add Icon', 'cdx' ); ?>
                <div class="cdx-modal-close cdx-icon-close"></div>
              </div>
              <div class="cdx-modal-header">
                <input type="text" placeholder="<?php esc_html_e( 'Search...', 'cdx' ); ?>" class="cdx-icon-search" />
              </div>
              <div class="cdx-modal-content">
                <div class="cdx-modal-loading"><div class="cdx-loading"></div></div>
                <div class="cdx-modal-load"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
    }

  }
}
