<?php
require_once 'db.php';

// Ambil semua tugas dari database
$stmt = $pdo->prepare("SELECT * FROM tasks ORDER BY id DESC");
$stmt->execute();
$tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplikasi To-Do List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            justify-content: center;
            padding-top: 50px;
        }
        .container {
            background: white;
            padding: 20px 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            width: 400px;
        }
        h2 { text-align: center; color: #333; }
        form { display: flex; gap: 10px; margin-bottom: 20px; }
        input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            padding: 8px 12px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover { background-color: #218838; }
        ul { list-style: none; padding: 0; }
        li {
            background: #f9f9f9;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .completed { text-decoration: line-through; color: #888; }
        .actions a {
            text-decoration: none;
            margin-left: 5px;
            padding: 4px 8px;
            border-radius: 3px;
            font-size: 12px;
            color: white;
        }
        .btn-status { background-color: #007bff; }
        .btn-delete { background-color: #dc3545; }
    </style>
</head>
<body>

<div class="container">
    <h2>To-Do List</h2>

    <!-- Form Tambah Tugas -->
    <form action="add.php" method="POST">
        <input type="text" name="task" placeholder="Tambah tugas baru..." required>
        <button type="submit">Tambah</button>
    </form>

    <!-- Daftar Tugas -->
    <ul>
        <?php if (count($tasks) > 0): ?>
            <?php foreach ($tasks as $row): ?>
                <li>
                    <span class="<?= $row['status'] === 'completed' ? 'completed' : '' ?>">
                        <?= htmlspecialchars($row['task']) ?>
                    </span>
                    <div class="actions">
                        <a href="update.php?id=<?= $row['id'] ?>" class="btn-status">
                            <?= $row['status'] === 'completed' ? 'Batal' : 'Selesai' ?>
                        </a>
                        <a href="delete.php?id=<?= $row['id'] ?>" class="btn-delete" onclick="return confirm('Hapus tugas ini?')">Hapus</a>
                    </div>
                </li>
            <?php endforeach; ?>
        <?php else: ?>
            <li style="justify-content: center; color: #777;">Belum ada tugas.</li>
        <?php endif; ?>
    </ul>
</div>

</body>
</html>