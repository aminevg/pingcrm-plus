<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = "app";

    /**
     * Determine the current asset version.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        return array_merge(parent::share($request), [
            "auth" => [
                "user" => $request->user()
                    ? [
                        "id" => $request->user()->id,
                        "name" => $request->user()->name,
                        "email" => $request->user()->email,
                        "deleted_at" => $request->user()->deleted_at,
                        "photo" => $request->user()->photo_path
                            ? route("image", [
                                "path" => $request->user()->photo_path,
                                "w" => 48,
                                "h" => 48,
                                "fit" => "crop",
                            ])
                            : null,
                    ]
                    : null,
            ],
            "ziggy" => function () use ($request) {
                return array_merge((new Ziggy())->toArray(), [
                    "location" => $request->url(),
                ]);
            },
            "flash" => function () use ($request) {
                return [
                    "success" => $request->session()->get("success"),
                    "error" => $request->session()->get("error"),
                ];
            },
        ]);
    }
}
