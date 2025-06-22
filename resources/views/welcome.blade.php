<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Welcome to Ridium</title>
</head>
<body class="bg-gray-100 text-gray-800 antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center">
        <h1 class="text-5xl font-bold text-indigo-600 mb-6">Welcome to Ridium</h1>

        <p class="text-lg text-gray-600 mb-6">A lightweight PHP framework to build rapidly, inspired by Laravel.</p>

        <div class="flex gap-4">
            <a href="https://github.com/redox132/Ridium" target="_blank"
               class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                View on GitHub
            </a>

            <a href="docs/index.html"
               class="px-6 py-3 bg-white text-indigo-600 border border-indigo-600 rounded-lg shadow hover:bg-gray-50 transition">
                Documentation
            </a>
        </div>

        <footer class="mt-10 text-sm text-gray-500">
            &copy; <?= date('Y') ?> Ridium by redox132
        </footer>
    </div>

</body>
</html>
