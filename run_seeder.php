<?php

// Database configuration
$host = 'localhost';
$db = 'e-commerce-app';
$user = 'root';
$pass = '';

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);

// Check connection
if (!$conn) {
    die("❌ Koneksi gagal: " . mysqli_connect_error());
}

echo "✅ Koneksi database berhasil\n\n";

// Read SQL file
$sql_file = __DIR__ . '/seeder.sql';

if (!file_exists($sql_file)) {
    die("❌ File seeder.sql tidak ditemukan\n");
}

$sql = file_get_contents($sql_file);

// Bagi query per statement
$queries = array_filter(array_map('trim', explode(';', $sql)));

$success_count = 0;
$error_count = 0;

foreach ($queries as $query) {
    if (empty($query)) {
        continue;
    }
    
    if (mysqli_query($conn, $query)) {
        $success_count++;
    } else {
        echo "⚠️ Error: " . mysqli_error($conn) . "\n";
        echo "Query: " . substr($query, 0, 100) . "...\n\n";
        $error_count++;
    }
}

mysqli_close($conn);

echo "\n" . str_repeat("=", 50) . "\n";
echo "✅ Seeding Selesai!\n";
echo "✓ Query berhasil: $success_count\n";
if ($error_count > 0) {
    echo "⚠️ Query error: $error_count\n";
}
echo str_repeat("=", 50) . "\n";

?>
