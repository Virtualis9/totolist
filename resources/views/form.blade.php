<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Create Task</title>
</head>
<body>

    <h1>Create Task</h1>

    <form action="{{ route('tasks.store') }}" method="POST">
        @csrf <!-- This is the CSRF token -->
        <div>
            <label for="title">title</label>
            <input type="text" name="title" placeholder="Task title" required><br>
        </div>

        <div>
            <label for="description">description</label>
            <textarea name="description" placeholder="Task description" rows="5" required></textarea>
        </div>

        <div>
            <label for="long_description">long description</label>
            <textarea name="long_description" placeholder="Task description" rows="5" required></textarea>
        </div>
        
        <button type="submit">Submit</button>
        
    </form>

</body>
</html>

