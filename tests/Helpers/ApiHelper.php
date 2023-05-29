<?php

namespace Tests\Helpers;

/**
 * Class ApiHelper
 * @package Tests\Helpers
 * @codeCoverageIgnore
 */
class ApiHelper
{
    protected const API_PREFIX = '/api/v1';

    /**
     * @param string $resource
     * @return string
     */
    public static function buildUrlFor(string $resource): string
    {
        return self::API_PREFIX . '/' . $resource;
    }
}