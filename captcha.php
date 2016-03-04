<?php
	function getRandomWord($len = 5) {
		$word = array_merge(range('a', 'z'), range('A', 'Z'),range('0','9'));
		shuffle($word);
		return substr(implode($word), 0, $len);
	}

	@ session_start();
	$_SESSION['captcha']= getRandomWord();


	$my_img = imagecreate( 360, 75 );
	$background = imagecolorallocate( $my_img, 50, 0, 255 );
	$text_colour = imagecolorallocate( $my_img, 255 , 255, 255 );
	$line_colour = imagecolorallocate( $my_img, 128, 150, 0 );
	imagestring( $my_img, 4, 30, 25, $_SESSION['captcha'], $text_colour );
	imagesetthickness ( $my_img, 2 );
	imageline( $my_img, 30, 45, 165, 45, $line_colour );

	header( "Content-type: image/png" );
	imagepng( $my_img );
	imagecolordeallocate( $line_color );
	imagecolordeallocate( $text_color );
	imagecolordeallocate( $background );
	imagedestroy( $my_img );
?>