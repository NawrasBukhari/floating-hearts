<?php

use Botble\Base\Facades\BaseHelper;
use NawrasBukhari\FloatingHearts\Http\Controllers\FloatingHeartsController;
use Illuminate\Support\Facades\Route;


Route::prefix(BaseHelper::getAdminPrefix() . '/floating-hearts')
    ->name('floating-hearts.settings')
    ->middleware(['core', 'web', 'auth'])
    ->group(function () {
        Route::get('/', [FloatingHeartsController::class, 'edit']);
        Route::put('/', [FloatingHeartsController::class, 'update'])->name('.update');
    });
