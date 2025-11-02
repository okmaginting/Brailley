<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Code Confirmed Braille</title>

  <!-- Font Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  @vite('resources/css/app.css')

  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
  </style>
</head>
<body class="bg-[#05284C] min-h-screen flex flex-col items-center">

  <!-- NAVBAR -->
  <nav class="bg-[#F1EFEC] w-full fixed top-0 left-0 z-50 shadow-sm py-4 flex justify-center items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-10 md:h-12 w-auto object-contain">
  </nav>

  <!-- SECTION CONFIRM CODE -->
  <section id="confirmcode" class="flex justify-center items-center w-full px-6 md:px-10 pt-[120px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[90%] max-w-[40rem] px-10 py-12 text-center">

      <div class="flex justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
        </svg>
      </div>

      <h2 class="text-3xl font-bold mb-3 text-green-600">Code Confirmed!</h2>

      <p class="text-gray-700 mb-2">Your password has been successfully reset.</p>
      <p class="text-gray-700 mb-8">Click confirm to set a new password.</p>

      <!-- Confirm Button -->
      <a href="/login/forgotpassword/verifikasicode/confirmcode/resetpassword" class="block w-full text-center bg-black text-white rounded-xl py-3 hover:bg-gray-800 transition font-medium">
        Confirm
      </a>

    </div>
  </section>

</body>
</html>
