<?php

namespace App\Utils;

class UrlGenerator
{
    public static function asset_url($fileType, $filename) {
        switch ($fileType) {
            case 'public-css':
                $manifestPath = 'assets/public/css/rev-manifest-css.json';
                $filesPath = '/assets/public/css/';
                break;
            case 'public-js':
                $manifestPath = 'assets/public/js/rev-manifest-js.json';
                $filesPath = '/assets/public/js/';
                break;
            case 'common-css':
                $manifestPath = 'assets/common/css/rev-manifest-css.json';
                $filesPath = '/assets/common/css/';
                break;
            case 'common-js':
                $manifestPath = 'assets/common/js/rev-manifest-js.json';
                $filesPath = '/assets/common/js/';
                break;
            case 'admin-css':
                $manifestPath = 'assets/admin/css/rev-manifest-css.json';
                $filesPath = '/assets/admin/css/';
                break;
            case 'admin-js':
                $manifestPath = 'assets/admin/js/rev-manifest-js.json';
                $filesPath = '/assets/admin/js/';
                break;
        }
        if (getenv('CI_ENVIRONMENT') == "production" && file_exists($manifestPath)) {
            $manifest = json_decode(file_get_contents($manifestPath), true);
            if (isset($manifest[$filename])) {
                return base_url($filesPath . $manifest[$filename]);
            }
        }
        return base_url($filesPath . $filename);
    }
}
