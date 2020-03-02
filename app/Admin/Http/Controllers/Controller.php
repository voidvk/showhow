<?php

namespace App\Admin\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    protected $controller_name = false;
    public function __construct()
    {

        \SEO::init(false, [
            'title'       => 'Панель управление',
            'description' => '',
            'keywords'    => '',
        ]);
        \Assets::config([
            'js_dir'  => '',
            'css_dir' => ''
        ]);
        $this->controller_name = $this->controllerName();
        \AdminMenu::setActive($this->controller_name);
        view()->share('controller_name', $this->controller_name);
    }
    protected function controllerName()
    {
        if ($this->controller_name === false) {
            if (\Route::getCurrentRoute() && preg_match('/\.([a-z\-]*)\..*$/i', \Route::getCurrentRoute()->getName(), $matches)) {
                $this->controller_name = $matches[1];
            } else {
                $this->controller_name = '';
            }
        }
        return $this->controller_name;
    }
}
