<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Yard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#18181b] text-white">
<div class="min-h-screen flex flex-col justify-center items-center px-6">
    
    <img src="{{ asset('images/logo.png') }}" alt="Job Yard Logo" class="w-64 h-64 mb-6">

    <h1 class="text-4xl font-bold text-red-500">Welcome to Job Yard</h1>
    <p class="mt-4 text-lg text-gray-300">Find your dream job today!</p>

    <div class="mt-6 flex space-x-4">
        <a href="{{ route('login') }}" class="px-6 py-2 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-lg shadow">Login</a>
        <a href="{{ route('register') }}" class="px-6 py-2 bg-gray-700 hover:bg-gray-800 text-white font-semibold rounded-lg shadow">Register</a>
        <a href="http://127.0.0.1:8000/admin" class="px-6 py-2 bg-gray-900 hover:bg-gray-800 text-white font-semibold rounded-lg shadow">Admin</a>
    </div>
</div>
</body>
</html>
