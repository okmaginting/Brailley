<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password Braille</title>

  <!-- Font Inter -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Tailwind CSS -->
  @vite('resources/css/app.css')

  <style>
    body { font-family: 'Inter', sans-serif; }
    .error-text { color: #dc2626; font-size: 0.875rem; margin-top: 0.25rem; display: none; }
    .input-error { border-color: #dc2626; }
  </style>
</head>
<body class="bg-[#05284C] min-h-screen flex flex-col items-center">

  <!-- NAVBAR -->
  <nav class="bg-[#F1EFEC] w-full fixed top-0 left-0 z-50 shadow-sm py-4 flex justify-center items-center">
    <img src="{{ asset('images/logo.png') }}" alt="Braille Logo" class="h-10 md:h-12 w-auto object-contain">
  </nav>

  <!-- RESET PASSWORD SECTION -->
  <section id="resetpassword" class="flex justify-center items-start w-full px-6 md:px-10 pt-[120px] pb-20">
    <div class="bg-[#F1EFEC] rounded-[2rem] shadow-xl w-[95%] max-w-[60rem] px-16 py-10 text-center">

      <h2 class="text-3xl font-bold mb-2">Reset Password</h2>
      <p class="text-gray-700 mb-6">Create a new password. Ensure it differs from previous ones for security.</p>

      <form id="resetForm" class="space-y-5 text-left">

        <div>
          <label for="new_password" class="block text-gray-800 mb-1">New Password</label>
          <div class="relative">
            <input type="password" id="new_password" name="new_password" placeholder="Enter new password"
              class="w-full border border-gray-300 rounded-xl py-2 px-4 pr-10 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <svg id="toggleNewPassword" xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </div>
          <p id="newPasswordError" class="error-text">Password wajib diisi</p>
        </div>

        <div>
          <label for="confirm_password" class="block text-gray-800 mb-1">Confirm Password</label>
          <div class="relative">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm password"
              class="w-full border border-gray-300 rounded-xl py-2 px-4 pr-10 text-black placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white">
            <svg id="toggleConfirmPassword" xmlns="http://www.w3.org/2000/svg" class="absolute right-3 top-2.5 h-5 w-5 text-gray-500 cursor-pointer transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-.38 1.224-.983 2.377-1.775 3.398A10.041 10.041 0 0112 19c-4.477 0-8.268-2.943-9.542-7z" />
            </svg>
          </div>
          <p id="confirmPasswordError" class="error-text">Konfirmasi password wajib diisi</p>
        </div>

        <button type="submit" class="w-full bg-black text-white rounded-xl py-2 mt-3 hover:bg-gray-800 transition font-medium">
          Reset Password
        </button>

      </form>

    </div>
  </section>

  <script>
    const form = document.querySelector('#resetForm');
    const newPassword = document.querySelector('#new_password');
    const confirmPassword = document.querySelector('#confirm_password');
    const toggleNew = document.querySelector('#toggleNewPassword');
    const toggleConfirm = document.querySelector('#toggleConfirmPassword');

    toggleNew.addEventListener('click', () => {
      const type = newPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      newPassword.setAttribute('type', type);
      toggleNew.classList.toggle('text-blue-500');
    });

    toggleConfirm.addEventListener('click', () => {
      const type = confirmPassword.getAttribute('type') === 'password' ? 'text' : 'password';
      confirmPassword.setAttribute('type', type);
      toggleConfirm.classList.toggle('text-blue-500');
    });

    form.addEventListener('submit', (e) => {
      e.preventDefault();
      let valid = true;

      document.getElementById('newPasswordError').style.display = 'none';
      document.getElementById('confirmPasswordError').style.display = 'none';
      newPassword.classList.remove('input-error');
      confirmPassword.classList.remove('input-error');

      if (!newPassword.value) {
        document.getElementById('newPasswordError').style.display = 'block';
        newPassword.classList.add('input-error');
        valid = false;
      }

      if (!confirmPassword.value) {
        document.getElementById('confirmPasswordError').style.display = 'block';
        confirmPassword.classList.add('input-error');
        valid = false;
      }

      if (valid) {
        window.location.href = '/login/forgotpassword/verifikasicode/confirmcode/resetpassword/berhasilpw';
      }
    });
  </script>

</body>
</html>
