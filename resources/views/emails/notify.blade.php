<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New comment on your idea post</title>
</head>
<body>
    <h1>New comment on your {{ $title }} post</h1>
    <p>Hi {{ $user->name }},</p>
    <p>You have a new comment on your idea post:</p>
    <p>{{ $comment }}</p>
</body>
</html>