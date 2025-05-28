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
        <h3 class="text-2xl font-bold mb-10 text-center text-white">Gedung Fakultas Kedokteran</h3>

        <!-- Batch 1 -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            @foreach ($combinedData->take(4) as $item)
                <div id="slot-{{ $item->id }}"
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center transition-all duration-500 {{ $item['warna'] }}">
                    <div>{{ $item->slot }}</div> <!-- Akan diganti item.slot -->
                    <div>{{ $item->status == 2 ? 'Sensor Not Connect' : $item->deskripsi }}</div>
                    <!-- Akan diganti item.deskripsi -->
                </div>
            @endforeach
        </div>

        <!-- Batch 2 -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            @foreach ($combinedData->slice(4, 8) as $item)
                <div id="slot-{{ $item->id }}"
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center transition-all duration-500 {{ $item['warna'] }}">
                    <div>{{ $item->slot }}</div> <!-- Akan diganti item.slot -->
                    <div>{{ $item->status == 2 ? 'Sensor Not Connect' : $item->deskripsi }}</div>
                    <!-- Akan diganti item.deskripsi -->
                </div>
            @endforeach
        </div>

        <!-- Batch 3 -->
        <div class="grid grid-cols-4 gap-4 mb-10">
            @foreach ($combinedData->slice(12, 8) as $item)
                <div id="slot-{{ $item->id }}"
                    class="h-32 rounded-lg flex flex-col items-center justify-center text-white text-xl font-bold text-center transition-all duration-500 {{ $item['warna'] }}">
                    <div>{{ $item->slot }}</div> <!-- Akan diganti item.slot -->
                    <div>{{ $item->status == 2 ? 'Sensor Not Connect' : $item->deskripsi }}</div>
                    <!-- Akan diganti item.deskripsi -->
                </div>
            @endforeach
        </div>

        <h3 class="text-2xl font-bold mt-10 text-center text-white">Gedung Fakultas Hukum</h3>
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
                        element.classList.remove('bg-green-400', 'bg-red-400', 'bg-gray-400','bg-yellow-400');

                        // Tambahkan warna baru dari database
                        element.classList.add(item.warna);

                        // Update isi slot dan deskripsi
                        element.children[0].textContent = item.slot;
                        element.children[1].textContent = item.deskripsi;
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
