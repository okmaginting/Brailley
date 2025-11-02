<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Password Reset Success</title>

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
<body class="bg-[#05284C] min-h-screen flex flex-col items-center justify-center">

  <!-- NAVBAR -->
  <nav class="bg-[#F1EFEC] w-full fixed top-0 left-0 z-50 shadow-sm py-4 flex justify-center items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-10 md:h-12 w-auto object-contain">
  </nav>

  <!-- SUCCESS CARD -->
  <div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[90%] max-w-[40rem] p-10 text-center mt-[120px]">
    
    <div class="flex justify-center mb-6">
      <div class="bg-green-500 w-24 h-24 rounded-full flex items-center justify-center">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
        </svg>
      </div>
    </div>

    <h2 class="text-3xl font-bold mb-4 text-[#05284C]">Password Berhasil Diubah</h2>
    <p class="text-gray-700 mb-8">Selamat! Password baru kamu sudah berhasil disimpan. Kamu bisa login dengan password baru.</p>

    <a href="/login" class="inline-block bg-black text-white py-2 px-6 rounded-xl hover:bg-gray-800 transition font-medium">
      Kembali ke Login
    </a>
  </div>

</body>
</html>
