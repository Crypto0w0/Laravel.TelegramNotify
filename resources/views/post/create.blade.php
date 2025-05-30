<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Блог</title>
</head>
<body>
<div class="container">
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <h1>Створити пост</h1>

    <form method="POST" action="{{ route('post.store') }}">
        @csrf

        <div>
            <label for="title">Заголовок</label><br>
            <input id="title" name="title" type="text" value="{{ old('title') }}" required>
            @error('title')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="content">Контент</label><br>
            <textarea id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
            @error('content')
                <div style="color:red;">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit">Зберегти</button>
    </form>
</div>
</body>
</html>