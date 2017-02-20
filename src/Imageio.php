<?php
namespace Tlorentzen\ImageIO;

/**
 * Copyright (C) 2016 Thomas Lorentzen
 */

class Imageio
{
    /**
     * Build imageio url.
     *
     * @param string $path
     * @param mixed $parameters
     * @return string
     */
    public static function make($path=null, $parameters=false)
    {
        if(config('imageio.activated') AND config('imageio.key') != ''){
            $key = config('imageio.key');

            if($parameters === false OR !is_string($parameters)){
                $parameters = 'none';
            }else if(is_array($parameters)){
                
            }
            
            return 'https://imageio.net/static/'.$parameters.'/'.$key.$path;
        }else{
            return $path;
        }
    }
}