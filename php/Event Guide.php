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

function createEvent($city_name, $match_id, $pdo) {
    $sql = "INSERT INTO event (city_name, match_id) VALUES (:city_name, :match_id)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':city_name', $city_name);
    $stmt->bindParam(':match_id', $match_id);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function readEvents($pdo) {
    $sql = "SELECT * FROM event";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateEvent($event_id, $city_name, $match_id, $pdo) {
    $sql = "UPDATE event SET city_name = :city_name, match_id = :match_id WHERE event_id = :event_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':city_name', $city_name);
    $stmt->bindParam(':match_id', $match_id);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function deleteEvent($event_id, $pdo) {
    $sql = "DELETE FROM event WHERE event_id = :event_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();
    return $stmt->rowCount();
}

$event_id = createEvent("Berlin", 1, $pdo);

$events = readEvents($pdo);
print_r($events);

$updateResult = updateEvent($event_id, "Leipzig", 2, $pdo);
echo "Updated rows: $updateResult";

$deleteResult = deleteEvent($event_id, $pdo);
echo "Deleted rows: $deleteResult";

?>
