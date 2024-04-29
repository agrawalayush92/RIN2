<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
</head>
<body>
    <div>
        <h1>Welcome, {{ $user->name }}</h1>
        <a href="/notifications">
            Notifications
            <span>{{ $user->unread_notifications->count() }}</span>
        </a>
    </div>
</body>
</html>