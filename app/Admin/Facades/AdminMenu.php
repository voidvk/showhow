<?php
namespace App\Admin\Facades;

use Illuminate\Support\Facades\Facade;

class AdminMenu extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'admin_menu';
    }
}
