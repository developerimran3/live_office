<?php

use App\Livewire\Assessment;
use App\Livewire\Dashboard;
use App\Livewire\Delivery;
use App\Livewire\Enty;
use App\Livewire\Received;
use App\Livewire\Register;
use Illuminate\Support\Facades\Route;




Route::get('/', Dashboard::class);
Route::get('/enty', Enty::class);
Route::get('/received', Received::class);
Route::get('/register', Register::class);
Route::get('/assessment', Assessment::class);
Route::get('/delivery', Delivery::class);
