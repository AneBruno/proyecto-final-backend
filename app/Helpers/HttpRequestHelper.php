<?php

namespace App\Helpers;

use App\Tools\ModelRepository;
use Illuminate\Http\Request;

class HttpRequestHelper
{
    /**
     * @param Request $request
     * @return array|false|string[]
     */
    static public function getModelRelation(Request $request): array
    {
        $with = $request->get('with_relation', null);

        $relations = (strpos($with, ",") != false || !is_null($with)) ? explode(',', $with) : [];

        return $relations;
    }
}
