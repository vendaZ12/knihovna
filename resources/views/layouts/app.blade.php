<!-- resources/views/layouts/app.blade.php -->

<!DOCTYPE html>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vítejte v knihovně</title>

    <!-- Případně přidat CSS soubory -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">

</head>

<body>
    <header>

    </header>

    <main>
        @yield('content')
    </main>

</body>

</html>
