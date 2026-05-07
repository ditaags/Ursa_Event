<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ursa Event - Data Finance</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="bg-white flex h-screen overflow-hidden">

    <!-- Main Content Container -->
    <main class="flex-1 p-6">
        <div class="bg-[#D1D5DB] w-full h-full rounded-[40px] p-12 overflow-auto">
            
            <!-- HEADER + LOGOUT -->
            <div class="flex justify-between items-center mb-10">
                <div>
                    <h2 class="text-3xl font-bold text-gray-800">Data Finance</h2>
                    <p class="text-xl text-gray-600 mt-2">Tampilan detail data finance dibawah ini</p>
                </div>

                <!-- 🔥 LOGOUT BUTTON -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="flex items-center gap-2 px-5 py-2 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        Logout
                    </button>
                </form>
            </div>

            <!-- Table -->
            <div class="max-w-4xl">
                <table class="w-full border-collapse bg-white">
                    <thead>
                        <tr>
                            <th class="border border-gray-400 p-4 text-left text-xs font-bold uppercase w-1/5">ID Finance</th>
                            <th class="border border-gray-400 p-4 text-left text-xs font-bold uppercase w-1/5">Bagian Penyelenggara</th>
                            <th class="border border-gray-400 p-4 text-left text-xs font-bold uppercase w-1/5">Bagian Admin</th>
                            <th class="border border-gray-400 p-4 text-left text-xs font-bold uppercase w-1/5">Tanggal</th>
                            <th class="border border-gray-400 p-4 text-left text-xs font-bold uppercase w-1/5">Kategori</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="h-16">
                            <td class="border border-gray-400 p-4 text-xs">#FIN-001</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">Divisi IT</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">Dewi</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">11-03-2026</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">Selesai</td>
                        </tr>

                        <tr class="h-16">
                            <td class="border border-gray-400 p-4 text-xs">#FIN-002</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">Divisi IT</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">Muhammad</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">13-03-2026</td>
                            <td class="border border-gray-400 p-4 text-xs font-medium">Belum</td>
                        </tr>

                        <tr class="h-16">
                            <td class="border border-gray-400 p-4"></td>
                            <td class="border border-gray-400 p-4"></td>
                            <td class="border border-gray-400 p-4"></td>
                            <td class="border border-gray-400 p-4"></td>
                            <td class="border border-gray-400 p-4"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
    </main>

</body>
</html>