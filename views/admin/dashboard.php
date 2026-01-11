<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        .stats { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px; }
        .stat-card { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .stat-card h3 { color: #7f8c8d; font-size: 14px; margin-bottom: 10px; text-transform: uppercase; }
        .stat-card .number { font-size: 36px; font-weight: bold; color: #2c3e50; }
        .stat-card.blue .number { color: #3498db; }
        .stat-card.green .number { color: #27ae60; }
        .stat-card.orange .number { color: #e67e22; }
        .recent-orders { background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        .recent-orders h2 { margin-bottom: 20px; color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ecf0f1; }
        th { background: #f8f9fa; font-weight: bold; color: #2c3e50; }
        .status { padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        .status.pending { background: #fff3cd; color: #856404; }
        .status.processing { background: #cfe2ff; color: #084298; }
        .status.completed { background: #d1e7dd; color: #0f5132; }
        .btn { padding: 8px 15px; background: #3498db; color: white; text-decoration: none; border-radius: 4px; font-size: 14px; }
        .btn:hover { background: #2980b9; }
        .flash { background: #d1e7dd; color: #0f5132; padding: 15px; border-radius: 4px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏪 Admin Dashboard - E-Commerce App</h1>
    </div>
    
    <div class="nav">
        <a href="/e-commerce-app/public/admin/dashboard" class="active">Dashboard</a>
        <a href="/e-commerce-app/public/admin/products">Kelola Produk</a>
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

        <div class="stats">
            <div class="stat-card blue">
                <h3>Total Produk</h3>
                <div class="number"><?php echo $totalProducts; ?></div>
            </div>
            
            <div class="stat-card orange">
                <h3>Total Pesanan</h3>
                <div class="number"><?php echo $totalOrders; ?></div>
            </div>
            
            <div class="stat-card green">
                <h3>Total Revenue</h3>
                <div class="number">Rp <?php echo number_format($totalRevenue, 0, ',', '.'); ?></div>
            </div>
        </div>

        <div class="recent-orders">
            <h2>📦 Pesanan Terbaru</h2>
            
            <?php if(empty($recentOrders)): ?>
                <p style="color: #999; text-align: center; padding: 40px;">Belum ada pesanan</p>
            <?php else: ?>
                <table>
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recentOrders as $order): ?>
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