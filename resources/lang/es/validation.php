<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'Debe ser aceptado', // revisar bien qué es esto...
    'active_url'           => 'URL inválida',
    'after'                => 'Debe ser posterior a :date',
    'after_or_equal'       => 'Debe ser posterior o igual a :date',
    'alpha'                => 'Sólo puede tener letras',
    'alpha_dash'           => 'Sólo puede tener números, letras, y guiones medios y bajos',
    'alpha_num'            => 'Sólo puede tener números y letras',
    'array'                => 'Debe ser un array',
    'before'               => 'Debe ser anterior a :date',
    'before_or_equal'      => 'Debe ser hasta :date inclusive',
    'between' => [
        'numeric' => 'Debe estar entre :min and :max',
        'file'    => 'Debe tener entre :min and :max KB',
        'string'  => 'Debe tener entre :min and :max caracteres',
        'array'   => 'Debe tener entre :min and :max items',
    ],
    'boolean'              => 'Debe ser verdadero ó falso',
    'confirmed'            => 'The :attribute confirmation does not match.',
    'date'                 => 'Debe ser una fecha válida',
    'date_equals'          => 'The :attribute must be a date equal to :date.',
    'date_format'          => 'The :attribute debe tener el siguiente formato: :format.',
    'different'            => 'The :attribute and :other must be different.',
    'digits'               => 'Debe tener :digits digitos',
    'digits_between'       => 'Debe tene entre :min and :max digitos',
    'dimensions'           => 'The :attribute has invalid image dimensions.',
    'distinct'             => 'Ya existe',
    'email'                => 'Debe ser un email válido',
    'ends_with'            => 'Debe terminar con: :values',
    'exists'               => 'No se encontró el registro',
    'file'                 => 'Debe ser un archivo',
    'filled'               => 'Ingrese un valor',
    'image'                => 'Debe ser una imagen',
    'in'                   => 'Valor no válido para :attribute',
    'in_array'             => 'The :attribute field does not exist in :other.',
    'integer'              => 'Debe ser un número',
    'ip'                   => 'Debe ser una dirección IP válida',
    'ipv4'                 => 'Debe ser una dirección IPv4 válida',
    'ipv6'                 => 'Debe ser una dirección IPv6 válida',
    'json'                 => 'Debe ser un JSON válido',
    'lt' => [
        'numeric' => 'Debe ser menor que :value',
        'file'    => 'Debe tener menos de :value KB',
        'string'  => 'Debe tener menos de :value caracteres',
        'array'   => 'Debe tener menos de :value items',
    ],
    'gt' => [
        'numeric' => 'Debe ser mayor que :value',
        'file'    => 'Debe tener más de :value KB',
        'string'  => 'Debe tener más de :value caracteres',
        'array'   => 'Debe tener más de :value items',
    ],
    'lte' => [
        'numeric' => 'No puede ser mayor que :value',
        'file'    => 'No puede tener más de :value KB',
        'string'  => 'No puede tener más de :value caracteres',
        'array'   => 'No puede tener más de :value items',
    ],
    'gte' => [
        'numeric' => 'Debe ser mayor o igual que :value.',
        'file'    => 'Debe tener al menos :value KB',
        'string'  => 'Debe tener al menos :value caracteres',
        'array'   => 'Debe tener al menos :value items',
    ],
    'max' => [
        'numeric' => 'No puede ser mayor que :max',
        'file'    => 'No puede tener más de :max KB',
        'string'  => 'No puede tener más de :max caracteres',
        'array'   => 'No puede tener más de :max items',
    ],
    'min' => [
        'numeric' => 'Debe ser mayor o igual que :min.',
        'file'    => 'Debe tener al menos :min KB',
        'string'  => 'Debe tener al menos :min caracteres',
        'array'   => 'Debe tener al menos :min items',
    ],
    'mimes'                => 'Tipos de archivo permitidos: :values',
    'mimetypes'            => 'Tipos de archivo permitidos: :values',
    'not_in'               => 'Valor inválido',
    'not_regex'            => 'Formato inválido',
    'numeric'              => 'Debe ser un número',
    'password'             => 'Clave incorrecta',
    'present'              => 'Falta un valor para :attribute',
    'regex'                => 'Formato inválido',
    'required'             => 'Obligatorio',
    'required_if'          => 'Obligatorio porque :other es :value.',
    'required_unless'      => 'Obligatorio salvo que :other vale :values.',
    'required_with'        => 'Obligatorio si envía :values',
    'required_with_all'    => 'The :attribute field is required when :values are present.',
    'required_without'     => 'The :attribute field is required when :values is not present.',
    'required_without_all' => 'The :attribute field is required when none of :values are present.',
    'same'                 => ':attribute y :other deben ser iguales',
    'size' => [
        'numeric' => 'The :attribute must be :size.',
        'file'    => 'The :attribute must be :size kilobytes.',
        'string'  => 'The :attribute must be :size characters.',
        'array'   => 'The :attribute must contain :size items.',
    ],
    'starts_with'          => 'Debe comenzar con: :values',
    'string'               => 'Debe ser un texto',
    'timezone'             => 'Debe ser una zona válida',
    'unique'               => 'Ya fué usado',
    'uploaded'             => 'No se pudo obtener el archivo :attribute',
    'url'                  => 'No tiene un formato válido',
    'uuid'                 => 'Debe ser un UUID válido',
    
    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
