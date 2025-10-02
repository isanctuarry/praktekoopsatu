<?php
// Daftar file latihan  
$latihan = [
    "praktikumlima.php"=> "Tugas Praktikum 5",
    "tugasoopteori2.php" => "Tugas 2 Teori",
    "tugasoopteori3.php" => "Tugas 3 Teori",
    "praktikumlima2.php"=> "Tugas Praktikum 5 pt 2",
    "praktikum6.php" => "Tugas Praktikum 6",
    "petadoption/petadoption.php"=> "Praktikum 7: Pet Adoption",
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Praktikum OOP</title>
     <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&family=Poppins:wght@300;500&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: Poppins; 
            margin: 0; 
            background: #f9f9f9; 
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        h1 { 
            color: #fdb2b2ff; 
            font-family: Poppins;
            text-align: center;
        }

        ul {
            list-style: none;
             padding: 0; 
             margin: 0;
            }

        li { 
            margin: 15px 0;
            }
            
        a { 
            text-decoration: none; 
            color: white; 
            background: #fcbae0ff; 
            padding: 10px 15px; 
            border-radius: 5px; 
            display: inline-block;  
            align-items: center;
        }
        a:hover { background: #f174e8ff; }
        
    </style>
</head>
<body>
    <h1>Daftar Latihan OOP</h1>
    <ul>
        <?php foreach ($latihan as $file => $judul): ?>
            <li><a href="<?= $file ?>"><?= $judul ?></a></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
