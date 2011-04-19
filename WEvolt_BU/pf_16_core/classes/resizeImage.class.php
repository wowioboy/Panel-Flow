<?php
Class resizeImage {
    var $null = NULL;
    /*
     *
     * Class resizeImage ( )
     *
     */
    function resizeImage ( ) {/* Contructor */}
    /*
     *
     * Public: process ( )
     *
     */
    function process ( $url, $thumb ) {
        if ( $tmp0 = imageCreateFromString ( fread ( fopen ( $url, "rb" ) , filesize ( $url ) ) ) ) {
            if ( imageSy ( $tmp0 ) > imageSx ( $tmp0 ) ) {
                $dim = Array ( 'w' => round ( imageSx ( $tmp0 ) * $thumb / imageSy ( $tmp0 ) ), 'h' => $thumb );
            }
            else {
                $dim = Array ( 'w' => $thumb, 'h' => round ( imageSy ( $tmp0 ) * $thumb / imageSx ( $tmp0 ) ) );
            }
            $tmp1 = imageCreateTrueColor ( $dim [ 'w' ], $dim [ 'h' ] );
            if (
                    imagecopyresized  ( $tmp1 , $tmp0, 0, 0, 0, 0, $dim [ 'w' ],
                    $dim [ 'h' ], imageSx ( $tmp0 ), imageSy ( $tmp0 ) )
                ) {
                imageDestroy ( $tmp0 );
                return $tmp1;
            }
            else {
                imageDestroy ( $tmp0 );
                imageDestroy ( $tmp1 );

                return $this -> null;
            }
        }
        else {

            return $this -> null;
        }
    }
}
?> 