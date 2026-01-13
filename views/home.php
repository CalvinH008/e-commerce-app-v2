<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce-App - Online Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-50">
    <!-- Navigation Header -->
    <nav class="bg-white border-b border-slate-200 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <a href="<?= base_path('') ?>" class="text-2xl font-bold text-slate-900">
                    E-Commerce-App
                </a>
                <div class="hidden md:flex gap-8">
                    <a href="<?= base_path('products') ?>" class="text-slate-600 hover:text-slate-900 transition">Produk</a>
                    <?php if(isset($_SESSION['user'])): ?>
                        <a href="<?= base_path('cart') ?>" class="text-slate-600 hover:text-slate-900 transition">Keranjang</a>
                        <a href="<?= base_path('dashboard') ?>" class="text-slate-600 hover:text-slate-900 transition">Dashboard</a>
                        <?php if($_SESSION['user']['role'] === 'admin'): ?>
                            <a href="<?= base_path('admin/dashboard') ?>" class="text-slate-600 hover:text-slate-900 transition">Admin</a>
                        <?php endif; ?>
                        <a href="<?= base_path('logout') ?>" class="text-slate-600 hover:text-slate-900 transition">Logout</a>
                    <?php else: ?>
                        <a href="<?= base_path('login') ?>" class="text-slate-600 hover:text-slate-900 transition">Masuk</a>
                        <a href="<?= base_path('register') ?>" class="px-6 py-2 bg-slate-900 text-white rounded-lg hover:bg-slate-800 transition">Daftar</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-slate-900 to-slate-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div>
                    <h1 class="text-5xl font-bold mb-6">Belanja Mudah, Aman, Terpercaya</h1>
                    <p class="text-lg text-slate-200 mb-8">Temukan ribuan produk berkualitas dengan harga terbaik. Pengiriman cepat ke seluruh Indonesia.</p>
                    <div class="flex gap-4">
                        <a href="<?= base_path('products') ?>" class="px-8 py-3 bg-white text-slate-900 font-semibold rounded-lg hover:bg-slate-100 transition">
                            Mulai Belanja
                        </a>
                        <?php if(!isset($_SESSION['user'])): ?>
                            <a href="<?= base_path('register') ?>" class="px-8 py-3 border-2 border-white text-white font-semibold rounded-lg hover:bg-slate-800 transition">
                                Daftar Gratis
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="bg-gradient-to-br from-slate-700 to-slate-600 rounded-lg h-96 flex items-center justify-center">
                    <span class="text-slate-400 text-lg">Featured Products</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center">
                <div class="w-16 h-16 bg-slate-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🚚</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Pengiriman Cepat</h3>
                <p class="text-slate-600">Pengiriman ekspres ke seluruh Indonesia dengan tracking real-time</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-slate-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">🛡️</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Aman & Terpercaya</h3>
                <p class="text-slate-600">Transaksi aman dengan enkripsi tingkat bank</p>
            </div>

            <div class="text-center">
                <div class="w-16 h-16 bg-slate-900 text-white rounded-full flex items-center justify-center mx-auto mb-4">
                    <span class="text-2xl">💯</span>
                </div>
                <h3 class="text-lg font-semibold text-slate-900 mb-2">Produk Original</h3>
                <p class="text-slate-600">100% produk original dengan garansi resmi</p>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-slate-100 py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Siap Belanja Sekarang?</h2>
            <p class="text-slate-600 mb-8">Jelajahi ribuan produk pilihan dengan harga terbaik</p>
            <a href="<?= base_path('products') ?>" class="inline-block px-8 py-3 bg-slate-900 text-white font-semibold rounded-lg hover:bg-slate-800 transition">
                Lihat Semua Produk
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-900 text-slate-300 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div>
                    <h3 class="text-white font-semibold mb-4">Tentang E-Commerce-App</h3>
                    <p class="text-sm">Platform e-commerce terpercaya untuk kebutuhan belanja online Anda</p>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Kategori</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Elektronik</a></li>
                        <li><a href="#" class="hover:text-white transition">Fashion</a></li>
                        <li><a href="#" class="hover:text-white transition">Rumah Tangga</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Bantuan</h3>
                    <ul class="space-y-2 text-sm">
                        <li><a href="#" class="hover:text-white transition">Hubungi Kami</a></li>
                        <li><a href="#" class="hover:text-white transition">FAQ</a></li>
                        <li><a href="#" class="hover:text-white transition">Kebijakan</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-4">Kontak</h3>
                    <ul class="space-y-2 text-sm">
                        <li>Email: support@ecommerceapp.com</li>
                        <li>Telp: 0812-3456-7890</li>
                        <li>Jam: 09:00 - 18:00 WIB</li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-8 text-center text-sm">
                <p>&copy; 2026 E-Commerce-App. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>
</body>
</html>