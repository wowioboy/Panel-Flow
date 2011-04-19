<?php /* $Id$ */
# ImageThumb - a simple on-the-fly image thumbnailer in PHP.
# Copyright (C) 2003, 2004, 2005 Marco Olivo - modified 2005 by Chris Rossi
#
# This program is free software; you can redistribute it and/or
# modify it under the terms of the GNU General Public License
# as published by the Free Software Foundation; either version 2
# of the License, or (at your option) any later version.
#
# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.
#
# You should have received a copy of the GNU General Public License
# along with this program; if not, write to the Free Software
# Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

/***********************************************************************/
/* ImageThumb, v.1.1                                                   */
/* - creates a thumbnail of up to the given size of the given image,   */
/*   keeping the original aspect ratio.                                */
/* Copyright (C) by Marco Olivo, 2003-2005                             */
/* Modified by Chris Rossi, 2005                                       */
/* This sofware can be found at:                                       */
/* http://www.olivo.net/software/imagethumb/                           */
/*                                                                     */
/* PARAMETERS                                                          */
/* ----------                                                          */
/* s - the path to the image to be resized (can also be an URL)        */
/* w - the max width desired (optional, default: 320)                  */
/* h - the max height desired (optional, default: 200)                 */
/*                                                                     */
/* GD-library compiled and loaded in PHP is REQUIRED.                  */
/*                                                                     */
/* This software is distributed under GPL license 2 or following.      */
/*                                                                     */
/***********************************************************************/

/* some script configuration */
$GENERATE_CACHE = false;	/* if true, generates caches of the thumbnailed images */
$CACHE_PATH = '/tmp/imagethumbs/';	/* the full path where thumbnails should be saved (if $GENERATE_CACHE is enabled) */
$BROKEN_IMAGE_PATH = '/path_to/broken.png';	/* the full path to the image to be shown when a non-valid image is required or found */
$BASE_HREF = '';	/* the path string to prepend to every image requested (except external resources, if they are allowed) */
$ALLOW_HTTP_IMAGES = true;	/* allow requests of http:// or ftp:// resources? Make sure that in php.ini "allow_url_fopen" is set to "true" */

/* some settings */
ignore_user_abort();
set_time_limit( 0 );
error_reporting( FATAL | ERROR | WARNING );

/* security check */
ini_set( 'register_globals', '0' );

/* start buffered output */
ob_start();

function filemtime_remote( $uri ) {
	$uri = parse_url( $uri );
	$uri['port'] = isset( $uri['port'] ) ? $uri['port'] : 80;
	$handle = @fsockopen( $uri['host'], $uri['port'] );
	if( ! $handle ) return 0;

	fputs( $handle, "HEAD $uri[path] HTTP/1.1\r\nHost: $uri[host]\r\n\r\n" );
	$result = 0;
	while( ! feof( $handle ) ) {
		$line = fgets( $handle, 1024 );
		if( ! trim( $line ) ) break;

		$col = strpos( $line, ':' );
		if( $col !== false ) {
			$header = trim( substr( $line, 0, $col ) );
			$value = trim( substr( $line, $col + 1 ) );
			if( strtolower( $header ) == 'last-modified' ) {
				$result = strtotime( $value );
				break;
			}
		}
	}
	fclose( $handle );
	return $result;
}

/* temporary kludge */
//while ( list( $key, $val ) = each( $HTTP_GET_VARS ) ) $_GET[ $key ] = $val;

if ( ! eregi( "^http://", $_GET['s'] ) && ! eregi( "^ftp://", $_GET['s'] ) ) {
	$_GET['s'] = $BASE_HREF . $_GET['s'];
}

/* get source image size */
$src_size = getimagesize( $_GET['s'] );

/* some checks */
if ( ! isset( $_GET['s'] ) ) die( 'Source image not specified' );
if ( isset( $_GET['w'] ) && ereg( "^[0-9]+$", $_GET['w'] ) ) $MAX_WIDTH = $_GET['w'];
else $MAX_WIDTH = $src_size[0];
if ( isset( $_GET['h'] ) && ereg( "^[0-9]+$", $_GET['h'] ) ) $MAX_HEIGHT = $_GET['h'];
else $MAX_HEIGHT = $src_size[1];

/* avoid the .. trick */
if ( ereg( "\.\./", $_GET['s'] ) || ereg( "\.\.\\\\", $_GET['s'] ) ) {
    print 'Hack attempt, your attempt together with your IP-address has been registered in system logs. Have a nice day.';

	/* end buffered output */
	ob_end_flush();

	exit();
}

if ( ! $ALLOW_HTTP_IMAGES && ( eregi( "^http://", $_GET['s'] ) || eregi( "^ftp://", $_GET['s'] ) ) ) {
	$data = readfile( $BROKEN_IMAGE_PATH );
	$dest = imagecreatefromstring( $data );
	header( 'Content-type: image/jpeg' );
	imagejpeg( $dest );

	/* end buffered output */
	ob_end_flush();

	exit();
}

/* for creating md5 thumbnail file that will update when file is changed */
$full_url = str_replace( 'http://', '', $_GET['s'] );
$full_url = filemtime_remote( $_GET['s'] ) . '_' . $MAX_WIDTH . '_' . $MAX_HEIGHT . '_' . $full_url;

$ext = strtolower( substr( $_GET['s'], strrpos( $_GET['s'], '.' ) + 1 ) );

$thumb_file = md5( $full_url ) . '_' . basename( $_GET['s'] );
$png_thumb_file = str_replace( '.' . $ext, '.png', $thumb_file );
$gif_thumb_file = str_replace( '.' . $ext, '.gif', $thumb_file );
$jpg_thumb_file = str_replace( '.' . $ext, '.jpg', $thumb_file );

