<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>An idea has posted from your department</title>
</head>
<body style="font-family: sans-serif;">
    <div style="display: block; margin: auto; max-width: 600px;" class="main">
        <h1 style="font-size: 18px; font-weight: bold; margin-top: 20px">An idea has posted from your department</h1>
        <p>Hello, {{ $coordinator->full_name }}</p>
        <div>
            <p>Idea: {{ $idea->title }},</p>
            @if ($idea->image)
                <img src="{{ $idea->image }}" alt="">
            @endif
        </div>
        <p>Posted by: {{ $user->full_name }}</p>
    </div>
</body>
</html>