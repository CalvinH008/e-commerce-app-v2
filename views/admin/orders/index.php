<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Pesanan - Admin</title>
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
        .page-header { margin-bottom: 30px; }
        .page-header h2 { color: #2c3e50; }
        .orders-table { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ecf0f1; }
        th { background: #f8f9fa; font-weight: bold; color: #2c3e50; }
        .status { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cfe2ff; color: #084298; }
        .status.completed { background: #d1e7dd; color: #0f5132; }
        .status.cancelled { background: #f8d7da; color: #842029; }
        .btn { padding: 8px 15px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; border: none; cursor: pointer; }
        .btn:hover { background: #2980b9; }
        .flash { background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏪 Admin Dashboard - E-Commerce App</h1>
    </div>
    
    <div class="nav">
        <a href="/e-commerce-app/public/admin/dashboard">Dashboard</a>
        <a href="/e-commerce-app/public/admin/products">Kelola Produk</a>
        <a href="/e-commerce-app/public/admin/orders" class="active">Kelola Pesanan</a>
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
            <h2>🛒 Kelola Pesanan</h2>
        </div>

        <div class="orders-table">
            <?php if(empty($orders)): ?>
                <p style="color: #999; text-align: center; padding: 40px;">Belum ada pesanan.</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status Order</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                            <tr>
                                <td>#<?php echo $order['id']; ?></td>
                                <td><?php echo htmlspecialchars($order['username']); ?></td>
                                <td>Rp <?php echo number_format($order['total'], 0, ',', '.'); ?></td>
                                <td>
                                    <span class="status <?php echo $order['status']; ?>">
                                        <?php echo strtoupper($order['status']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('d/m/Y H:i', strtotime($order['created_at'])); ?></td>
                                <td>
                                    <a href="/e-commerce-app/public/admin/orders/detail?id=<?php echo $order['id']; ?>" class="btn">Detail</a>
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