<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New comments are posted</title>
</head>
<body style="font-family: sans-serif;">
    <div style="display: block; margin: auto; max-width: 600px;" class="main">
        <h1 style="font-size: 18px; font-weight: bold; margin-top: 20px">New comment on your {{ $title }} post</h1>
        <p>Hi, {{ $name }},</p>
        <p>You have a new comment on your idea post</p>
        <p>"{{ $comment }}"</p>
    </div>
</body>
</html>