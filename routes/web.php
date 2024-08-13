<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;

// Главная страница со списком задач и сортировкой
Route::get('/', [TaskController::class, 'index'])->name('tasks.index');

// Маршруты для регистрации
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

// Маршруты для авторизации
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
Route::post('/login', [AuthController::class, 'login'])->name('login');

// Выход из системы
Route::post('/logout', function () {
    Auth::logout();
    return redirect()->back(); // Возвращаем на предыдущую страницу после выхода
})->name('logout');

// Добавляем маршруты для создания задач
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');

// Добавляем маршруты для редактирования и удаления задач
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
Route::patch('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');

// Закомментированные маршруты для профиля и панели управления
// Если они вам нужны, раскомментируйте и настройте соответствующие контроллеры и Middleware
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
