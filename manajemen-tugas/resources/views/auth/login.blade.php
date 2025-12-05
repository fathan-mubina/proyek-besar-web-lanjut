<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-[#F3F0D7] min-h-screen flex items-center justify-center">

    <!-- CARD LOGIN -->
    <div class="bg-[#2A2727] w-full max-w-md rounded-3xl p-10 shadow-2xl">

        <!-- ICON USER -->
        <div class="flex justify-center mb-5">
            <div class="w-20 h-20 bg-gray-500/40 rounded-full flex items-center justify-center">
                <img src="/icons/LoginIcon.svg" class="w-10 opacity-90">
            </div>
        </div>

        <!-- TITLE -->
        <h1 class="text-center text-white text-2xl font-semibold mb-10">
            Login
        </h1>

        <!-- FORM -->
       <form method="POST" action="{{ route('login') }}">
    @csrf


            <!-- EMAIL -->
            <label class="text-gray-300 text-sm">Email</label>
            <input type="email"
                   name="email"
                   required autofocus
                   class="w-full mt-1 mb-5 px-4 py-3 rounded-lg bg-gray-200 border border-gray-300
                         focus:ring-2 focus:ring-gray-600 outline-none"
                   placeholder="Enter your email">

            <!-- PASSWORD -->
            <label class="text-gray-300 text-sm">Password</label>
            <input type="password"
                   name="password"
                   required
                   class="w-full mt-1 mb-8 px-4 py-3 rounded-lg bg-gray-200 border border-gray-300
                         focus:ring-2 focus:ring-gray-600 outline-none"
                   placeholder="Enter your password">

            <!-- BUTTON -->
            <div class="flex justify-end">
                <button type="submit"
                        class="px-6 py-2 bg-white rounded-full text-sm font-medium
                               hover:bg-gray-100 transition shadow">
                    Sign In
                </button>
            </div>
        </form>

    </div>

</body>
</html>
