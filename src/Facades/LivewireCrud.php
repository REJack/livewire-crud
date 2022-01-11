<?php

namespace REJack\LivewireCrud\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \REJack\LivewireCrud\LivewireCrud
 */
class LivewireCrud extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'livewire-crud';
    }
}
