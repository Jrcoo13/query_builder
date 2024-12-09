<?php
require_once 'Database.php';

header('Content-Type: application/json');

$query = 'SELECT * FROM student';
$stmt = $pdo->prepare($query);
$stmt->execute();

$data = [];
if ($stmt->rowCount() > 0) {
    foreach ($stmt as $row) {
        $data[] = $row;
    }
}
echo json_encode($data);