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

function createGroup($group_name, $pdo) {
    $sql = "INSERT INTO uefa_groups (group_name) VALUES (:group_name)";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':group_name', $group_name);
    $stmt->execute();
    return $pdo->lastInsertId();
}

function readGroups($pdo) {
    $sql = "SELECT * FROM uefa_groups";
    $stmt = $pdo->query($sql);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function updateGroup($group_id, $group_name, $pdo) {
    $sql = "UPDATE uefa_groups SET group_name = :group_name WHERE group_id = :group_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':group_name', $group_name);
    $stmt->bindParam(':group_id', $group_id);
    $stmt->execute();
    return $stmt->rowCount();
}

function deleteGroup($group_id, $pdo) {
    $sql = "DELETE FROM uefa_groups WHERE group_id = :group_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':group_id', $group_id);
    $stmt->execute();
    return $stmt->rowCount();
}

$group_id = createGroup("Group G", $pdo);

$groups = readGroups($pdo);
print_r($groups);

$updateResult = updateGroup($group_id, "Group H", $pdo);
echo "Updated rows: $updateResult";

$deleteResult = deleteGroup($group_id, $pdo);
echo "Deleted rows: $deleteResult";

?>
