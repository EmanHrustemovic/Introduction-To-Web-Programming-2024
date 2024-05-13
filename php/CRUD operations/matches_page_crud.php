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

function createMatch($home_team_id, $away_team_id, $match_date, $match_time, $result, $group_id, $pdo) {
    $sql = "INSERT INTO matches (home_team_id, away_team_id, match_date, match_time, result, group_id) 
            VALUES (:home_team_id, :away_team_id, :match_date, :match_time, :result, :group_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':home_team_id', $home_team_id);
    $stmt->bindParam(':away_team_id', $away_team_id);
    $stmt->bindParam(':match_date', $match_date);
    $stmt->bindParam(':match_time', $match_time);
    $stmt->bindParam(':result', $result);
    $stmt->bindParam(':group_id', $group_id);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function readMatches($pdo) {
    $sql = "SELECT * FROM matches";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateMatch($match_id, $result, $pdo) {
    $sql = "UPDATE matches SET result = :result WHERE match_id = :match_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':result', $result);
    $stmt->bindParam(':match_id', $match_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function deleteMatch($match_id, $pdo) {
    $sql = "DELETE FROM matches WHERE match_id = :match_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':match_id', $match_id);
    $stmt->execute();
    return $stmt->rowCount();
}

$match_id = createMatch(1, 2, '2024-04-21', '12:00', '1-0', 1, $pdo);

$matches = readMatches($pdo);
print_r($matches);

$updateResult = updateMatch($match_id, '2-1', $pdo);
echo "Updated rows: $updateResult";

$deleteResult = deleteMatch($match_id, $pdo);
echo "Deleted rows: $deleteResult";

?>
