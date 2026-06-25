<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IoT Monitoring Dashboard</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 text-center">
            IoT Monitoring Dashboard
        </h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-gray-500 font-medium">Suhu</h2>
                <p id="temp" class="text-4xl font-bold text-red-500 mt-2">
                    {{ $latestData->temperature ?? '0' }}°C
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-gray-500 font-medium">Kelembaban</h2>
                <p id="hum" class="text-4xl font-bold text-blue-500 mt-2">
                    {{ $latestData->humidity ?? '0' }}%
                </p>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md text-center">
                <h2 class="text-gray-500 font-medium">Kecerahan (LDR)</h2>
                <p id="lux" class="text-4xl font-bold text-yellow-500 mt-2">
                    {{ $latestData->lux ?? '0' }} Lm
                </p>
            </div>

        </div>

        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold text-gray-700 mb-4">
                Riwayat Data Terakhir
            </h2>

            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3">Waktu</th>
                        <th class="p-3">Suhu</th>
                        <th class="p-3">Kelembaban</th>
                        <th class="p-3">Kecerahan</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($historyData as $data)
                    <tr class="border-b border-gray-100">
                        <td class="p-3">{{ $data->created_at->format('H:i:s d-m-Y') }}</td>
                        <td class="p-3 text-red-500 font-semibold">{{ $data->temperature }}°C</td>
                        <td class="p-3 text-blue-500 font-semibold">{{ $data->humidity }}%</td>
                        <td class="p-3 text-yellow-600 font-semibold">{{ $data->lux }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        async function loadLatestData() {
            try {
                const response = await fetch('/sensor/latest');
                const data = await response.json();

                if (data) {
                    document.getElementById('temp').innerText =
                        data.temperature + '°C';

                    document.getElementById('hum').innerText =
                        data.humidity + '%';

                    document.getElementById('lux').innerText =
                        data.lux + ' Lm';
                }
            } catch (error) {
                console.error('Gagal mengambil data:', error);
            }
        }

        // Update setiap 2 detik
        setInterval(loadLatestData, 2000);
    </script>

</body>
</html>