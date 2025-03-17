<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use App\Models\Question; // ✅ Import Question model
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Web\UsersController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;




Route::get('/', function () {
    return view('welcome');
});

// Pages Routes
Route::get('/multable', function () {
    return view('multable');
});

Route::get('/even', function () {
    return view('even');
});

Route::get('/prime', function () {
    return view('prime');
});

// Supermarket Bill Route
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

// GPA Calculator Route
Route::get('/calculator', function () {
    $courses = [
        ["code" => "CS101", "title" => "Intro to Programming", "credits" => 3],
        ["code" => "MATH202", "title" => "Calculus II", "credits" => 4],
        ["code" => "PHY301", "title" => "Physics I", "credits" => 3],
        ["code" => "ENG102", "title" => "English Composition", "credits" => 2],
    ];
    return view('calculator', compact('courses'));
});

// Student Transcript Route
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

// Users CRUD Routes
Route::resource('users', UserController::class);

// Questions CRUD Routes
Route::resource('questions', QuestionController::class);

// Start Exam Page
Route::get('/exam/start', function () {
    $questions = Question::all();
    return view('exam.start', compact('questions'));
});

// Submit Exam
Route::post('/exam/submit', function (Request $request) {
    $score = 0;
    $questions = Question::all();
    foreach ($questions as $question) {
        if ($request->input("question_{$question->id}") === $question->correct_option) {
            $score++;
        }
    }
    return view('exam.result', compact('score'));
});


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::post('/register', [UsersController::class, 'doRegister'])->name('do_register');



Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{id}', [UserController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/users/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::post('/admin/users/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::post('/admin/users/{id}/change-password', [UserController::class, 'changePassword'])->name('admin.users.change-password');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
});
Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
Route::get('/admin', [AdminController::class, 'index'])->name('admin');

Route::resource('products', ProductController::class);
// Route::get('/products', [ProductController::class, 'list'])->name('products.list');



Route::middleware(['auth'])->group(function () {
    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::resource('tasks', TaskController::class);
});
