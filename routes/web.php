<?php

use App\Livewire\Enty;
use App\Livewire\Delivery;
use App\Livewire\PortRate;
use App\Livewire\Received;
use App\Livewire\Register;
use App\Livewire\Dashboard;
use App\Livewire\Assessment;
use App\Livewire\BondLicence;
use App\Livewire\JanataBank;
use App\Livewire\SonaliBank;

use App\Livewire\PortBillGenarate;
use Illuminate\Support\Facades\Route;




Route::get('/', Dashboard::class);
Route::get('/enty', Enty::class);
Route::get('/received', Received::class);
Route::get('/register', Register::class);
Route::get('/assessment', Assessment::class);
Route::get('/delivery', Delivery::class);
Route::get('/port-bill', PortBillGenarate::class);
Route::get('/port-rate', PortRate::class);
Route::get('/janata', JanataBank::class);
Route::get('/sonali', SonaliBank::class);
Route::get('/bond', BondLicence::class);
