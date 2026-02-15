<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Livewire Assets URL
    |--------------------------------------------------------------------------
    |
    | This value sets the path to the Livewire JavaScript assets. By default,
    | Livewire will load its JavaScript assets from the package's public directory.
    |
    */

    'asset_url' => env('LIVEWIRE_ASSET_URL', null),

    /*
    |--------------------------------------------------------------------------
    | Livewire Endpoint
    |--------------------------------------------------------------------------
    |
    | This value sets the endpoint where Livewire requests are sent. By default,
    | Livewire will use the '/livewire' endpoint.
    |
    */

    'endpoint' => env('LIVEWIRE_ENDPOINT', '/livewire'),

    /*
    |--------------------------------------------------------------------------
    | Layout
    |--------------------------------------------------------------------------
    |
    | The view that will be used as the layout when rendering a Livewire component.
    |
    */

    'layout' => 'components.layouts.app',

    /*
    |--------------------------------------------------------------------------
    | Lazy Loading
    |--------------------------------------------------------------------------
    |
    | By default, Livewire will lazy load components that are out of view.
    |
    */

    'lazy' => [
        'placeholder' => null,
        'on_load' => false,
    ],

    /*
    |--------------------------------------------------------------------------
    | Temporary File Uploads
    |--------------------------------------------------------------------------
    |
    | Livewire handles file uploads by storing temporary files in a directory.
    |
    */

    'temporary_file_upload' => [
        'disk' => null,
        'rules' => null,
        'directory' => 'livewire-tmp',
        'middleware' => null,
        'max_upload' => 102400, // 100MB
    ],

    /*
    |--------------------------------------------------------------------------
    | Render On Redirect
    |--------------------------------------------------------------------------
    |
    | By default, Livewire will render the component before redirecting.
    |
    */

    'render_on_redirect' => false,

    /*
    |--------------------------------------------------------------------------
    | Navigate
    |--------------------------------------------------------------------------
    |
    | By default, Livewire will use page navigation for links with wire:navigate.
    |
    */

    'navigate' => [
        'show_progress_bar' => true,
        'progress_bar_color' => '#2299dd',
    ],
];
