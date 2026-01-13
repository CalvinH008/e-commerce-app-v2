<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - E-Commerce</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <!-- Navigation Header -->
    <nav class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?= base_path('') ?>" class="text-xl font-semibold text-slate-900">
                    E-Commerce-App
                </a>
                <div class="flex gap-6">
                    <a href="<?= base_path('products') ?>" class="text-slate-600 hover:text-slate-900 transition">Produk</a>
                    <a href="<?= base_path('login') ?>" class="text-slate-600 hover:text-slate-900 transition">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="min-h-[calc(100vh-64px)] flex items-center justify-center px-4 py-12">
        <div class="w-full max-w-md">
            <div class="bg-white rounded-lg shadow-sm border border-slate-200 p-8">
                <h1 class="text-2xl font-bold text-slate-900 mb-2">Buat Akun</h1>
                <p class="text-slate-600 text-sm mb-8">Daftar untuk mulai berbelanja</p>

                <?php if(isset($_SESSION['flash'])): ?>
                    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                        <p class="text-sm text-red-700">
                            <?= $_SESSION['flash']; unset($_SESSION['flash']); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?= base_path('register') ?>" class="space-y-5">
                    <div>
                        <label for="username" class="block text-sm font-medium text-slate-700 mb-2">Username</label>
                        <input 
                            type="text" 
                            name="username" 
                            id="username"
                            placeholder="username" 
                            required
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent outline-none transition text-slate-900"
                        >
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-slate-700 mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            id="email"
                            placeholder="nama@email.com" 
                            required
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent outline-none transition text-slate-900"
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
                            class="w-full px-4 py-2 border border-slate-300 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent outline-none transition text-slate-900"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full px-4 py-2 bg-slate-900 text-white font-medium rounded-lg hover:bg-slate-800 transition duration-200"
                    >
                        Daftar
                    </button>
                </form>

                <p class="text-center text-slate-600 text-sm mt-6">
                    Sudah punya akun? 
                    <a href="<?= base_path('login') ?>" class="text-slate-900 font-semibold hover:underline">
                        Masuk di sini
                    </a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
