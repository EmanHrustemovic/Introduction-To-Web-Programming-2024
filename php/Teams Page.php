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

function createTeam($team_name, $country_name, $group_id, $player_id, $player_full_name, $pdo) {
    $sql = "INSERT INTO teams (team_name, country_name, group_id, player_id, player_full_name) 
            VALUES (:team_name, :country_name, :group_id, :player_id, :player_full_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':team_name', $team_name);
    $stmt->bindParam(':country_name', $country_name);
    $stmt->bindParam(':group_id', $group_id);
    $stmt->bindParam(':player_id', $player_id);
    $stmt->bindParam(':player_full_name', $player_full_name);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function readTeams($pdo) {
    $sql = "SELECT * FROM teams";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateTeam($team_id, $team_name, $country_name, $group_id, $player_id, $player_full_name, $pdo) {
    $sql = "UPDATE teams SET team_name = :team_name, country_name = :country_name, 
            group_id = :group_id, player_id = :player_id, player_full_name = :player_full_name 
            WHERE team_id = :team_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':team_name', $team_name);
    $stmt->bindParam(':country_name', $country_name);
    $stmt->bindParam(':group_id', $group_id);
    $stmt->bindParam(':player_id', $player_id);
    $stmt->bindParam(':player_full_name', $player_full_name);
    $stmt->bindParam(':team_id', $team_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function deleteTeam($team_id, $pdo) {
    $sql = "DELETE FROM teams WHERE team_id = :team_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':team_id', $team_id);
    $stmt->execute();
    return $stmt->rowCount();
}

$team_id = createTeam("Germany Squad", "Germany", 1, 1, "Manuel Neuer", $pdo);

$teams = readTeams($pdo);
print_r($teams);

$updateResult = updateTeam($team_id, "Updated Team Name", "Updated Country Name", 2, 2, "Updated Player Name", $pdo);
echo "Updated rows: $updateResult";

$deleteResult = deleteTeam($team_id, $pdo);
echo "Deleted rows: $deleteResult";

?>
