<?php namespace Rit\Api;

class Facades extends \Illuminate\Support\Facades\Facade
{
    /**
     * {@inheritDoc}
     */
    protected static function getFacadeAccessor()
    {
        return 'ApiConnection';
    }
}
