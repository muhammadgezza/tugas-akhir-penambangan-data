<?php
session_start();

require 'vendor/autoload.php'; // Pastikan autoload PhpSpreadsheet disertakan di sini
use PhpOffice\PhpSpreadsheet\IOFactory;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_FILES['file']) && $_FILES['file']['error'] == UPLOAD_ERR_OK) {
        $uploadDir = 'data/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Buat folder jika belum ada
        }
        $fileName = basename($_FILES['file']['name']);
        $uploadFilePath = $uploadDir . $fileName;

        // Periksa ekstensi file
        $fileType = pathinfo($uploadFilePath, PATHINFO_EXTENSION);
        if ($fileType == 'xlsx') {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath)) {
                $uploadSuccess = true;
                $uploadedFilePath = $uploadFilePath;
            } else {
                $uploadError = "Terjadi kesalahan saat mengunggah file.";
            }
        } else {
            $uploadError = "Hanya file .xlsx yang diizinkan.";
        }
    } else {
        $uploadError = "Tidak ada file yang diunggah atau terjadi kesalahan.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Dashboard | By Code Info</title>
  <link rel="stylesheet" href="style.css" />
  <!-- Font Awesome Cdn Link -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
  <link rel="stylesheet" href="https://pyscript.net/snapshots/2023.09.1.RC2/core.css">
        <!-- This script tag bootstraps PyScript -->
        <script type="module" src="https://pyscript.net/snapshots/2023.09.1.RC2/core.js"></script>
</head>
<body>
  <div class="container">
    <section class="main">
      <div class="main-top">
        <h1>Penambangan Data Memprediksi Bahan Baku dan Penjualan Menggunakan Metode ARIMA</h1>
      </div>
      
      <section class="main-course">
        <div class="course-box">
            <?php
            if (isset($uploadError)) {
                echo "<p style='color: red;'>$uploadError</p>";
            }
            if (isset($uploadSuccess) && $uploadSuccess) {
                echo "<p style='color: green;'>File berhasil diunggah ke folder: $uploadDir</p>";
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <label for="file">INPUT FILE (.xlsx):</label><br><br>
                <input type="file" name="file" id="file" accept=".xlsx" required><br><br>
                <button type="submit">Upload</button>
            </form>
        </div>
</body>
</html>