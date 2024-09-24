<?php
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

route::resource('/users', UsersController::class)->names('admin.users')->middleware('can:admin.users.create');