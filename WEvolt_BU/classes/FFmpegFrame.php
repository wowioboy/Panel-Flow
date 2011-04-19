<?php     
/**
* FFmpegFrame represents one frame from the movie
* 
* @author char0n (Vladimir Gorej)
* @package FFmpegPHP
* @license New BSD
* @version 1.1
*/
class FFmpegFrame implements Serializable {
    
    protected static $EX_CODE_NO_VALID_RESOURCE = 334563;
    
    /**
    * GdImage resource
    * 
    * @var resource
    */
    protected $gdImage;
    /**
    * Presentation time stamp
    * 
    * @var float
    */
    protected $pts;
    
    /**
    * Create a FFmpegFrame object from a GD image. 
    * 
    * @param resource $gdImage image resource of type gd
    * @param float $pts frame presentation timestamp; OPTIONAL parameter; DEFAULT value 0.0
    * @throws Exception
    * @return FFmpegFrame
    */
    public function __construct($gdImage, $pts = 0.0) {
        if (!(is_resource($gdImage) && get_resource_type($gdImage) == 'gd')) {
            throw new Exception('Param given by constructor is not valid gd resource', self::$EX_CODE_NO_VALID_RESOURCE);
        }
        
        $this->gdImage = $gdImage;
        $this->pts     = $pts;
    }                  
    
    /**
    * Return the width of the frame.
    * 
    * @return int
    */
    public function getWidth() {
        return imagesx($this->gdImage);
    }
    
    /**
    * Return the height of the frame.
    * 
    * @return int
    */
    public function getHeight() {
        return imagesy($this->gdImage);
    }
    
    /**
    * Return the presentation time stamp of the frame; alias $frame->getPresentationTimestamp()
    * 
    * @return float
    */
    public function getPTS() {
        return $this->pts;
    }

    /**
    * Return the presentation time stamp of the frame.    
    * 
    * @return float
    */    
    public function getPresentationTimestamp() {
        return $this->getPTS();
    }
    
    /**
    * Resize and optionally crop the frame. (Cropping is built into ffmpeg resizing so I'm providing it here for completeness.)
    *
    *      * width - New width of the frame (must be an even number).
    *      * height - New height of the frame (must be an even number).
    *      * croptop - Remove [croptop] rows of pixels from the top of the frame.
    *      * cropbottom - Remove [cropbottom] rows of pixels from the bottom of the frame.
    *      * cropleft - Remove [cropleft] rows of pixels from the left of the frame.
    *      * cropright - Remove [cropright] rows of pixels from the right of the frame. 
    *
    *
    * NOTE: Cropping is always applied to the frame before it is resized. Crop values must be even numbers.     
    * 
    * @param int $width
    * @param int $height
    * @param int $cropTop OPTIONAL parameter; DEFAULT value - 0
    * @param int $cropBottom OPTIONAL parameter; DEFAULT value - 0
    * @param int $cropLeft OPTIONAL parameter; DEFAULT value - 0
    * @param int $cropRight OPTIONAL parameter; DEFAULT value - 0
    * @return void
    */
    public function resize($width, $height, $cropTop = 0, $cropBottom = 0, $cropLeft = 0, $cropRight = 0) {        
         $widthCrop     = ($cropLeft + $cropRight);
         $heightCrop    = ($cropTop + $cropBottom);
         $width        -= $widthCrop;
         $height       -= $heightCrop;
         $resizedImage  = imagecreatetruecolor($width, $height);
         
         imagecopyresampled($resizedImage, $this->gdImage, 0, 0, $cropLeft, $cropTop, $width, $height, $this->getWidth() - $widthCrop, $this->getHeight() - $heightCrop);    
         imageconvolution($resizedImage, array(
            array( -1, -1, -1 ),
            array( -1, 24, -1 ),
            array( -1, -1, -1 ),
         ), 16, 0);           
         
         imagedestroy($this->gdImage);
         $this->gdImage = $resizedImage;         
    } 
                                                  
    /**
    * Crop the frame.
    * 
    *      * croptop - Remove [croptop] rows of pixels from the top of the frame.
    *      * cropbottom - Remove [cropbottom] rows of pixels from the bottom of the frame.
    *      * cropleft - Remove [cropleft] rows of pixels from the left of the frame.
    *      * cropright - Remove [cropright] rows of pixels from the right of the frame. 
    *
    * NOTE: Crop values must be even numbers.
    * 
    * @param int $cropTop 
    * @param int $cropBottom OPTIONAL parameter; DEFAULT value - 0
    * @param int $cropLeft OPTIONAL parameter; DEFAULT value - 0
    * @param int $cropRight OPTIONAL parameter; DEFAULT value - 0
    * @return void
    */
    public function crop($cropTop, $cropBottom = 0, $cropLeft = 0, $cropRight = 0) {
        $this->resize($this->getWidth(), $this->getHeight(), $cropTop, $cropBottom, $cropLeft, $cropRight);
    }
    
    /**
    * Returns a truecolor GD image of the frame. 
    *
    * @return resource resource of type gd 
    */
    public function toGDImage() {
        return $this->gdImage;
    }
    
    public function serialize() {
        ob_start();
        imagegd2($this->gdImage);
        $image = base64_encode(ob_get_clean());
        $data  = array(
            $image,
            $this->pts
        );                
        
        return serialize($data);
    }
    
    public function unserialize($serialized) {
        $data = unserialize($serialized);       
        $this->gdImage = imagecreatefromstring(base64_decode($data[0]));
        $this->pts     = $data[1];
    }
    
    public function __clone() {
        ob_start();
        imagegd2($this->gdImage);
        $data = ob_get_clean();
        $this->gdImage = imagecreatefromstring($data);
    }
    
    public function __destruct() {
        if (is_resource($this->gdImage)) {
            imagedestroy($this->gdImage);
        }        
        $this->gdImage = null;
        $this->pts     = null;
    }
}   
?>