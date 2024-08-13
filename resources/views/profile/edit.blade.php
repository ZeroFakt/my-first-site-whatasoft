<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Редактирование профиля</title>
</head>
<body>
    <h1>Редактирование профиля</h1>

    @if (session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div>
            <label for="first_name">Имя:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
            @error('first_name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="last_name">Фамилия:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
            @error('last_name')
                <div style="color: red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <button type="submit">Сохранить изменения</button>
        </div>
    </form>

    <br>
    <a href="{{ route('tasks.index') }}">Назад к списку задач</a>
</body>
</html>