if ( ( ! file_exists( $CACHE_PATH . $png_thumb_file ) &&
	   ! file_exists( $CACHE_PATH . $gif_thumb_file ) &&
	   ! file_exists( $CACHE_PATH . $jpg_thumb_file ) ) ) {

	/* resize the image (if needed) */
	if ( $src_size[0] > $MAX_WIDTH && $src_size[1] > $MAX_HEIGHT ) {
		if ( $src_size[0] > $src_size[1] ) {
			$dest_width = $MAX_WIDTH;
			$dest_height = ( $src_size[1] * $MAX_WIDTH ) / $src_size[0];
		}
		else {
			$dest_width = ( $src_size[0] * $MAX_HEIGHT ) / $src_size[1];
			$dest_height = $MAX_HEIGHT;
		}
	}
	else if ( $src_size[0] > $MAX_WIDTH ) {
		$dest_width = $MAX_WIDTH;
		$dest_height = ( $src_size[1] * $MAX_WIDTH ) / $src_size[0];
	}
	else if ( $src_size[1] > $MAX_HEIGHT ) {
		$dest_width = ( $src_size[0] * $MAX_HEIGHT ) / $src_size[1];
		$dest_height = $MAX_HEIGHT;
	}
	else {
		$dest_width = $src_size[0];
		$dest_height = $src_size[1];
	}

	/* force resizing in both dimensions? */
	if ( isset( $_GET['w'] ) && isset( $_GET['h'] ) ) {
		$dest_width = $MAX_WIDTH;
		$dest_height = $MAX_WIDTH;
	}

	if ( extension_loaded( 'gd' ) ) {

		/* check the source file format */
		if ( $ext == 'jpg' || $ext == 'jpeg' ) $src = imagecreatefromjpeg( $_GET['s'] ) or $failed = true;
		else if ( $ext == 'gif' ) $src = imagecreatefromgif( $_GET['s'] ) or $failed = true;
		else if ( $ext == 'png' ) $src = imagecreatefrompng( $_GET['s'] ) or $failed = true;
		else $failed = true;

		if( $failed != true ) {
			/* create and output the destination image */
			$dest = imagecreatetruecolor( $dest_width, $dest_height ) or die( 'Cannot initialize new GD image stream' );
			imagecopyresampled( $dest, $src, 0, 0, 0, 0, $dest_width, $dest_height, $src_size[0], $src_size[1] );

			if ( imagetypes() & IMG_PNG ) {
				header( 'Content-Disposition: inline; filename="' . str_replace( '.' . $ext, '.png', basename( $_GET['s'] ) ) . '"' );
				header( 'Content-type: image/png' );
				if ( $GENERATE_CACHE ) imagepng( $dest , $CACHE_PATH . $png_thumb_file );
				imagepng( $dest );
			}
			elseif ( imagetypes() & IMG_JPG ) {
				header( 'Content-Disposition: inline; filename="' . str_replace( '.' . $ext, '.jpg', basename( $_GET['s'] ) ) . '"' );
				header( 'Content-type: image/jpeg' );
				if ( $GENERATE_CACHE ) imagejpeg( $dest , $CACHE_PATH . $jpg_thumb_file );
				imagejpeg( $dest );
			}
			else if ( imagetypes() & IMG_GIF ) {
				header( 'Content-Disposition: inline; filename="' . str_replace( '.' . $ext, '.gif', basename( $_GET['s'] ) ) . '"' );
				header( 'Content-type: image/gif' );
				if ( $GENERATE_CACHE ) imagegif( $dest , $CACHE_PATH . $gif_thumb_file );
				imagegif( $dest );
			}
			else {
				$data = readfile( $BROKEN_IMAGE_PATH );
				$dest = imagecreatefromstring( $data );
				header( 'Content-type: image/jpeg' );
				imagejpeg( $dest );
			}
		}
		else {
			$data = readfile( $BROKEN_IMAGE_PATH );
			$dest = imagecreatefromstring( $data );
			header( 'Content-type: image/jpeg' );
			imagejpeg( $dest );
		}
	}
	else print 'GD-library support is not available';
}
else {
	if ( file_exists( $CACHE_PATH . $png_thumb_file ) ) {
		/* use PNG */
		$dest = imagecreatefrompng( $CACHE_PATH . $png_thumb_file );
		header( 'Content-type: image/jpeg' );
		imagejpeg( $dest );
		touch( $CACHE_PATH . $png_thumb_file );
	}
	else if ( file_exists( $CACHE_PATH . $jpg_thumb_file ) ) {
		/* use JPG */
		$dest = imagecreatefromjpeg( $CACHE_PATH . $jpg_thumb_file );
		header( 'Content-type: image/jpeg' );
		imagejpeg( $dest );
		touch( $CACHE_PATH . $jpg_thumb_file );
	}
	else if ( file_exists( $CACHE_PATH . $gif_thumb_file ) ) {
		/* use GIF */
		$dest = imagecreatefromgif( $CACHE_PATH . $gif_thumb_file );
		header( 'Content-type: image/jpeg' );
		imagejpeg( $dest );
		touch( $CACHE_PATH . $gif_thumb_file );
	}
	else {
		$data = readfile( $BROKEN_IMAGE_PATH );
		$dest = imagecreatefromstring( $data );
		header( 'Content-type: image/jpeg' );
		imagejpeg( $dest );
	}
}

/* end buffered output */
ob_end_flush();

/* destroy the buffer of the image in order to free up used memory */
imagedestroy();
?>