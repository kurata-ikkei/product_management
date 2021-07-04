<?php
//ログイン不要ページ
require_once('./php/funcs.php');

$pdo = db_conn();
//２．SQL文を用意(データ取得：SELECT)
$stmt = $pdo->prepare("SELECT * FROM product");
//3. 実行
$status = $stmt->execute();

//4．データ表示
$view="";
if($status==false) {
    sql_error($stmt);
}else{
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){ 
    $view .="<tr>";
    $view .= "<td>".h($result['id']).'</td><td>'.h($result['item_no']).'</td><td>'.h($result['category']).'</td><td>'.h($result['gender']).'</td><td>'.h($result['item_name']).'</td><td>'.h($result['item_price']).'</td>';
    $view .='<td><a href="./detail.php?id='.h($result['id']).'">詳細を確認</a></td>';
    $view .="</tr>";
    }
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/select.css">
    <title>商品一覧</title>
</head>
<body>
<h2><a href="./login.php">ログインページに戻る</a></h2>
<h1>現在展開している商品はこちら</h1>


<div class="list">
    <h3>商品一覧</h3>
    <table class="list_table">
        <tr>
            <th>ID</th>
            <th>NO</th>
            <th>CATEGORY</th>
            <th>GENDER</th>
            <th>ITEM NAME</th>
            <th>ITEM PRICE</th>
            <th>DETAIL</th>
            </tr>
            <?= $view ?>
    </table>
</div>

</body>
</html>