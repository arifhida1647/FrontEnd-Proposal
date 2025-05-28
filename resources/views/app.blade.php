<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Home Pages</title>
    <style>
        /* Style popup dan overlay */
        #popup {
            display: none;
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
            background: red;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 8px 16px;
            cursor: pointer;
        }

        #overlay {
            display: none;
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
        .parallelogram {
            transform: skewX(-15deg);
            background-color: #4b5563;
            /* Tailwind bg-gray-700 default */
        }
    </style>
</head>

<body class="bg-gray-800">
    <!-- Navbar -->
    <nav
        class="fixed top-3 left-1/2 transform -translate-x-1/2 p-3 rounded-full z-50 w-full max-w-lg bg-gray-900 bg-opacity-90 shadow-lg backdrop-blur-md border border-gray-700">
        <div class="flex justify-between items-center px-6">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('LOGOV2.png') }}" alt="Logo" class="w-16 h-16 rounded-full">
            </div>
            <div class="flex space-x-6">
                <a href="{{ url('/') }}" class="text-white text-lg font-semibold hover:text-gray-400">Home</a>
                <a href="{{ url('cam') }}" class="text-gray-400 text-lg font-semibold hover:text-white">Camera</a>
                <a href="{{ url('iot') }}" class="text-gray-400 text-lg font-semibold hover:text-white">Iot</a>
                <a href="{{ url('live') }}" class="text-gray-400 text-lg font-semibold hover:text-white">Live</a>
            </div>
        </div>
    </nav>

    <!-- Hero -->
    <div class="relative min-h-screen flex items-center justify-center">
        <div class="z-10 flex flex-col items-center">
            <p class="font-bold text-3xl md:text-7xl text-center text-transparent bg-clip-text bg-white py-4">
                <span id="typing-text"></span>
            </p>
        </div>
    </div>

    <!-- Statistik Parkir -->
    <section class="container my-10 px-4 mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-white">
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Total Parkir</h2>
                <p id="total-parkir" class="text-4xl mt-4"></p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Ketersediaan Parkir</h2>
                <p id="tersedia-parkir" class="text-4xl mt-4 text-green-400"></p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Kemungkinan Kosong</h2>
                <p id="kemungkinan-parkir" class="text-4xl mt-4 text-yellow-300"></p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Update Time</h2>
                <p id="update-time" class="text-2xl mt-4"></p>
            </div>
        </div>
    </section>

    <!-- Komparasi Parkir -->
    <section class="container mb-8 px-4 mx-auto">
        <h2 class="text-4xl font-bold mb-10 text-center text-white">Komparasi Parkir</h2>

        <div class="grid grid-cols-6 gap-4 mt-8">
            <!-- Jalan vertikal -->
            <div class="row-span-full flex flex-col items-center justify-center">
                <div class="w-full h-full bg-gray-700 rounded-xl relative">
                    <div
                        class="absolute top-0 left-1/2 transform -translate-x-1/2 h-full w-1 
                [background:repeating-linear-gradient(white_0,white_10px,transparent_10px,transparent_20px)]">
                    </div>
                </div>
            </div>

            <!-- Slot parkir -->
            <div class="col-span-5 space-y-2">
                <!-- Gedung Atas -->
                <div class="grid grid-cols-4 gap-4">
                    <div
                        class="col-span-4 h-60 rounded-xl bg-gray-500 flex items-center justify-center text-white text-lg font-semibold">
                        Gedung Fakultas Kedokteran
                    </div>
                </div>

                @for ($i = 0; $i < 20; $i += 4)
                    @if ($i == 4 || $i == 12)
                        <!-- Jalan horizontal -->
                        <div class="row-span-full flex flex-col items-center justify-center mb-4">
                            <div class="w-full h-20 bg-gray-700 rounded-xl relative">
                                <div class="absolute top-1/2 left-0 transform -translate-y-1/2 w-full h-1"
                                    style="background: repeating-linear-gradient(to right, white 0, white 10px, transparent 10px, transparent 20px);">
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-4 gap-4 ml-5">
                        @foreach ($combinedData->slice($i, 4) as $item)
                            <div id="slot-{{ $item->id }}"
                                class="h-44 overflow-hidden transition-all duration-500 flex flex-col items-center justify-center text-white text-lg font-semibold text-center relative
        {{ $i === 0 ? 'border-t-8 border-l-8 border-r-8 border-white' : '' }}
        {{ $i === 4 ? 'border-b-8 border-l-8 border-r-8 border-white' : '' }}
        {{ $i === 8 ? 'border-t-8 border-l-8 border-r-8 border-white' : '' }}
        {{ $i === 12 ? 'border-b-8 border-l-8 border-r-8 border-white' : '' }}
        {{ $i === 16 ? 'border-t-8 border-l-8 border-r-8 border-white' : '' }}
        {{ $i === 16 ? 'parallelogram' : '' }}">

                                <!-- Konten akan diisi lewat JS -->
                                <div class="slot-label"></div>
                                <div class="slot-description text-sm"></div>
                            </div>
                        @endforeach
                    </div>
                @endfor


                <!-- Jalan horizontal akhir -->
                <div class="row-span-full flex flex-col items-center justify-center mb-4">
                    <div class="w-full h-20 bg-gray-700 rounded-xl relative">
                        <div class="absolute top-1/2 left-0 transform -translate-y-1/2 w-full h-1"
                            style="background: repeating-linear-gradient(to right, white 0, white 10px, transparent 10px, transparent 20px);">
                        </div>
                    </div>
                </div>

                <!-- Gedung Bawah -->
                <div class="grid grid-cols-4 gap-4">
                    <div
                        class="col-span-4 h-60 rounded-xl bg-gray-500 flex items-center justify-center text-white text-lg font-semibold">
                        Gedung Fakultas Hukum
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!-- Script Update Data -->
    <script>
        function fetchKomparasiData() {
            fetch('/api/komparasi-data')
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const element = document.getElementById(`slot-${item.id}`);
                        if (!element) return;

                        // Hapus semua warna background yang mungkin sebelumnya
                        element.classList.remove('bg-green-400', 'bg-red-400', 'bg-gray-400', 'bg-yellow-400');

                        // Tambahkan warna baru dari database
                        element.classList.add(item.warna);

                        // Update isi slot dan deskripsi
                        const label = element.querySelector('.slot-label');
                        const desc = element.querySelector('.slot-description');
                        if (label) label.textContent = item.slot || '';
                        if (desc) desc.textContent = item.deskripsi || '';
                    });
                })
                .catch(console.error);
        }

        // Jalankan sekali saat halaman pertama kali load
        fetchKomparasiData();

        // Jalankan setiap 5 detik
        setInterval(fetchKomparasiData, 5000);
    </script>

    <script>
        function fetchStatistikParkir() {
            fetch('/api/statistik-parkir')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('total-parkir').textContent = data.total;
                    document.getElementById('tersedia-parkir').textContent = data.tersedia;
                    document.getElementById('kemungkinan-parkir').textContent = data.kemungkinan;
                    document.getElementById('update-time').textContent = data.update;
                })
                .catch(console.error);
        }

        fetchStatistikParkir();
        setInterval(fetchStatistikParkir, 5000);
    </script>


    <!-- Typed.js -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Typed("#typing-text", {
                strings: ["Selamat Datang", "Sistem Monitoring Parkir"],
                typeSpeed: 50,
                backSpeed: 30,
                backDelay: 1500,
                startDelay: 500,
                loop: true,
                showCursor: true,
                cursorChar: "|"
            });
        });
    </script>
</body>

</html>
