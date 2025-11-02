<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password - Braille</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    .input-error {
      border-color: #dc2626;
    }
    .error-text {
      color: #dc2626;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      display: none;
    }
  </style>
</head>

<body class="bg-[#05284C] min-h-screen flex flex-col">

  <!-- NAVBAR -->
  <nav class="bg-[#F1EFEC] w-full fixed top-0 left-0 z-50 shadow-sm py-4 flex justify-center items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-10 md:h-12">
  </nav>

  <!-- FORM SECTION -->
  <section class="flex justify-center items-start px-6 md:px-10 pt-[120px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[95%] max-w-[70rem] px-10 md:px-16 py-12 text-center">
      <h2 class="text-3xl md:text-4xl font-bold mb-6 text-black">Forgot Password?</h2>
      <p class="text-gray-700 mb-6 text-base md:text-lg">
        Please enter your email address to reset your password.
      </p>

      <form id="forgotForm" class="space-y-6 text-left">
        <div>
          <label for="email" class="block text-gray-800 mb-2 font-medium">Email</label>
          <div class="relative">
            <input 
              type="email" 
              id="email" 
              name="email" 
              placeholder="Enter your email..." 
              class="w-full border-2 border-gray-300 rounded-xl py-3 px-4 pr-10 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-[#05284C] transition duration-300 bg-white"
            >
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 h-5 w-5 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
          </div>
          <p id="emailError" class="error-text">Email wajib diisi</p>
        </div>

        <button 
          type="submit" 
          class="w-full bg-black text-white rounded-xl py-3 mt-4 hover:bg-gray-800 transition font-medium"
        >
          Reset Password
        </button>
      </form>
    </div>
  </section>

  <script>
    const form = document.querySelector('#forgotForm');
    const email = document.querySelector('#email');
    const emailError = document.querySelector('#emailError');

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      emailError.style.display = 'none';
      email.classList.remove('input-error');

      if (!email.value.trim()) {
        emailError.style.display = 'block';
        email.classList.add('input-error');
        return;
      }

      window.location.href = '/login/forgotpassword/verifikasicode';
    });
  </script>

</body>
</html>
