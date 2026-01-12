<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #2c3e50; color: white; padding: 20px; }
        .header h1 { font-size: 24px; }
        .nav { background: #34495e; padding: 15px 20px; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 15px; border-radius: 4px; }
        .nav a:hover { background: #2c3e50; }
        .nav a.active { background: #3498db; }
        .container { max-width: 800px; margin: 30px auto; padding: 0 20px; }
        .form-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .form-container h2 { margin-bottom: 25px; color: #2c3e50; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-weight: bold; color: #2c3e50; }
        .form-group input, .form-group textarea { width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; }
        .form-group textarea { min-height: 100px; resize: vertical; }
        .form-actions { display: flex; gap: 10px; margin-top: 25px; }
        .btn { padding: 12px 30px; border: none; border-radius: 4px; cursor: pointer; font-size: 14px; text-decoration: none; display: inline-block; }
        .btn-primary { background: #27ae60; color: white; }
        .btn-primary:hover { background: #229954; }
        .btn-secondary { background: #95a5a6; color: white; }
        .btn-secondary:hover { background: #7f8c8d; }
        .flash { background: #f8d7da; color: #842029; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏪 Admin Dashboard - E-Commerce App</h1>
    </div>
    
    <div class="nav">
        <a href="/e-commerce-app/public/admin/dashboard">Dashboard</a>
        <a href="/e-commerce-app/public/admin/products" class="active">Kelola Produk</a>
        <a href="/e-commerce-app/public/admin/orders">Kelola Pesanan</a>
        <a href="/e-commerce-app/public/products">Lihat Website</a>
        <a href="/e-commerce-app/public/logout">Logout</a>
    </div>

    <div class="container">
        <?php if(isset($_SESSION['flash'])): ?>
            <div class="flash">
                <?php 
                echo $_SESSION['flash']; 
                unset($_SESSION['flash']);
                ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <h2>➕ Tambah Produk Baru</h2>
            
            <form method="POST" action="/e-commerce-app/public/admin/products/store">
                <div class="form-group">
                    <label>Nama Produk *</label>
                    <input type="text" name="name" required placeholder="Masukkan nama produk">
                </div>

                <div class="form-group">
                    <label>Harga (Rp) *</label>
                    <input type="number" name="price" required min="0" placeholder="Masukkan harga">
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" placeholder="Masukkan deskripsi produk"></textarea>
                </div>

                <div class="form-group">
                    <label>Gambar (nama file)</label>
                    <input type="text" name="image" placeholder="Contoh: laptop-asus.jpg">
                    <small style="color: #666;">Untuk sementara cukup tulis nama file gambar</small>
                </div>

                <div class="form-group">
                    <label>Stok *</label>
                    <input type="number" name="stock" required min="0" value="0" placeholder="Masukkan jumlah stok">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">Simpan Produk</button>
                    <a href="/e-commerce-app/public/admin/products" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>