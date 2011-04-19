<?php
/*
 *
 *    => Example Start
 *
 */
include "resizeImage.class.php";
/*
 *
 *    => Class constructor
 *
 */
$resizeimage = new resizeImage;
/*
 *
 *    => Add image path and new thumb size
 *
 */
$image = $resizeimage -> process ( $_GET['image'], isset ( $_GET [ 'thumb' ] ) ? $_GET [ 'thumb' ] : 90 );
/*
 *
 *    => Set image header
 *
 */
header ( 'Content-type:image/jpeg' );
/*
 *
 *    => Create image
 *
 */
imageJpeg ( $image );
/*
 *
 *    => Destroy image
 *
 */
imageDestroy ( $image );
/*
 *
 *    => Example End
 *
 */
?> 