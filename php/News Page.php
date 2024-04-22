<?php

$host = 'localhost';
$dbname = 'uefa_euro';
$username = 'root';
$password = 'g3c9h.,1?0';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function createNews($description, $match_id, $result, $pdo) {
    $sql = "INSERT INTO news (description, match_id, result) 
            VALUES (:description, :match_id, :result)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':match_id', $match_id);
    $stmt->bindParam(':result', $result);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function readNews($pdo) {
    $sql = "SELECT * FROM news";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateNews($news_id, $description, $match_id, $result, $pdo) {
    $sql = "UPDATE news SET description = :description, match_id = :match_id, result = :result WHERE news_id = :news_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':match_id', $match_id);
    $stmt->bindParam(':result', $result);
    $stmt->bindParam(':news_id', $news_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function deleteNews($news_id, $pdo) {
    $sql = "DELETE FROM news WHERE news_id = :news_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':news_id', $news_id);
    $stmt->execute();
    return $stmt->rowCount();
}

$news_id = createNews("Coach of Bosnia and Herzegovina after reaching the Euro: \"The whole nation is proud, this is a historic success.\"", 1, "2-1", $pdo);

$news = readNews($pdo);
print_r($news);

$updateResult = updateNews($news_id, "Updated description", 2, "3-2", $pdo);
echo "Updated rows: $updateResult";

$deleteResult = deleteNews($news_id, $pdo);
echo "Deleted rows: $deleteResult";

?>
