<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AryiaWith</title>
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> 
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('assets/css/scripts/style.css') }}">
</head>
<body dir="rtl" class="text-gray-600 relative md:static">
    <div id="app"></div>

    @vite('resources/js/app.js')

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>