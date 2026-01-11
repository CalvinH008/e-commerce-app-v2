<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Produk - Admin</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; background: #f5f5f5; }
        .header { background: #2c3e50; color: white; padding: 20px; }
        .header h1 { font-size: 24px; }
        .nav { background: #34495e; padding: 15px 20px; }
        .nav a { color: white; text-decoration: none; margin-right: 20px; padding: 8px 15px; border-radius: 4px; }
        .nav a:hover { background: #2c3e50; }
        .nav a.active { background: #3498db; }
        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .page-header h2 { color: #2c3e50; }
        .btn { padding: 10px 20px; background: #27ae60; color: white; text-decoration: none; border-radius: 4px; border: none; cursor: pointer; }
        .btn:hover { background: #229954; }
        .btn-danger { background: #e74c3c; }
        .btn-danger:hover { background: #c0392b; }
        .btn-warning { background: #f39c12; }
        .btn-warning:hover { background: #d68910; }
        .products-table { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ecf0f1; }
        th { background: #f8f9fa; font-weight: bold; color: #2c3e50; }
        .product-image { width: 60px; height: 60px; background: #ddd; display: flex; align-items: center; justify-content: center; border-radius: 4px; font-size: 10px; color: #999; }
        .actions { display: flex; gap: 10px; }
        .flash { background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
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

        <div class="page-header">
            <h2>📦 Kelola Produk</h2>
            <a href="/e-commerce-app/public/admin/products/create" class="btn">+ Tambah Produk</a>
        </div>

        <div class="products-table">
            <?php if(empty($products)): ?>
                <p style="color: #999; text-align: center; padding: 40px;">Belum ada produk. Silakan tambah produk baru.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($products as $product): ?>
                            <tr>
                                <td><?php echo $product['id']; ?></td>
                                <td>
                                    <div class="product-image">
                                        <?php echo $product['image'] ?? 'No Image'; ?>
                                    </div>
                                </td>
                                <td><strong><?php echo htmlspecialchars($product['name']); ?></strong></td>
                                <td>Rp <?php echo number_format($product['price'], 0, ',', '.'); ?></td>
                                <td><?php echo $product['stock']; ?> unit</td>
                                <td>
                                    <div class="actions">
                                        <a href="/e-commerce-app/public/admin/products/edit?id=<?php echo $product['id']; ?>" class="btn btn-warning">Edit</a>
                                        <form method="POST" action="/e-commerce-app/public/admin/products/delete" style="display: inline;">
                                            <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin hapus produk ini?')">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>