<?php
use App\Http\Controllers\Admin\ConfiguracionController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

route::resource('/users', UsersController::class)->names('admin.users')->middleware('can:admin.users.create');
route::resource('configuracion', ConfiguracionController::class)->names('admin.configuracion');
