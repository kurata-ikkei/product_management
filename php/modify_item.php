<?php
require_once('./funcs.php');

// 1. POSTデータ取得
$id = $_POST["id"];
$itemno = $_POST["item_no"];
$year = $_POST["year"];
$season = $_POST["season"];
$gender = $_POST["gender"];
$itemcat = $_POST["itemcat"];
$itemgenre = $_POST["itemgenre"];
$itemname = $_POST["itemname"];
$price = $_POST["price"];
$memo = $_POST["memo"];


$pdo = db_conn();

//SQL
    $stmt = $pdo->prepare(
        "UPDATE product 
        SET item_no = :item_no, year = :year, season = :season, genre = :genre, gender = :gender, category = :category, item_name = :item_name, item_price = :item_price, memo = :memo, update_data = sysdate() 
        WHERE id = :id;" 
        );

//bind
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);        
    $stmt->bindValue(':item_no', $itemno, PDO::PARAM_STR);
    $stmt->bindValue(':year', $year, PDO::PARAM_STR);
    $stmt->bindValue(':season', $season, PDO::PARAM_STR);
    $stmt->bindValue(':genre', $itemgenre, PDO::PARAM_STR);
    $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':category', $itemcat, PDO::PARAM_STR);
    $stmt->bindValue(':item_name', $itemname, PDO::PARAM_STR);
    $stmt->bindValue(':item_price', $price, PDO::PARAM_INT);
    $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);

//SQL go
    $status = $stmt->execute();

//update
    if($status==false){
    sql_error($stmt);
    }else{
//redirect
    redirect('../prd_plan.php');
    }
?>
