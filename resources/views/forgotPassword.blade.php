<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>PIX</title>

    <script src="https://cdn.tailwindcss.com"></script>


</head>
<body class="antialiased">
<div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">

    <!-- Card -->
    <div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800">
        <div class="w-full p-6 sm:p-8">
            <h2 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">
                Forgot your password?
            </h2>
            <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                Type in your email and we will send you a code to reset your password!
            </p>

            @session('status')
            <p class="text-sm text-red-600 dark:text-red-500"> {{ $value }}</p>
            @endsession
            <form class="mt-8 space-y-6" method="post" action="{{route('password.reset.post')}}">
                @csrf
                <div>
                    <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                    <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="name@company.com" >
                    @error('email')
                    <p class="text-sm text-red-600 dark:text-red-500"> {{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <input type="submit" class="sm:text-sm rounded-lg block w-full p-2.5 dark:bg-gray-900 text-white hover:bg-gray-700">
                </div>
            </form>

        </div>
    </div>
</div>
</body>
</html>