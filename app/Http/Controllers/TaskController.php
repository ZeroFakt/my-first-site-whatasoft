<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    // Отображение списка задач с возможностью сортировки
    public function index(Request $request)
    {
        $sort = $request->query('sort', 'id'); // Получаем параметр сортировки из запроса, по умолчанию сортируем по id
        $tasks = Task::orderBy($sort)->get(); // Сортировка по указанному параметру

        return view('welcome', ['tasks' => $tasks, 'sort' => $sort]);
    }

    // Отображение формы создания задачи
    public function create()
    {
        return view('tasks.create');
    }

    // Сохранение новой задачи
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'difficulty' => 'required|integer|min:1|max:5',
        ]);

        Task::create($validated);

        return redirect('/')->with('success', 'Задача успешно добавлена!');
    }

    // Отображение формы редактирования задачи
    public function edit(Task $task)
    {
        return view('tasks.edit', ['task' => $task]);
    }

    // Обновление задачи
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:50',
            'description' => 'required|string',
            'difficulty' => 'required|integer|min:1|max:5',
        ]);

        $task->update($validated);

        return redirect('/')->with('success', 'Задача успешно обновлена!');
    }

    // Удаление задачи с подтверждением
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect('/')->with('success', 'Задача успешно удалена!');
    }
}
