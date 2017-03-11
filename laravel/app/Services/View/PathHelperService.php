<?php

namespace App\Services\View;

use Illuminate\Support\Facades\Request;

class PathHelperService
{

    public function isActivePath($paths) {
        if(is_array($paths)) {
            foreach ($paths as $path) {
                if(Request::is($path)) {
                    return "active";
                }
            }
            return "";
        } else {
            return Request::is($paths) ? "active" : "";
        }
    }

}