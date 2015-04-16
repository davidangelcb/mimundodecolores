<?php
function image_createThumb($src,$dest,$maxWidth,$maxHeight,$quality=100) { 
    if (file_exists($src)  && isset($dest)) 
	{
        // informacion del path 
        $destInfo  = pathinfo($dest); 
        
        // tamaño del archivo original
        $srcSize  = getimagesize($src); 
        
        // image dest size $destSize[0] = width, $destSize[1] = height 
        $srcRatio  = $srcSize[0]/$srcSize[1]; // width/height ratio 
        $destRatio = $maxWidth/$maxHeight;
		$destSize = array($srcSize[0],$srcSize[1]);
		
		if(($srcSize[0]>=$maxWidth) and ($srcSize[1]>=$maxHeight))
		{
			if ($destRatio > $srcRatio) { 
				$destSize[0] = $maxHeight*$srcRatio;
				$destSize[1] = $maxHeight;
			} else { 
				$destSize[0] = $maxWidth;
				$destSize[1] = $maxWidth/$srcRatio;
			}
		} else if(($srcSize[0]>$maxWidth) and ($srcSize[1]<=$maxHeight)) {
			$destSize[0] = $maxWidth;
			$destSize[1] = $maxWidth/$srcRatio;
		} else if(($srcSize[0]<=$maxWidth) and ($srcSize[1]>$maxHeight)) {
			$destSize[0] = $maxHeight*$srcRatio;
			$destSize[1] = $maxHeight;
		}
        
        // path rectification 
        /*if ($destInfo['extension'] == "gif") { 
            $dest = substr_replace($dest, 'jpg', -3); 
        }*/
        
        // true color image, with anti-aliasing 
		$destImage = imagecreatetruecolor($destSize[0],$destSize[1]); 
        
        // src image 
        switch ($srcSize[2]) { 
            case 1: //GIF 
            $srcImage = imagecreatefromgif($src); 
            break; 
            
            case 2: //JPEG 
            $srcImage = imagecreatefromjpeg($src); 
            break; 
            
            case 3: //PNG 
            $srcImage = imagecreatefrompng($src); 
            break; 
            
            default: 
            return false; 
            break; 
        } 
        
        // resampling 
        imageCopyResampled($destImage, $srcImage, 0, 0, 0, 0,$destSize[0],$destSize[1],$srcSize[0],$srcSize[1]); 
        
        // generating image 
		$ext = strtolower($destInfo['extension']);
		switch ($ext)
	    {
		    case "gif": 
		    imagegif($destImage,$dest); 
		    break; 
		    
			case "jpeg":
		    case "jpg": 
		    imagejpeg($destImage,$dest,$quality); 
		    break; 
		    
		    case "png": 
		    imagepng($destImage,$dest); 
		    break; 
        }
        return true; 
    } 
    else { 
        return false; 
    } 
}

?>