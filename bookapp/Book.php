<?php 
class Book {
    private string $title;
    private string $author;

    public function __construct(string $title, string $author) {
        if (empty(trim($title)) || empty(trim($author))) {
            throw new Exception("Judul dan Penulis tidak boleh kosong.");
        }

        $this->title = $title;
        $this->author = $author;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): string {
        return $this->author;
    }
}

?>