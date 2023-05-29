<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Exceptions;

class BusinessException extends \Exception {
    
	private array $errors;

	public function __construct($message = "", array $errors = [], $code = 422, Throwable $previous = null) {
        
		$this->errors = $errors;

		parent::__construct($message, $code, $previous);
	}
    
    public function getErrors(): array {
        return $this->errors;
    }
}

