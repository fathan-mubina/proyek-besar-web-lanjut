<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F3F0D7] min-h-screen flex items-center justify-center">

    <!-- CARD REGISTER -->
    <div class="bg-[#2A2727] w-full max-w-md rounded-3xl p-10 shadow-2xl">

        <!-- ICON USER -->
        <div class="flex justify-center mb-5">
            <div class="w-20 h-20 bg-gray-500/40 rounded-full flex items-center justify-center">
                <img src="/icons/LoginIcon.svg" class="w-10 opacity-90">
            </div>
        </div>

        <!-- TITLE -->
        <h1 class="text-center text-white text-2xl font-semibold mb-10">
            Register
        </h1>

        <!-- FORM -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAME -->
            <label class="text-gray-300 text-sm">Nama</label>
            <input type="text"
                   name="name"
                   required autofocus
                   class="w-full mt-1 mb-5 px-4 py-3 rounded-lg bg-gray-200 border border-gray-300
                         focus:ring-2 focus:ring-gray-600 outline-none"
                   placeholder="Enter your name">

            <!-- EMAIL -->
            <label class="text-gray-300 text-sm">Email</label>
            <input type="email"
                   name="email"
                   required
                   class="w-full mt-1 mb-5 px-4 py-3 rounded-lg bg-gray-200 border border-gray-300
                         focus:ring-2 focus:ring-gray-600 outline-none"
                   placeholder="Enter your email">

            <!-- PASSWORD -->
            <label class="text-gray-300 text-sm">Password</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full mt-1 mb-5 px-4 py-3 rounded-lg bg-gray-200 border border-gray-300
                         focus:ring-2 focus:ring-gray-600 outline-none"
                   placeholder="Enter your password">

            <!-- PASSWORD CONFIRM -->
            <label class="text-gray-300 text-sm">Confirm Password</label>
            <input type="password"
                   name="password_confirmation"
                   required
                   class="w-full mt-1 mb-8 px-4 py-3 rounded-lg bg-gray-200 border border-gray-300
                         focus:ring-2 focus:ring-gray-600 outline-none"
                   placeholder="Confirm your password">

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-white rounded-full text-sm font-medium
                               hover:bg-gray-100 transition shadow">
                    Sign Up
                </button>
            </div>
        </form>

        <!-- LINK LOGIN -->
        <p class="mt-6 text-center text-gray-300 text-sm">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-blue-400 hover:underline">
                Login
            </a>
        </p>

    </div>

</body>
</html>
