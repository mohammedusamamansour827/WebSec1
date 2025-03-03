<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/multable', function () {
    return view('multable');
});
Route::get('/even', function () {
    return view('even');
});
Route::get('/prime', function () {
    return view('prime');
});
Route::get('/bill', function () {
    $bill = (object)[
        "supermarket" => "Carrefour",
        "pos" => "#6578657865",
        "products" => [
            (object)["quantity" => 1, "unit" => "pcs", "name" => "Twix", "price" => 30],
            (object)["quantity" => 2, "unit" => "pcs", "name" => "Snickers", "price" => 25],
            (object)["quantity" => 1, "unit" => "pcs", "name" => "Coca Cola", "price" => 15],
            (object)["quantity" => 3, "unit" => "pcs", "name" => "Bread", "price" => 10],
        ],
    ];

    return view('bill', compact('bill'));
});
Route::get('/calculator', function () {
    $courses = [
        ["code" => "CS101", "title" => "Intro to Programming", "credits" => 3],
        ["code" => "MATH202", "title" => "Calculus II", "credits" => 4],
        ["code" => "PHY301", "title" => "Physics I", "credits" => 3],
        ["code" => "ENG102", "title" => "English Composition", "credits" => 2],
    ];

    return view('calculator', compact('courses'));
});



Route::get('/transcript', function () {
    $student = (object)[
        "name" => "Mohammed Usama",
        "id" => "S123456",
        "major" => "Computer Science",
        "courses" => [
            (object)["code" => "CS101", "title" => "Intro to Programming", "credits" => 3, "grade" => "A"],
            (object)["code" => "MATH202", "title" => "Calculus II", "credits" => 4, "grade" => "B+"],
            (object)["code" => "PHY301", "title" => "Physics I", "credits" => 3, "grade" => "A-"],
            (object)["code" => "ENG102", "title" => "English Composition", "credits" => 2, "grade" => "B"],
        ],
    ];

    return view('transcript', compact('student'));
});

use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// Users CRUD Routes
Route::resource('users', UserController::class);





