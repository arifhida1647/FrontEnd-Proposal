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
        class="fixed top-3 left-1/2 transform -translate-x-1/2 p-4 rounded-full z-50 w-full max-w-lg 
        bg-gray-800">
        <div class="flex justify-center items-center w-full h-full">
            <div class="flex items-center">
                <!-- Gantilah <FaBeer> dengan elemen HTML biasa jika perlu -->
                <span class="text-white mr-2 text-2xl"><img src="{{ asset('LOGO.png') }}" alt=""
                        style="max-width: 50px"></span>
                <span class="text-white text-xl font-bold">UPN Veteran Jakarta</span>
            </div>
        </div>
    </nav>
    <div class="relative min-h-screen flex items-center justify-center">
        <img src="https://images.unsplash.com/photo-1506521781263-d8422e82f27a?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Slider Image" class="absolute inset-0 w-full h-full object-cover" />
        <div class="relative z-10 flex flex-col justify-center items-center h-full">
            <p class="font-bold text-3xl md:text-7xl text-center bg-clip-text text-transparent bg-white py-4">
                Selamat Datang <br /> Sistem Monitoring Parkir UPNVJ
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
                <p class="text-4xl mt-4 text-green-400">{{ $countBothStatus0 }}</p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Kemungkinan Kosong</h2>
                <p class="text-4xl mt-4 text-yellow-300 ">{{ $countBothStatus2 }}</p>
            </div>
            <div class="bg-white dark:bg-slate-600 border-4 border-sky-500 shadow-md rounded-lg p-6 text-center">
                <h2 class="text-xl font-bold">Update Time</h2>
                <p class="text-2xl mt-4 text-white">{{ $images->created_at }}</p>
            </div>
        </div>
    </section>
    <section class="container my-10 px-4 mx-auto">
        <section class="container my-10 px-4 mx-auto">
            <div class="flex justify-center items-center h-full">
                <img src="{{ 'https://service.arifhida.my.id/storage/' . $images->path_image }}" alt="Centered Image"
                    class="w-1/3 h-auto rounded-lg shadow-white" />
            </div>
        </section>
    </section>
    <section class="container mb-8 px-4 mx-auto">
        <h2 class="text-4xl font-bold mb-10 text-center text-white">Komparasi Parkir</h2>
        <div class="grid grid-cols-4 md:grid-cols-4 gap-4">
            @foreach ($combinedData as $id => $item)
                @php
                    // Tentukan warna latar belakang berdasarkan both_status
                    $bgColor = match ($item['both_status']) {
                        0 => 'bg-green-400',
                        2 => 'bg-yellow-400',
                        1 => 'bg-red-400',
                        default => 'bg-red-400',
                    };
                @endphp

                <div
                    class="h-32 rounded-lg flex items-center justify-center text-white text-xl font-bold {{ $bgColor }} {{ $loop->iteration == 8 ? 'mb-10' : '' }} {{ $loop->iteration == 16 ? 'mb-10' : '' }}">
                    {{ $item['slot'] }}
                </div>
            @endforeach

        </div>
    </section>
    <script>
        // Refresh the page every 2 seconds
        setInterval(function() {
            window.location.reload();
        }, 5000); // 2000 milliseconds = 2 seconds
    </script>

</body>

</html>
