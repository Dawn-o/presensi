<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presence System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100">
    @if (session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded">{{ session('error') }}</div>
    @endif

    @if (session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('presence.store') }}" method="POST">
        @csrf
        <button type="submit" class="bg-blue-500 text-white p-2 rounded">Absen Sekarang</button>
    </form>

</body>

</html>
