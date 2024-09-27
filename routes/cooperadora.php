<?php

use App\Http\Controllers\CooperadoraController;
use Illuminate\Support\Facades\Route;

route::get('pagos/', [CooperadoraController::class, 'index'])->name('cooperadora.pagos.index');
route::put('pagos/{cooperadora}/approve', [CooperadoraController::class, 'approve'])->name('cooperadora.pagos.approve');
route::post('pagos/{cooperadora}/disapprove', [CooperadoraController::class, 'disapprove'])->name('cooperadora.pagos.disapprove');