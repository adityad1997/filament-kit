<?php

namespace Adityad1997\FilamentKit;

use Adityad1997\FilamentKit\Select\PrefillCreateOptionFromSearch;
use Illuminate\Support\ServiceProvider;

class FilamentKitServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        PrefillCreateOptionFromSearch::register();
    }
}
