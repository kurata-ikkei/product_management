<?php
require_once('./funcs.php');

// 1. POSTデータ取得
$itemno = $_POST["item_no"];
$year = $_POST["year"];
$season = $_POST["season"];
$gender = $_POST["gender"];
$itemcat = $_POST["itemcat"];
$itemgenre = $_POST["itemgenre"];
$itemname = $_POST["itemname"];
$price = $_POST["price"];
$memo = $_POST["memo"];
//受け取り確認
// echo $year."<br>";
// echo $season."<br>";
// echo $gender."<br>";
// echo $itemcat."<br>";
// echo $itemgenre."<br>";
// echo $itemname."<br>";
// echo $price."<br>";
// echo $memo;


// 2. DB接続します
$pdo = db_conn();

// // ３．SQL文を用意(データ登録：INSERT)
    $stmt = $pdo->prepare(
   "INSERT INTO product(id, item_no, year, season, genre, gender, category, item_name, item_price, memo, created_date, update_data)
    VALUES(NULL, :item_no, :year, :season, :genre, :gender,:category, :item_name, :item_price, :memo, sysdate(), sysdate())"
    );

// // 4. バインド変数を用意(SQLインジェクション対策)
    $stmt->bindValue(':item_no', $itemno, PDO::PARAM_STR);
    $stmt->bindValue(':year', $year, PDO::PARAM_STR);
    $stmt->bindValue(':season', $season, PDO::PARAM_STR);
    $stmt->bindValue(':genre', $itemgenre, PDO::PARAM_STR);
    $stmt->bindValue(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindValue(':category', $itemcat, PDO::PARAM_STR);
    $stmt->bindValue(':item_name', $itemname, PDO::PARAM_STR);
    $stmt->bindValue(':item_price', $price, PDO::PARAM_INT);
    $stmt->bindValue(':memo', $memo, PDO::PARAM_STR);

// // 5. 実行
    $status = $stmt->execute();

// // 6．データ登録処理後
    if($status==false){
    sql_error($stmt);
    }else{
//５．リダイレクト
    redirect('../prd_plan.php');
    }
?>
