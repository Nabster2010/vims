<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Inspection Report' }}</title>

    <link rel="stylesheet" href="{{ asset('css/report.css') }}">

</head>

<body>

    {{ $slot }}

</body>

</html>
