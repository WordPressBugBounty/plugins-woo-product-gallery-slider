<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access directly.
/**
 *
 * Field: backup
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! class_exists( 'CDX_Field_backup' ) ) {
  class CDX_Field_backup extends CDX_Fields {

    public function __construct( $field, $value = '', $unique = '', $where = '', $parent = '' ) {
      parent::__construct( $field, $value, $unique, $where, $parent );
    }

    public function render() {

      $unique = $this->unique;
      $nonce  = wp_create_nonce( 'cdx_backup_nonce' );
      $export = add_query_arg( array( 'action' => 'cdx-export', 'unique' => $unique, 'nonce' => $nonce ), admin_url( 'admin-ajax.php' ) );

      echo $this->field_before();

      echo '<textarea name="cdx_import_data" class="cdx-import-data"></textarea>';
      echo '<button type="submit" class="button button-primary cdx-confirm cdx-import" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Import', 'cdx' ) .'</button>';
      echo '<hr />';
      echo '<textarea readonly="readonly" class="cdx-export-data">'. esc_attr( json_encode( get_option( $unique ) ) ) .'</textarea>';
      echo '<a href="'. esc_url( $export ) .'" class="button button-primary cdx-export" target="_blank">'. esc_html__( 'Export & Download', 'cdx' ) .'</a>';
      echo '<hr />';
      echo '<button type="submit" name="cdx_transient[reset]" value="reset" class="button cdx-warning-primary cdx-confirm cdx-reset" data-unique="'. esc_attr( $unique ) .'" data-nonce="'. esc_attr( $nonce ) .'">'. esc_html__( 'Reset', 'cdx' ) .'</button>';

      echo $this->field_after();

    }

  }
}
