<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('generateqr'))
{
    //=========验证码函数
	/**
	*@param $width int 验证码宽度
	*@param $height int 验证码高度
	*@param $num int 验证码显示个数
	*@param $size int 验证码字体大小
	*@return 返回验证码
	*/
	function generateqr($width=0,$height=0,$num=4,$size=20){
		//未给定宽高设定默认值
		if(empty($width)){
			$width = $num * $size +20;
		}
		if(empty($height)){
			$height = $size+20;
		}
		//固定验证码范围
		$img = imagecreatetruecolor($width,$height);
		//定义背景颜色imagecolorallocate ( resource $image , int $red , int $green , int $blue )
		$backcolor = imagecolorallocatealpha($img,218,218,218,30);
		//其他颜色
		$black = imagecolorallocate($img,0,0,0);
		$bordercolor = imagecolorallocate($img,135,64,64);
		$pointcolor = imagecolorallocate($img,mt_rand(0,0),mt_rand(0,255),mt_rand(0,255));
		$linecolor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,255),mt_rand(0,0));
		$charcolor = imagecolorallocate($img,mt_rand(0,155),mt_rand(0,155),mt_rand(0,255));
		$textcolor = imagecolorallocate($img,mt_rand(0,255),mt_rand(0,0),mt_rand(0,255));
		//画矩形并填充
		//imagefilledrectangle ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )0,0是左上角
		imagefilledrectangle($img,0,0,$width,$height,$backcolor);
		//边框
		//imagerectangle ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $col )
		imagerectangle($img,0,0,$width-1,$height-1,$bordercolor);
		//干扰点
		//imagesetpixel ( resource $image , int $x , int $y , int $color )
		for($i=0;$i<$size*10;$i++){
			imagesetpixel($img,mt_rand(0,$width),mt_rand(0,$height),$pointcolor);
		}
		//干扰弧线
		// imagearc ( resource $image , int $cx , int $cy , int $w , int $h , int $s , int $e , int $color )
		for($i=0;$i<$size/2;$i++){
			imagearc($img,mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),mt_rand(0,360),mt_rand(0,360),$linecolor);
		}
		/* 画一条虚线，5 个红色像素，5 个白色像素 */
		//画虚线imagedashedline ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
		$w    =  imagecolorallocate ( $img ,  255 ,  255 ,  255 );
		$red  =  imagecolorallocate ( $img ,  255 ,  0 ,  0 );
		$style  = array( $red ,  $red ,  $red ,  $red ,  $red ,  $w ,  $w ,  $w ,  $w ,  $w );
		imagesetstyle ( $img ,  $style );
		imageline ( $img , mt_rand(0,$width) ,  0 ,  mt_rand(0,$width) ,  mt_rand(0,$height) ,  IMG_COLOR_STYLED );
		//实线imageline ( resource $image , int $x1 , int $y1 , int $x2 , int $y2 , int $color )
		imageline($img,mt_rand(0,$width/2),mt_rand(0,$height),mt_rand(0,$width),mt_rand(0,$height),$black);
		//划单个字符
		//水平imagechar ( resource $image , int $font , int $x , int $y , string $c , int $color )
		//垂直imagecharup ( resource $image , int $font , int $x , int $y , string $c , int $color )
		imagechar($img,5,mt_rand(0,$width),mt_rand(0,$height/2+5),"(",$charcolor);
		imagecharup($img,5,mt_rand(0,$width),mt_rand(0,$height/2+5),")",$charcolor);
		//画一串字符
		//水平imagestring ( resource $image , int $font , int $x , int $y , string $s , int $col )
		//垂直imagestringup ( resource $image , int $font , int $x , int $y , string $s , int $col )
		// imagestring($img,2,mt_rand(0,$width),mt_rand(0,$height/2),"hello",$charcolor);
		// imagestringup($img,2,mt_rand(0,$width),mt_rand(0,$height),"world",$black);
		//imagesettile — 设定用于填充的贴图（待定！）
		//imagelayereffect — 设定 alpha 混色标志以使用绑定的 libgd 分层效果
		imagelayereffect ( $img ,  IMG_EFFECT_OVERLAY );

		//验证码
		//imagefttext ( resource $image , float $size , float $angle , int $x , int $y , int $color , string $fontfile , string $text [, array $extrainfo ] )
		$font =str_replace( '\\' , '/' , realpath(dirname(__FILE__).'/../../'))."/public/common/bower_components/bootstrap/fonts/consola.ttf";
		$str = "23456789abcdefghijkmnpqrstuvwxyzABCDEFGHIJKLMNPQRSTUVWXYZ";//防止用户看错不设置0 o l 1
		$code = "";
		for($i=0;$i<$num;$i++){
			$code .= $str[mt_rand(0,strlen($str)-1)];//像数组一样访问值，默认从0开始，所以要减1
		}
		imagefttext($img,$size,0,10,$height/2+12,$textcolor,$font,$code);
		//将验证码存于session，便于后台验证
		$_SESSION['vcode'] = strtolower($code);
		//浏览器申明输出图片，非html
		header("Cache-Control: max-age=1, s-maxage=1, no-cache, must-revalidate"); 
		header("Content-type: image/png;charset=utf8");//header默认采用html格式输出 
		//合成并生成验证码imagepng ( resource $image [, string $filename ] )
		imagepng($img);
		//销毁图片缓存资源
		imagedestroy($img);

	}
}