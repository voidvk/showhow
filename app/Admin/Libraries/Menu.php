<?php

namespace App\Admin\Libraries;

class Menu
{
    public $active_menu = 'courses';

    public function setActive($menu)
    {
        $this->active_menu = $menu;
    }

    public function getList(): array
    {
        return [
            'authors' => [
                'route' => 'admin.authors.index',
                'icon' => 'fa-users',
                'name' => 'Авторы'
            ],
        ];
    }

    public function generate(): string
    {
        $result = '';
        foreach ($this->getList() as $key => $item) {
            $main_class = [];
            if ($key == $this->active_menu) {
                $main_class[] = 'active';
            }
            $url = '#';
            if ($route = array_get($item, 'route', false)) {
                $url = lang_route($route);
            }
            $name = '<span>' . $item['name'] . '</span>';
            if ($icon = array_get($item, 'icon', false)) {
                $name = '<i class="fa ' . $icon . '"></i> ' . $name;
            }
            $sub_content = '';
            if ($sub_items = array_get($item, 'items', false)) {
                $main_class[] = 'treeview';
                $active = false;
                //TODO тут получаеться 2 уровня только учтено, для того что бы было больше уровней лучше наверное сделать отдельную функцию и
                //TODO всё можно ещё реализовать посредством класс Html в котором будет храниться например tag, content, class, after, before и в оконцове генерировать html tag
                foreach ($sub_items as $sub_key => $sub_item) {
                    $url_sub = '#';
                    $sub_class = [];
                    if ($sub_key == $this->active_menu) {
                        $main_class[] = 'active';
                        $sub_class[] = 'active';
                    }
                    if ($route = array_get($sub_item, 'route', false)) {
                        $url_sub = lang_route($route);
                    }
                    $name_sub = $sub_item['name'];
                    if ($icon = array_get($sub_item, 'icon', false)) {
                        $name_sub = '<i class="fa ' . $icon . '"></i> ' . $name;
                    }
                    $sub_content .= '<li class="' . implode(' ', $sub_class) . '"><a href="' . $url_sub . '">' . $name_sub . '</a></li>';
                }
                $sub_content = '<ul class="treeview-menu">' . $sub_content . '</ul>';
                $name .= '<span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>';
                if ($active == true) {
                    $main_class[] = 'active';
                }
            }
            $result .= '<li class="' . implode(' ', $main_class) . '"><a href="' . $url . '">' . $name . '</a>' . $sub_content . '</li>';
        }
        return $result;
    }

}
