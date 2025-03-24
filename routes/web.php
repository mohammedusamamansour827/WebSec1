<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\QuestionController;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\QuizController;

// 🏠 Default Home Page
Route::get('/', function () {
    return view('welcome');
});

// 📌 Simple Views
Route::view('/multable', 'multable');
Route::view('/even', 'even');
Route::view('/prime', 'prime');

// 🛒 Supermarket Bill Route
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

// 🎓 GPA Calculator
Route::get('/calculator', function () {
    $courses = [
        ["code" => "CS101", "title" => "Intro to Programming", "credits" => 3],
        ["code" => "MATH202", "title" => "Calculus II", "credits" => 4],
        ["code" => "PHY301", "title" => "Physics I", "credits" => 3],
        ["code" => "ENG102", "title" => "English Composition", "credits" => 2],
    ];
    return view('calculator', compact('courses'));
});

// 📜 Student Transcript
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

// 🔑 Authentication Routes
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::post('/logout', [AuthController::class, 'doLogout'])->name('logout');
Route::get('/register', [AuthController::class, 'login'])->name('register'); // Update if registration is enabled

// 🛠 Profile Routes (Protected)
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');
});

// 🏛 Admin Routes (Protected)
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('/admin/users', UserController::class);
});

// 👥 Users Management
Route::resource('users', UserController::class);

// 📚 Questions CRUD
Route::resource('questions', QuestionController::class);

// 📝 Exam Routes
Route::get('/exam/start', function () {
    $questions = Question::all();
    return view('exam.start', compact('questions'));
});
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

// 🏪 Products Management
Route::resource('products', ProductController::class);
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
});

// ✅ Tasks Management (Only Authenticated Users)
Route::middleware(['auth'])->group(function () {
    Route::resource('tasks', TaskController::class);
});

// 🔑 Dashboard Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard'); // Normal user dashboard
    })->name('dashboard');
});

// 🔑 Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Admin dashboard
    })->name('admin.dashboard');
});


// Password Reset Routes
Route::get('forgot-password', function () {
    return view('auth.forgot-password'); // Make sure this view exists
})->middleware('guest')->name('password.request');

Route::post('forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink($request->only('email'));

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['success' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:6|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password),
            ])->save();
        }
    );

    return $status === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('success', __($status))
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.update');


Route::get('/admin/dashboard', function () {
    return view('admin.dashboard'); // Ensure this file exists
})->name('admin.dashboard')->middleware(['auth', 'admin']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('auth');


Route::middleware(['auth', 'can:manage-users'])->group(function () {
    Route::get('/admin/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard');
});

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard')->middleware('can:manage-users');

Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])
    ->middleware('can:manage-users')
    ->name('admin.dashboard');


    // Route::middleware(['auth', 'can:manage-users'])->group(function () {
    //     Route::get('/users', [UserController::class, 'index'])->name('users.index');
    // });

    Route::middleware(['auth'])->group(function () {
        Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');

        // Instructor Routes
        Route::middleware('can:isInstructor')->group(function () {
            Route::get('/quizzes/create', [QuizController::class, 'create'])->name('quizzes.create');
            Route::post('/quizzes', [QuizController::class, 'store'])->name('quizzes.store');
        });

        // Student Answer Submission
        Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submitAnswer'])->name('quizzes.submit');
    });

    Route::middleware(['auth'])->group(function () {
        Route::resource('quizzes', QuizController::class);
        Route::get('submissions', [QuizController::class, 'mySubmissions'])->name('submissions.index');
        Route::get('profile/{user}', [UserController::class, 'show'])->name('profile.show');
    });


    Route::middleware(['auth'])->group(function () {
        Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
    });


    Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
    Route::get('/quizzes/{quiz}/edit', [QuizController::class, 'edit'])->name('quizzes.edit');


