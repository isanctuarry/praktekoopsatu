<?php
require_once 'Book.php';

class BookController {
    public function addBook(string $title, string $author) {
        try {
            // Buat objek Book
            $book = new Book($title, $author);

            $this->renderView($book);

        } catch (Exception $e) {
            // Logging error ke file
            error_log("[" . date('Y-m-d H:i:s') . "] Error: " . $e->getMessage() . "\n", 3, "error.log");

            // Pesan error ke user
            echo "<h3>Terjadi kesalahan: " . htmlspecialchars($e->getMessage()) . "</h3>";
        } finally {}
    }

    public function renderView(Book $book) {
        include 'book_view.php';
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new BookController();
    $controller->addBook($_POST['title'] ?? '', $_POST['author'] ?? '');
}
?>
