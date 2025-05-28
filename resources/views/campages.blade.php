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
        .parallelogram {
            transform: skewX(-15deg);
            background-color: #4b5563;
            /* Tailwind bg-gray-700 default */
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

        <!-- Batch 1 -->
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
                        @foreach ($cam->slice($i, 4) as $item)
                            <div id="slot-{{ $item->id }}"
                                class="h-44 overflow-hidden transition-all duration-500 flex items-center justify-center text-white text-lg font-semibold text-center relative
                {{ $i === 0 ? 'border-t-8 border-l-8 border-r-8 border-white' : '' }}
                {{ $i === 4 ? 'border-b-8 border-l-8 border-r-8 border-white' : '' }}
                {{ $i === 8 ? 'border-t-8 border-l-8 border-r-8 border-white' : '' }}
                {{ $i === 12 ? 'border-b-8 border-l-8 border-r-8 border-white' : '' }}
                {{ $i === 16 ? 'border-t-8 border-l-8 border-r-8 border-white' : '' }}
                {{ $i === 16 ? 'parallelogram' : '' }}">
                                <!-- Konten akan diisi lewat JS -->
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

    <script>
        function fetchKomparasiData() {
            fetch('/api/cam-data')
                .then(response => response.json())
                .then(data => {
                    data.forEach(item => {
                        const element = document.getElementById(`slot-${item.id}`);
                        if (!element) return;

                        // Reset class warna
                        element.classList.remove('bg-green-400', 'bg-red-400', 'bg-gray-400', 'bg-yellow-400');

                        // Set warna berdasarkan status
                        if (item.status == 0) {
                            element.classList.add('bg-green-400');
                        } else if (item.status == 1) {
                            element.classList.add('bg-red-400');
                        } else if (item.status == 2) {
                            element.classList.add('bg-gray-400');
                        } else {
                            element.classList.add('bg-yellow-400');
                        }

                        // Tambahkan label slot
                        element.innerHTML = `
                        <div class="absolute top-1 left-1 bg-black bg-opacity-50 text-white text-sm px-2 py-1 rounded">
                            ${item.slot}
                        </div>
                    `;

                        // Tambahkan konten berdasarkan status
                        if (item.status == 1) {
                            // Terisi
                            element.innerHTML += `
                            <div class="flex items-center justify-center h-full">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3 13l2-5h14l2 5v6a1 1 0 01-1 1h-1a2 2 0 01-4 0H8a2 2 0 01-4 0H3a1 1 0 01-1-1v-6z" />
                                </svg>
                            </div>
                        `;
                        } else if (item.status == 0) {
                            // Kosong
                            element.innerHTML += `
                            <div class="flex items-center justify-center h-full text-white text-lg font-semibold">
                                Available
                            </div>
                        `;
                        } else if (item.status == 2) {
                            // Sensor Error
                            element.innerHTML += `
                            <div class="absolute bottom-1 left-1 right-1 text-center text-xs text-white bg-gray-700 bg-opacity-70 px-2 py-1 rounded">
                                Cam Not Connect
                            </div>
                        `;
                        }
                    });
                })
                .catch(console.error);
        }

        // Panggil saat halaman dimuat
        fetchKomparasiData();

        // Update tiap 5 detik
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
