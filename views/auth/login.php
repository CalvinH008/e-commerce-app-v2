<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-slate-800">

    <div class="min-h-screen flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 overflow-hidden">
                <!-- Header with Logo -->
                <div class="bg-emerald-800 p-6 flex items-center justify-center gap-3">
                    <a href="<?= base_path('') ?>" class="flex items-center justify-center gap-3">
                        <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 7h-3V6a4 4 0 0 0-8 0v1H5a1 1 0 0 0-1 1v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8a1 1 0 0 0-1-1zm-9-1a2 2 0 1 1 4 0v1h-4V6zm-1 6h2v2H9v-2zm4 0h2v2h-2v-2z"/>
                        </svg>
                        <span class="text-2xl font-bold text-white">E-Commerce-App</span>
                    </a>
                </div>
                
                <!-- Form Content -->
                <div class="p-8">
                    <h1 class="text-2xl font-bold text-slate-900 mb-2">Masuk Akun</h1>
                    <p class="text-slate-600 text-sm mb-8">Silakan login untuk melanjutkan belanja</p>

                <?php if(isset($_SESSION['flash'])): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-700">
                            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_path('login') ?>" class="space-y-5">
                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            placeholder="nama@email.com" 
                            required
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition text-slate-900"
                        >
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-slate-700 mb-2">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            id="password"
                            placeholder="••••••••" 
                            required
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none transition text-slate-900"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 bg-emerald-800 text-white font-medium rounded-lg hover:bg-emerald-900 transition duration-200"
                    >
                        Masuk
                    </button>
                </form>

                <p class="text-center text-slate-600 text-sm mt-6">
                    Belum punya akun? 
                    <a href="<?= base_path('register') ?>" class="text-emerald-800 font-semibold hover:underline">
                        Daftar sekarang
                    </a>
                </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
