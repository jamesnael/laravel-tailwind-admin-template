<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('prepare_main_menu')) {
    function prepare_main_menu() {
        $reservedKeywords = ['.index', '.create', '.edit', '.show'];
        $main_menu = collect(config('main-menu.menu'));
        $currentRoute = str_replace_multiple($reservedKeywords, '', Route::currentRouteName());
        $main_menu->transform(function($menu) use ($currentRoute, $reservedKeywords) {
            if ($menu['type'] == 'menu') {
                if ($menu['children'] == null || count($menu['children']) == 0) {
                    $menu['active'] = str_replace_multiple($reservedKeywords, '', $menu['route']) == $currentRoute;
                } else {
                    $child = collect($menu['children'])->map(function($item) use ($reservedKeywords) {
                        $item['route'] = str_replace_multiple($reservedKeywords, '', $item['route']);
                        return $item;
                    });
                    $exist = $child->where('route', $currentRoute)->first();
                    if ($exist) {
                        $menu['active'] = true;
                        $menu['open'] = true;
                        $menu['children'] = collect($menu['children'])->transform(function($submenu) use ($currentRoute, $reservedKeywords) {
                            if ($submenu['type'] == 'menu') {
                                $submenu['active'] = str_replace_multiple($reservedKeywords, '', $submenu['route']) == $currentRoute;
                            }
                            return $submenu;
                        });
                    }
                }
            }
            return $menu;
        });
        return $main_menu;
    }
}

if (! function_exists('str_replace_multiple')) {
    function str_replace_multiple(array $search, $replace, $string) {
        foreach ($search as $term) {
            $string = str_replace($term, $replace, $string);
        }
        return $string;
    }
}

if (! function_exists('response_json')) {
    function response_json($success = false, $error = null, $message = '', $data = null, array $misc = [])
    {
        $response = [
            'success' => $success,
            'error' => $error,
            'message' => $message
        ];

        $response['data'] = $data;

        $response = collect($response)->merge($misc);

        return response()->json($response);
    }
}

if (! function_exists('format_money')) {
    function format_money($value=0, $showZero = true)
    {
        if ($showZero) {
            return number_format($value, 0, ',', '.');
        }
        return $value > 0 ? number_format($value, 0, ',', '.') : null;
    }
}