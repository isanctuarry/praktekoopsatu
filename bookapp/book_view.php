<!DOCTYPE html>
<html>
<head>
    <title>Buku Ditambahkan</title>
</head>
<body>
    <h2>Buku Berhasil Ditambahkan</h2>
    <p><strong>Judul:</strong> <?= htmlspecialchars($book->getTitle()) ?></p>
    <p><strong>Pengarang:</strong> <?= htmlspecialchars($book->getAuthor()) ?></p>

    <a href="book_form.php">Tambah Buku Lagi</a>
</body>
</html>
