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
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Home</a>
                <a href="{{ url('cam') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Camera</a>
                <a href="{{ url('iot') }}"
                    class="text-white text-lg font-semibold transition-all duration-300 hover:text-gray-400">Iot</a>
                <a href="{{ url('live') }}"
                    class="hover:text-white text-lg font-semibold transition-all duration-300 text-gray-400">Live</a>
            </div>
        </div>
    </nav>
    <section class="container mb-8 px-4 mt-36 mx-auto">
        <h2 class="text-4xl font-bold mb-10 text-center text-white">IOT Sensor</h2>
        <h2 class="text-2xl font-bold mb-10 text-center text-white">Gedung Fakultas Kedokteran</h2>
        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            @foreach ($iot as $item)
                @php
                    $bgColor =
                        $item->status == 0 ? 'bg-green-400' : ($item->status == 1 ? 'bg-red-400' : 'bg-gray-400');
                    $slotText = $item->status == 0 || $item->status == 1 ? $item->slot : 'Sensor Terputus';
                @endphp
                <div
                    class="h-32 rounded-lg flex items-center justify-center text-white text-xl font-bold {{ $bgColor }}  
        {{ $loop->iteration == 8 ? 'mb-10' : '' }} 
        {{ $loop->iteration == 16 ? 'mb-10' : '' }}">
                    {{ $slotText }}
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

</body>

</html>
