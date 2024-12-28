<?php

use App\Http\Controllers\Admin\UploadController;
use Illuminate\Support\Facades\Route;

Route::post('/images/upload/{folderName}', [UploadController::class, 'store'])->name('upload.store');
Route::delete('/images/delete/{folderName}', [UploadController::class, 'revert'])->name('upload.destroy');

