<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinic Appointment System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.4.0/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50 text-gray-800">
    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        <div class="max-w-3xl text-center">
            <h1 class="text-4xl font-bold mb-4">Welcome to <span class="text-indigo-600">ClinicCare</span></h1>
            <p class="text-gray-600 mb-10">
                Book appointments easily, manage schedules, and stay updated — whether you're a patient, doctor, or clinic admin.
            </p>

            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/admin') }}" 
                   class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow hover:bg-indigo-700 transition">
                    Login as Admin
                </a>
                <a href="{{ url('/doctor') }}" 
                   class="px-6 py-3 bg-green-600 text-white rounded-lg shadow hover:bg-green-700 transition">
                    Login as Doctor
                </a>
                <a href="{{ url('/patient') }}" 
                   class="px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition">
                    Login as Patient
                </a>
            </div>
        </div>

        <footer class="mt-12 text-gray-500 text-sm">
            &copy; {{ date('Y') }} ClinicCare. All rights reserved.
        </footer>
    </div>
</body>
</html>
