<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title> Camera Pages</title>
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
                <img src="{{ asset('LOGOV2.png') }}" alt="Logo" class="w-16 h-16 rounded-full">
            </div>

            <!-- Navigation Links -->
            <div class="flex space-x-6">
                <a href="{{ url('/') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Home</a>
                <a href="{{ url('cam') }}"
                    class="text-white text-lg font-semibold transition-all duration-300 hover:text-gray-400">Camera</a>
                <a href="{{ url('iot') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Iot</a>
                <a href="{{ url('live') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Live</a>
            </div>
        </div>
    </nav>
    <section class="container mb-8 px-4 mt-36 mx-auto">
        <h2 class="text-4xl font-bold mb-10 text-center text-white">Camera Sensor</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-white justify-center items-center">
            <div
                class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center flex flex-col items-center">
                <h2 class="text-xl font-bold">Total Parkir</h2>
                <p id="total-parkir" class="text-4xl mt-4"></p>
            </div>
            <div
                class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center flex flex-col items-center">
                <h2 class="text-xl font-bold">Ketersediaan Parkir</h2>
                <p id="tersedia-parkir" class="text-4xl mt-4 text-green-400"></p>
            </div>
            <div
                class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center flex flex-col items-center">
                <h2 class="text-xl font-bold">Update Time</h2>
                <p id="update-time" class="text-2xl mt-4"></p>
            </div>
        </div>
        <h2 class="text-2xl font-bold mb-10 text-center text-white">Gedung Fakultas Kedokteran</h2>

        <!-- Batch 1 -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            @foreach ($cam->take(4) as $item)
                <div id="slot-{{ $item->id }}"
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center transition-all duration-500 {{ $item['warna'] }}">
                    <div>{{ $item->slot }}</div> <!-- Akan diganti item.slot -->
                    <div>{{ $item->status == 2 ? 'Cam Not Connect' : '' }}</div>
                    <!-- Akan diganti item.deskripsi -->
                </div>
            @endforeach
        </div>

        <!-- Batch 2 -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            @foreach ($cam->slice(4, 8) as $item)
                <div id="slot-{{ $item->id }}"
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center transition-all duration-500 {{ $item['warna'] }}">
                    <div>{{ $item->slot }}</div> <!-- Akan diganti item.slot -->
                    <div>{{ $item->status == 2 ? 'Cam Not Connect' : '' }}</div>
                    <!-- Akan diganti item.deskripsi -->
                </div>
            @endforeach
        </div>

        <!-- Batch 3 -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            @foreach ($cam->slice(12, 8) as $item)
                <div id="slot-{{ $item->id }}"
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center transition-all duration-500 {{ $item['warna'] }}">
                    <div>{{ $item->slot }}</div> <!-- Akan diganti item.slot -->
                    <div>{{ $item->status == 2 ? 'Cam Not Connect' : '' }}</div>
                    <!-- Akan diganti item.deskripsi -->
                </div>
            @endforeach
        </div>

        <h2 class="text-2xl font-bold my-10 text-center text-white">Gedung Fakultas Hukum</h2>
    </section>


    <script>
        function fetchKomparasiData() {
            fetch('/api/cam-data')
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const element = document.getElementById(`slot-${item.id}`);
                        if (!element) return;

                        // Hapus semua warna background yang mungkin sebelumnya
                        element.classList.remove('bg-green-400', 'bg-red-400', 'bg-gray-400', 'bg-yellow-400');

                        // Tambahkan warna berdasarkan status
                        if (item.status == 0) {
                            element.classList.add('bg-green-400');
                        } else if (item.status == 1) {
                            element.classList.add('bg-red-400');
                        } else if (item.status == 2) {
                            element.classList.add('bg-gray-400');
                        } else {
                            element.classList.add('bg-yellow-400'); // fallback kalau status tak dikenal
                        }

                        // Update isi slot dan deskripsi
                        element.children[0].textContent = item.slot;
                          // Tambahkan baris berikut untuk update pesan "Cam Not Connect"
                        if (element.children[1]) {
                            element.children[1].textContent = item.status == 2 ? 'Cam Not Connect' : '';
                        }
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
            fetch('/api/statistik-cam')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('total-parkir').textContent = data.total;
                    document.getElementById('tersedia-parkir').textContent = data.tersedia;
                    document.getElementById('update-time').textContent = data.update;
                })
                .catch(console.error);
        }

        fetchStatistikParkir();
        setInterval(fetchStatistikParkir, 5000);
    </script>
    <script>
        let lastScrollTop = 0;
        const navbar = document.getElementById("navbar");
        const iframe = document.getElementById("cameraFrame");
        const videoContainer = document.getElementById("video-container");

        // Event untuk sembunyikan navbar saat scroll ke bawah
        window.addEventListener("scroll", function() {
            let scrollTop = window.scrollY || document.documentElement.scrollTop;

            if (scrollTop > lastScrollTop) {
                navbar.style.transform = "translateY(-100px)";
            } else {
                navbar.style.transform = "translateY(0)";
            }

            lastScrollTop = scrollTop;
        });


        <
        /body>

        <
        /html>
