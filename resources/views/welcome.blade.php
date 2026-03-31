<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel API Test</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="antialiased bg-gray-100 dark:bg-gray-900 min-h-screen flex flex-col items-center justify-center">

    <div class="max-w-7xl mx-auto p-6 lg:p-8 bg-white dark:bg-gray-800 shadow-xl rounded-lg text-center">
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-4">
            Cek Console (F12) atau Alert
        </h1>
        <p class="text-gray-600 dark:text-gray-400">
            Mencoba mengambil data dari: <code class="bg-gray-200 dark:bg-gray-700 p-1 rounded">/api/categories</code>
        </p>
        
        <div id="hasil-api" class="mt-6 text-left p-4 bg-gray-50 dark:bg-gray-700 rounded border border-gray-200 dark:border-gray-600 hidden">
            <h2 class="font-semibold dark:text-white">Data yang diterima:</h2>
            <ul id="list-kategori" class="list-disc ml-5 mt-2 dark:text-gray-300"></ul>
        </div>
    </div>

    <script>
        function tampilkanData(response) {
            console.log("Data dari Laravel:", response.data);
            
            // Menampilkan Alert
            if(response.data.length > 0) {
                alert("Kategori pertama: " + response.data[0].name);
                
                // Menampilkan ke halaman agar tidak perlu buka console saja
                const container = document.getElementById('hasil-api');
                const list = document.getElementById('list-kategori');
                container.classList.remove('hidden');
                
                response.data.forEach(item => {
                    let li = document.createElement('li');
                    li.textContent = item.name;
                    list.appendChild(li);
                });
            }
        }
    </script>

    <script src="http://127.0.0.1:8000/api/categories?format=js"></script>

</body>
</html>