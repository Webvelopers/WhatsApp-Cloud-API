<?php

namespace Webvelopers\WhatsAppCloudApi\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Webvelopers\WhatsAppCloudApi\Webhook;

trait WhatsAppRoute
{
    public static function Init(string $routeName = null, string $version = null)
    {
        $routeName = $routeName ?? 'webhook';
        $version = $version ?? 'v1';
        $path = "$version/$routeName";

        Route::get($path, function (Request $request) {
            return (new Webhook)->verifyToken($request->all());
        })->name($routeName . '.verify_token');

        Route::post($path, function (Request $request) {
            return (new Webhook)->notification($request->all());
        });
    }
}
