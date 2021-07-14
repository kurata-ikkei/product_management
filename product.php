<?php
require_once('./php/funcs.php');

$pdo = db_conn();

$item_no = $_GET['no'];

$stmt = $pdo->prepare("SELECT * FROM product WHERE item_no=:item_no;");
$stmt->bindValue(':item_no',$item_no,PDO::PARAM_STR);
$status = $stmt->execute();


$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();

    $prod_no = $result["item_no"];
    $stmt2 = $pdo->prepare("SELECT * FROM img_table WHERE prod_no=:prod_no");
    $stmt2->bindValue(':prod_no',$prod_no,PDO::PARAM_STR);
    $status = $stmt2->execute();

    $image="";
    if($status==false) {
        sql_error();
    }else{
        while( $r = $stmt2->fetch(PDO::FETCH_ASSOC)){ 
        $image .= '<p><img src="img/'.$r["img_path"].'"></p>';
  }

}
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/product.css">
    <title>商品詳細ページ</title>
</head>
<body>
<h1>商品詳細ページ</h1>
<div class="wrapper">
    <div class="image">
        <?= $image ?>
    </div>
    <div class="info">
        <h3>商品番号：<br><?= $result['item_no']?></h3>
        <h3>商品名：<br><?= $result['item_name']?></h3>
        <h3>価格（税込）<br><?= $result['item_price']?>JPY</h3>
        <h3>商品説明：<br><?= $result['memo']?></h3>
        <select name="amount" id="amount">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>
        <button>カートに追加（見た目だけ）</button>
    </div>
</div>
</body>
</html>