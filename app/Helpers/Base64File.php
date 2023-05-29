<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Helpers;

/**
 * Description of Base64File
 *
 * @author salomon
 */
class Base64File
{
    
    protected string $bae64;
    
    public function __construct(string $base64)
    {
        $this->base64 = $base64;
    }
    
    public function getMimeType(): string
    {
        $matches = [];
        preg_match('/data:(.*);base64,(.*)/', substr($this->base64, 0, 128), $matches);
        return $matches[1] ?? '';
    }
    
    public function getBinaryContent(): string
    {
        $matches = [];
        preg_match('/data:(.*);base64,(.*)/', $this->base64, $matches);
        return base64_decode($matches[2] ?? '');
    }
}
