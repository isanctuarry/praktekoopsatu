<!DOCTYPE html>
<html>
<head>
    <title>Tambahkan Buku Baru</title>
</head>
<body>
    <h2>Form Tambah Buku</h2>
    <form action="BookController.php" method="POST">
        <label>Judul:</label>
        <input type="text" name="title" required><br><br>

        <label>Pengarang:</label>
        <input type="text" name="author" required><br><br>

        <input type="submit" value="Tambah Buku">
    </form>
</body>
</html>
