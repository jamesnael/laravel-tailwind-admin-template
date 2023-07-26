<?php

use Illuminate\Support\Facades\Route;

if (! function_exists('prepare_main_menu')) {
    function prepare_main_menu() {
        $reservedKeywords = ['.index', '.create', '.edit', '.show', '.detail'];
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

if (! function_exists('get_file_url')) {
    function get_file_url($disk_name = 'public', $file_name) {
        if ($file_name) {
            return Storage::disk($disk_name)->url($file_name);
        }

        return $file_name;
    }
}

if (! function_exists('log_activity')) {
    function log_activity($description, $model, $extra = [], $causer = null, $log_name = null) {
        $properties = [];
        if (is_array($model)) {
            foreach ($model as $key => $value) {
                $properties[] = collect([
                                    'attributes' => $value->getOriginal() ?? null,
                                    'changes' => $value->getChanges() ?? null,
                                ])->merge($extra);
            }
        } else {
            $properties[] = collect([
                                'attributes' => $model->getOriginal() ?? null,
                                'changes' => $model->getChanges() ?? null,
                            ])->merge($extra);
        }

        activity($log_name ?: config('activitylog.default_log_name', 'default'))
            ->by($causer ?: (Auth::user() ?? null))
            ->withProperties($properties)
            ->log($description);
    }
}