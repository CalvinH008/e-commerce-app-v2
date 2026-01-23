<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce-App</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
</head>

<body class="bg-white text-slate-800">

<!-- NAVBAR -->
<nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="flex items-center justify-between h-16">

            <a href="<?= base_path('') ?>" class="flex items-center gap-2">
                <img src="<?= base_path('images/logo.png') ?>" alt="Logo" class="h-8 w-8">
                <span class="text-xl font-bold text-emerald-800">E-Commerce-App</span>
            </a>

            <div class="hidden md:flex items-center gap-6 text-sm font-medium">
                <?php if(isset($_SESSION['user'])): ?>

                    <a href="<?= base_path('cart') ?>"
                        class="group relative flex items-center gap-2 text-slate-700 hover:text-emerald-800 transition">
                        <span class="relative flex items-center justify-center
                                    w-10 h-10 rounded-full
                                    group-hover:bg-emerald-500
                                    transition duration-1000">
                            <i class="bx bx-cart text-2xl"></i>
                        </span>
                    </a>

                    <a href="<?= base_path('products') ?>" class="hover:text-emerald-800">Produk</a>
                    <a href="<?= base_path('dashboard') ?>" class="text-emerald-800 font-semibold">Dashboard</a>

                    <?php if($_SESSION['user']['role'] === 'admin'): ?>
                        <a href="<?= base_path('admin/dashboard') ?>" class="hover:text-emerald-800">Admin</a>
                    <?php endif; ?>

                    <a href="<?= base_path('logout') ?>"
                       class="px-4 py-2 bg-emerald-800 text-white rounded-md hover:bg-emerald-900">
                        Logout
                    </a>

                <?php else: ?>

                    <a href="<?= base_path('login') ?>" class="hover:text-emerald-800">
                        Masuk
                    </a>

                    <a href="<?= base_path('register') ?>"
                       class="px-5 py-2 bg-emerald-800 text-white rounded-md hover:bg-emerald-900">
                        Daftar
                    </a>

                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>

<!-- HERO (FULL SCREEN) -->
<section class="min-h-screen flex items-center">
    <div class="max-w-7xl mx-auto px-6 w-full">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-16 items-center">

            <!-- TEXT -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    Belanja Online<br class="hidden md:block">
                    Lebih Mudah & Aman
                </h1>

                <p class="text-slate-600 text-lg mb-10 max-w-xl">
                    Ribuan produk berkualitas, harga terbaik,
                    dan pengiriman cepat ke seluruh Indonesia.
                </p>

                <div class="flex gap-4 flex-wrap">
                    <a href="<?= base_path('products') ?>"
                       class="px-8 py-3 bg-emerald-800 text-white rounded-lg font-semibold hover:bg-emerald-900">
                        Mulai Belanja
                    </a>

                    <?php if(!isset($_SESSION['user'])): ?>
                        <a href="<?= base_path('register') ?>"
                           class="px-8 py-3 border-2 border-emerald-800 text-emerald-800 rounded-lg font-semibold hover:bg-emerald-50">
                            Daftar Gratis
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- VISUAL -->
            <div class="hidden md:flex justify-end">
                <div class="w-[420px] h-[420px] rounded-2xl bg-emerald-50 flex items-center justify-center shadow-lg">
                    <span class="text-emerald-800 font-semibold">
                        Featured Products
                    </span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10 text-center">

            <div>
                <div class="w-16 h-16 bg-emerald-800 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    🚚
                </div>
                <h3 class="font-semibold text-lg mb-2">Pengiriman Cepat</h3>
                <p class="text-slate-600">Ke seluruh Indonesia</p>
            </div>

            <div>
                <div class="w-16 h-16 bg-emerald-800 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    🛡️
                </div>
                <h3 class="font-semibold text-lg mb-2">Aman & Terpercaya</h3>
                <p class="text-slate-600">Pembayaran terenkripsi</p>
            </div>

            <div>
                <div class="w-16 h-16 bg-emerald-800 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    💯
                </div>
                <h3 class="font-semibold text-lg mb-2">Produk Original</h3>
                <p class="text-slate-600">Garansi resmi</p>
            </div>

        </div>
    </div>
</section>

<!-- CTA -->
<section class="py-20 bg-emerald-50">
    <div class="text-center max-w-3xl mx-auto px-6">
        <h2 class="text-3xl font-bold mb-4">
            Siap Mulai Belanja?
        </h2>
        <p class="text-slate-600 mb-8">
            Temukan produk favoritmu sekarang
        </p>
        <a href="<?= base_path('products') ?>"
           class="px-8 py-3 bg-emerald-800 text-white rounded-lg font-semibold hover:bg-emerald-900">
            Lihat Produk
        </a>
    </div>
</section>

<!-- FOOTER -->
<footer class="border-t border-slate-200 py-10">
    <div class="max-w-7xl mx-auto px-6 text-sm text-slate-600 text-center">
        © 2026 E-Commerce-App. All rights reserved.
    </div>
</footer>

</body>
</html>
