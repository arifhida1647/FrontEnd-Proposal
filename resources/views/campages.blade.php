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
        <h2 class="text-2xl font-bold mb-10 text-center text-white">Gedung Fakultas Kedokteran</h2>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-10">
            @foreach ($cam->take(4) as $item)
                @php
                    $bgColor =
                        $item->status == 0 ? 'bg-green-400' : ($item->status == 1 ? 'bg-red-400' : 'bg-gray-400');
                    $text = $item->status == 2 ? 'Cam Not Connect' : $item->slot;
                @endphp
                <div
                    class="h-32 rounded-lg flex items-center justify-center text-white text-xl font-bold {{ $bgColor }}">
                    {{ $text }}
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-10">
            @foreach ($cam->slice(4, 8) as $item)
                @php
                    $bgColor =
                        $item->status == 0 ? 'bg-green-400' : ($item->status == 1 ? 'bg-red-400' : 'bg-gray-400');
                    $text = $item->status == 2 ? 'Cam Not Connect' : $item->slot;
                @endphp
                <div
                    class="h-32 rounded-lg flex items-center justify-center text-white text-xl font-bold {{ $bgColor }}">
                    {{ $text }}
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-4 md:grid-cols-4 gap-4 mb-10">
            @foreach ($cam->slice(12, 8) as $item)
                @php
                    $bgColor =
                        $item->status == 0 ? 'bg-green-400' : ($item->status == 1 ? 'bg-red-400' : 'bg-gray-400');
                    $text = $item->status == 2 ? 'Cam Not Connect' : $item->slot;
                @endphp
                <div
                    class="h-32 rounded-lg flex items-center justify-center text-white text-xl font-bold {{ $bgColor }}">
                    {{ $text }}
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

        // Cek apakah iframe berhasil dimuat
        setTimeout(() => {
            if (!iframe.contentWindow || iframe.contentWindow.length === 0) {
                videoContainer.innerHTML = `
            <div class="flex items-center justify-center text-white text-4xl font-bold text-center">
                <svg class="w-10 h-10 text-red-500 mr-3" fill="none" stroke="currentColor" stroke-width="2" 
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M18.364 18.364a9 9 0 11-12.728-12.728 9 9 0 0112.728 12.728z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" 
                        d="M15 9l-6 6m0-6l6 6"></path>
                </svg>
                <span>Kamera Tidak Terhubung</span>
            </div>
        `;
            }
        }, 2000); // Jika dalam 2 detik iframe tidak dimuat, tampilkan pesan
    </script>

</body>

</html>
