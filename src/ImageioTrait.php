<?php

namespace Tlorentzen\ImageIO;



/**
 * Copyright (C) 2016 Thomas Lorentzen
 */

trait ImageioTrait
{
    use Tlorentzen\ImageIO\ImageioParameterTrait;
    
    public function make($path)
    {
        return Tlorentzen\ImageIO\Imageio::make($path, $this->build());
    }

}