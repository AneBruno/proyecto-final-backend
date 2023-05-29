<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Factories;

use App\Services\ModelFilesService;
use Illuminate\Database\Eloquent\Model;

/**
 * Description of ModelFilesServiceFactory
 *
 * @author salomon
 */
class ModelFilesServiceFactory
{
    
    static public function create(Model $model, string $suffix = 'default'): ModelFilesService
    {
        $instance = new ModelFilesService($model->getTable());
        $instance->setSuffix($suffix);
        return $instance;
    }
}
