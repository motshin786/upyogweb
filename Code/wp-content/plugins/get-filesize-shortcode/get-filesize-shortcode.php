<?php 
/*
Plugin Name: Get Filesize Shortcode
Plugin URI: http://ika-ring.net
Description: Simple shortcode to get filesize of a file( eg. PDF, JPG, PNG ... ) with a human readable format, using the largest unit the bytes will fit into.
Version: 1.0.10
Author: Kan Ikawa
Author URI: http://ika-ring.net
License: GPL2

  Copyright 2015 Kan Ikawa (email : kan@ika-ring.net)

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/


// Usage: [filesize]http://wordpress.com/path/to/filename.pdf[/filesize]

function ika_get_filesize( $atts, $content = null ) {
  // i18n
  load_plugin_textdomain(
    'get_filesize_shortcode',
    false,
    dirname( plugin_basename( __FILE__ ) ).'/languages'
  );
  
  extract( shortcode_atts( array(
  	'url' => '',
  ), $atts ) );
  
  //Replace url to directory path
  if ( empty( $content ) ) {
    $path = str_replace( site_url('/'), ABSPATH, strip_tags( $url ) );
  } else {
    $path = str_replace( site_url('/'), ABSPATH, strip_tags( $content ) );
  }
  
  if ( is_file( $path ) ){
    $filesize = size_format( filesize( $path ) );
  } else {
    $filesize = __( 'File not found!', 'get_filesize_shortcode');
  }
  return $filesize;

}
add_shortcode('filesize', 'ika_get_filesize');