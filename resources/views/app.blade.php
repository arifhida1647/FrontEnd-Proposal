<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        /* Style untuk popup */
        #popup {
            display: none;
            /* Awalnya sembunyikan popup */
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            max-width: 1000px;
            height: 80%;
            max-height: 600px;
            background: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1000;
            overflow: hidden;
        }

        #popup iframe {
            width: 100%;
            height: 100%;
        }

        #popup .close-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgb(255, 0, 0);
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
        }

        /* Style untuk overlay */
        #overlay {
            display: none;
            /* Awalnya sembunyikan overlay */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .shadow-white {
            box-shadow: 0 20px 25px rgba(255, 255, 255, 0.5);
        }
    </style>
</head>

<body class="bg-gray-800">
    <nav
        class="fixed top-3 left-1/2 transform -translate-x-1/2 p-3 rounded-full z-50 w-full max-w-lg 
    bg-gray-900 bg-opacity-90 shadow-lg backdrop-blur-md border border-gray-700">
        <div class="flex justify-between items-center px-6">
            <!-- Logo -->
            <div class="flex items-center space-x-3">
                <img src="{{ asset('LOGO.png') }}" alt="Logo" class="w-10 h-10 rounded-full">
            </div>

            <!-- Navigation Links -->
            <div class="flex space-x-6">
                <a href="{{ url('/') }}"
                    class="text-white text-lg font-semibold transition-all duration-300 hover:text-gray-400">Home</a>
                <a href="{{ url('cam') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Camera</a>
                <a href="{{ url('iot') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Iot</a>
                <a href="{{ url('live') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Live</a>
            </div>
        </div>
    </nav>

    <div class="relative min-h-screen flex items-center justify-center">
        <div class="relative z-10 flex flex-col justify-center items-center h-full">
            <p class="font-bold text-3xl md:text-7xl text-center bg-clip-text text-transparent bg-white py-4">
                <span id="typing-text"></span>
            </p>
        </div>
    </div>

    <section class="container my-10 px-4 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-white">
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Total Parkir</h2>
                <p class="text-4xl mt-4">{{ $total }}</p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Ketersediaan Parkir</h2>
                <p class="text-4xl mt-4 text-green-400">{{ $tersedia }}</p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Kemungkinan Kosong</h2>
                <p class="text-4xl mt-4 text-yellow-300 ">{{ $kemungkinanTersedia }}</p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Update Time</h2>
                <p class="text-2xl mt-4 text-white">{{ now()->addHours(7) }}</p>
            </div>
        </div>
    </section>
    <section class="container mb-8 px-4 mx-auto">
        <h2 class="text-4xl font-bold mb-10 text-center text-white">Komparasi Parkir</h2>
        <h2 class="text-2xl font-bold mb-10 text-center text-white">Gedung Fakultas Kedokteran</h2>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-10">
            @foreach ($combinedData->take(4) as $id => $item)
                <div
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center {{ $item['warna'] }}">
                    <div>{{ $item['slot'] }}</div>
                    <div class="text-l font-normal">{{ $item['deskripsi'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-10">
            @foreach ($combinedData->slice(4, 8) as $id => $item)
                <div
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center {{ $item['warna'] }}">
                    <div>{{ $item['slot'] }}</div>
                    <div class="text-l font-normal">{{ $item['deskripsi'] }}</div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-10">
            @foreach ($combinedData->slice(12, 8) as $id => $item)
                <div
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center {{ $item['warna'] }}">
                    <div>{{ $item['slot'] }}</div>
                    <div class="text-l font-normal">{{ $item['deskripsi'] }}</div>
                </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold my-10 text-center text-white">Gedung Fakultas Hukum</h2>
    </section>

    <script>
        // Refresh the page every 2 seconds
        setInterval(function() {
            window.location.reload();
        }, 5000); // 2000 milliseconds = 2 seconds
    </script>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Typed("#typing-text", {
                strings: ["Selamat Datang", "Sistem Monitoring"],
                typeSpeed: 50, // Kecepatan mengetik (lebih kecil = lebih cepat)
                backSpeed: 30, // Kecepatan menghapus
                backDelay: 1500, // Waktu jeda sebelum menghapus
                startDelay: 500, // Waktu jeda sebelum mulai
                loop: true, // Ulang terus
                showCursor: true, // Tampilkan kursor berkedip
                cursorChar: "|", // Karakter kursor
            });
        });
    </script>
</body>

</html>
