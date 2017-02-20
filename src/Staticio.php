<?php
namespace Tlorentzen\StaticIO;

/**
 * Copyright (C) 2017 Thomas Lorentzen
 */

class Staticio
{

    private $parameters = array();

    /**
     * Grayscale image.
     *
     * @param boolean $value
     * @return void
     */
    public function grayscale($value=true){
        if(is_bool($value)){
            $this->setParam('grey', $value);
        }
    }

    /**
     * Invert image.
     *
     * @param boolean $value
     * @return void
     */
    public function invert($value=true){
        if(is_bool($value)){
            $this->setParam('invert', $value);
        }
    }

    /**
     * Pixelate image with a given pixel size.
     *
     * @param integer $value
     * @return void
     */
    public function pixelate($value){
        if($value > 0 AND (is_integer($value) OR ctype_digit($value))){
            $this->setParam('pixelate', $value);
        }
    }

    /**
     * Set image contrast level.
     *
     * @param integer $value
     * @return void
     */
    public function contrast($value)
    {
        if(is_integer($value) OR ctype_digit($value)){
            if($value < -100){
                $value = -100;
            }

            if($value > 100){
                $value = 100;
            }

            $this->setParam('contrast', $value);
        }
    }

    /**
     * Set image brightness level.
     *
     * @param integer $value
     * @return void
     */
    public function brightness($value)
    {
        if(is_integer($value) OR ctype_digit($value)){
            if($value < -100){
                $value = -100;
            }

            if($value > 100){
                $value = 100;
            }

            $this->setParam('brightness', $value);
        }
    }

    /**
     * Sharpen image.
     *
     * @param integer $value
     * @return void
     */
    public function sharpen($value)
    {
        if(is_integer($value) OR ctype_digit($value)){
            if($value < 0){
                $value = 0;
            }

            if($value > 100){
                $value = 100;
            }

            $this->setParam('sharpen', $value);
        }
    }

    /**
     * Blur the image.
     *
     * @param integer $value
     * @return void
     */
    public function blur($value)
    {
        if(is_integer($value) OR ctype_digit($value)){
            if($value < 0){
                $value = 0;
            }

            if($value > 100){
                $value = 100;
            }

            $this->setParam('blur', $value);
        }
    }

    /**
     * Set image quality (Default 90).
     *
     * @param integer $value
     * @return void
     */
    public function quality($value)
    {
        if(is_integer($value) OR ctype_digit($value)){
            if($value < 0){
                $value = 0;
            }

            if($value > 100){
                $value = 100;
            }

            $this->setParam('quality', $value);
        }
    }

    /**
     * Rotate image by a given angel.
     *
     * @param integer $value
     * @return void
     */
    public function rotate($value){
        if(is_integer($value) OR ctype_digit($value)){
            if($value < -360){
                $value = -360;
            }

            if($value > 360){
                $value = 360;
            }

            $this->setParam('rotate', $value);
        }
    }

    /**
     * Switch colors in the picture using RGB color values (255 values only).
     *
     * @param integer $red
     * @param integer $green
     * @param integer $blue
     * @return void
     */
    public function colorize($red, $green, $blue){
        if((is_integer($red) OR ctype_digit($red)) AND (is_integer($green) OR ctype_digit($green)) AND (is_integer($blue) OR ctype_digit($blue))){
            $colors[] = $red;
            $colors[] = $green;
            $colors[] = $blue;

            foreach ($colors AS $index => $value){
                if($value < -255){
                    $colors[$index] = -255;
                }
                if($value > 255){
                    $colors[$index] = 255;
                }
            }

            $this->setParam('colorize', $colors);
        }
    }

    /**
     * Returning a valid parameter string.
     *
     * @return string
     */
    public function build()
    {
        $parameters = "";

        if(count($this->parameters) > 0){

            foreach($this->parameters AS $key => $value)
            {
                if(is_null($value) || $value == '' || $value == 0 || $value == false){
                    unset($this->parameters[$key]);
                }
            }

            $parameters .= implode('.', array_map(
                function ($v, $k) {
                    if(is_array($v)){
                        return $k.implode(',', $v);
                    }else{
                        return $k.$v;
                    }
                },
                $this->parameters,
                array_keys($this->parameters)
            ));
        }

        if($parameters == ''){
            $parameters = 'none';
        }

        return $parameters;
    }


    private function setParam($key, $value){
        if($value == 0 OR $value == false){
            $this->removeParam($key);
        }else{
            $this->parameters[$key] = $value;
        }
    }

    private function removeParam($key){
        if(array_key_exists($key, $this->parameters)){
            unset($this->parameters[$key]);
        }
    }

    public static function getImage($path=null, $width=null, $height=null, $parameters=false)
    {
        if(config('staticio.activated')){

            if(is_integer($width) AND is_integer($height)){
                $size = 'fit'.$width.'x'.$height.'.';
            }elseif(is_integer($width) AND $height == null){
                $size = 'width'.$width.'.';
            }elseif(is_integer($height) AND $width == null){
                $size = 'height'.$height.'.';
            }else{
                $size = '';
            }

            if($parameters === false OR (!is_string($parameters) OR !is_array($parameters))){
                $parameters = 'none';
            }else if(is_array($parameters)){
                $parameters = implode(".", $parameters);
            }
            
            return 'https://staticio.net/static/'.$size.$parameters.'/'.self::getDomain().$path;
        }else{
            return $path;
        }
    }

    public static function getTextFile($path, $minify=false)
    {
        if(config('staticio.activated')){

            if($minify){
                $parameters = 'minify';
            }else{
                $parameters = 'none';
            }

            return 'https://staticio.net/static/'.$parameters.'/'.self::getDomain().$path;

        }else{
            return $path;
        }
    }

    private static function getDomain(){
        return str_replace(array('http://','https://','/'), '', config('staticio.domain'));
    }
}