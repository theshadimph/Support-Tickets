<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Support Ticket System</title>
    {{-- Load Tailwind CSS via CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- Load Inter Font --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="h-full">
<div class="min-h-full flex items-center justify-center p-4">
    <div class="max-w-4xl w-full bg-white shadow-xl rounded-2xl overflow-hidden p-10 border border-gray-200">

        <div class="text-center">
            <svg class="mx-auto h-16 w-16 text-indigo-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 01-3.07-3.07L1.25 12l2.846-.813a4.5 4.5 0 013.07-3.07L9 5.25l.813 2.846a4.5 4.5 0 013.07 3.07L16.75 12l-2.846.813a4.5 4.5 0 01-3.07 3.07zM18.25 21l-1.423-4.981a3 3 0 00-2.18-2.18L12 16.75l4.981 1.423a3 3 0 002.18 2.18L21 21l-1.423-4.981a3 3 0 00-2.18-2.18L17 10.75l-1.423-4.981a3 3 0 00-2.18-2.18L10 9.75l4.981 1.423a3 3 0 002.18 2.18L17 19.75z" />
            </svg>
            <h1 class="mt-4 text-4xl font-extrabold text-gray-900 tracking-tight">
                Professional Support Desk
            </h1>
            <p class="mt-4 text-lg text-gray-600 max-w-xl mx-auto">
                Your dedicated portal for submitting, tracking, and resolving technical issues and client requests quickly and efficiently.
            </p>
        </div>

        <div class="mt-8 flex justify-center space-x-6">
            <a href="/login" class="inline-flex items-center justify-center rounded-xl bg-indigo-600 px-6 py-3 text-base font-semibold text-white shadow-lg hover:bg-indigo-700 focus-visible:outline focus-visible:outline-offset-2 focus-visible:outline-indigo-600 transition duration-150 ease-in-out transform hover:scale-[1.02]">
                Client Login
            </a>
            <a href="/register" class="inline-flex items-center justify-center rounded-xl border border-indigo-200 bg-white px-6 py-3 text-base font-semibold text-indigo-600 shadow-md hover:bg-indigo-50 transition duration-150 ease-in-out">
                New User Registration
            </a>
        </div>

        <div class="mt-12 text-center text-sm text-gray-500">
            <p>Employees and Managers should use the standard login process.</p>
        </div>
    </div>
</div>
</body>
</html>
