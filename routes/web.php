<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;
use App\Livewire\Tasks;
use App\Livewire\TaskCategories;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('dashboard', DashboardController::class)->name('dashboard');

    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    Route::get('tasks', Tasks\Index::class)->name('tasks.index');
    Route::get('tasks/create', Tasks\Create::class)->name('tasks.create');
    Route::get('tasks/{task}/edit', Tasks\Edit::class)->name('tasks.edit');

    Route::get('task-categories', TaskCategories\Index::class)->name('task-categories.index');
    Route::get('task-categories/create', TaskCategories\Create::class)->name('task-categories.create');
    Route::get('task-categories/{taskCategory}/edit', TaskCategories\Edit::class)->name('task-categories.edit');
});

require __DIR__.'/auth.php';
