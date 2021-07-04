<?php
//get id
$id   = $_GET['id'];

//DB connect
require_once('funcs.php');
$pdo = db_conn();

//SQL
$stmt = $pdo->prepare("DELETE FROM product WHERE id = :id");
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//redirect
if ($status == false) {
    sql_error($stmt);
} else {
    redirect('../prd_plan.php');
}
