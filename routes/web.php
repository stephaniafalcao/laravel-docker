<?php

use App\Domain\Role;
use App\Domain\Permission;
use App\Domain\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/teste', function ()  {
    $permission = new Permission();
    $permission->name = "teste";

    $role = new Role([$permission]);

    $user = new User($role);

    if ($user->getRole()->hasPermission("res")) {
        echo "tem";
    } else {
        echo "não tem";
    }

    //return view('welcome');
});
