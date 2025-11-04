<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Aquí puedes agregar las rutas de la API, por ejemplo:
Route::get('/example', function () {
    return response()->json(['message' => 'Hello, World!']);
});
