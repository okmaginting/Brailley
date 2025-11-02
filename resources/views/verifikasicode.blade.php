<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Verification Code Braille</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
    input.otp-input::-webkit-outer-spin-button,
    input.otp-input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    input.otp-input {
      -moz-appearance: textfield;
    }
    .input-error {
      border-color: #dc2626;
    }
    .error-text {
      color: #dc2626;
      font-size: 0.875rem;
      margin-top: 0.25rem;
      text-align: center;
      display: none;
    }
  </style>
</head>
<body class="bg-[#05284C] min-h-screen flex flex-col">

  <!-- NAVBAR -->
  <nav class="bg-[#F1EFEC] w-full fixed top-0 left-0 z-50 shadow-sm py-4 flex justify-center items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-10 md:h-12">
  </nav>

  <!-- SECTION VERIFIKASI -->
  <section id="verifikasicode" class="flex justify-center items-start px-6 md:px-10 pt-[120px]">
    <div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[95%] max-w-[60rem] px-16 py-12 text-center">
      <h2 class="text-3xl font-bold mb-4">Verification Code</h2>
      <p class="text-gray-700 mb-6">Please enter the 6-digit code sent to your email.</p>

      <form id="otpForm" class="space-y-6 text-center">
        <div class="flex justify-center gap-6">
          <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" class="otp-input w-14 h-14 text-center border border-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-black" required>
          <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" class="otp-input w-14 h-14 text-center border border-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-black" required>
          <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" class="otp-input w-14 h-14 text-center border border-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-black" required>
          <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" class="otp-input w-14 h-14 text-center border border-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-black" required>
          <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" class="otp-input w-14 h-14 text-center border border-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-black" required>
          <input type="text" maxlength="1" inputmode="numeric" pattern="\d*" class="otp-input w-14 h-14 text-center border border-gray-800 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-white bg-black" required>
        </div>

        <p id="otpError" class="error-text">Semua kode harus diisi</p>

        <button type="submit" class="w-full bg-black text-white rounded-xl py-3 hover:bg-gray-800 transition">
          Verify Code
        </button>
      </form>

      <p class="text-sm text-gray-700 mt-6">
        Haven’t got the email yet?
        <a href="#" class="text-blue-600 font-medium hover:underline">Resend email</a>
      </p>
    </div>
  </section>

  <script>
    const inputs = document.querySelectorAll('.otp-input');
    const form = document.querySelector('#otpForm');
    const otpError = document.querySelector('#otpError');

    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        input.value = input.value.replace(/[^0-9]/g, '');
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });
      input.addEventListener('keydown', (e) => {
        if (e.key === 'Backspace' && !input.value && index > 0) {
          inputs[index - 1].focus();
        }
      });
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let valid = true;
      otpError.style.display = 'none';
      inputs.forEach(input => input.classList.remove('input-error'));

      inputs.forEach(input => {
        if (!input.value) {
          valid = false;
          input.classList.add('input-error');
        }
      });

      if (!valid) {
        otpError.style.display = 'block';
      } else {
        window.location.href = '/login/forgotpassword/verifikasicode/confirmcode';
      }
    });
  </script>

</body>
</html>
