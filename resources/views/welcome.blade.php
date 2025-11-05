<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clinic Appointment System</title>
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Test styles to verify CSS is working -->
    <style type="text/tailwindcss">
        @layer components {
            .btn-primary {
                @apply px-6 py-3 rounded-lg shadow-md transition duration-300 ease-in-out hover:scale-105 transform;
            }
        }
    </style>
</head>
<body class="bg-gradient-to-br from-indigo-50 via-white to-blue-100 text-gray-800">

    <div class="min-h-screen flex flex-col items-center justify-center px-6">
        <!-- Card Container -->
        <div class="max-w-3xl w-full bg-white/70 backdrop-blur-md rounded-2xl shadow-lg p-10 text-center border border-gray-100">
            <h1 class="text-4xl sm:text-5xl font-extrabold mb-4 text-gray-800">
                Welcome to <span class="text-indigo-600">ClinicCare</span>
            </h1>
            <p class="text-gray-600 text-lg mb-10">
                Book appointments easily, manage schedules, and stay updated — whether you're a patient, doctor, or clinic admin.
            </p>

            <!-- Login Buttons -->
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="{{ url('/admin') }}" 
                   class="btn-primary bg-indigo-600 text-white hover:bg-indigo-700">
                    Login as Admin
                </a>
                <a href="{{ url('/doctor') }}" 
                   class="btn-primary bg-green-600 text-white hover:bg-green-700">
                    Login as Doctor
                </a>
                <a href="{{ url('/patient') }}" 
                   class="btn-primary bg-blue-600 text-white hover:bg-blue-700">
                    Login as Patient
                </a>
            </div>
        </div>

        <!-- Footer -->
        <footer class="mt-12 text-gray-500 text-sm text-center">
            &copy; {{ date('Y') }} <span class="text-indigo-600 font-semibold">ClinicCare</span>. All rights reserved.
        </footer>
    </div>

    <!-- Optional floating decorative shapes -->
    <div class="absolute top-10 left-10 w-24 h-24 bg-indigo-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-32 h-32 bg-blue-200 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>

</body>
</html>
