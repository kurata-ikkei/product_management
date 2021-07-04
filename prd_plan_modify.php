<?php //管理者もしくは一般ユーザー用ページ
session_start();

require_once('./php/funcs.php');

loginCheck();
$user_name = $_SESSION['name'];
$role_flg = $_SESSION['role_flg'];

if($role_flg ==='2'){
    redirect('./auth_ng.php');
}

$pdo = db_conn();

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM product WHERE id=:id;");
$stmt->bindValue(':id',$id,PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}


?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/prd_plan.css">
    <title>商品情報編集</title>
</head>
<body>
<header>
    <h1>Product Management Tool</h1>
    <p>user:  <?= $user_name.'('.$role_flg.')'?></p>
    <a href="./php/logout.php"><p>Log OUT</p></a>
</header>
<a href="./main.php">HOMEに戻る</a>
<div class="prd_reg">
    <h3>商品情報編集</h3>
    <form method="POST" action="./php/modify_item.php">
        <div>
            <fieldset>
                <table>
                <label><tr><th>item_no：</th><td><input type="text" name="item_no" value="<?= $result['item_no'] ?>"></td></tr></label>
                <label><tr><th>target_year：</th><td><input type="text" name="year" value="<?= $result['year'] ?>"></td></tr></label>
                <label><tr><th>target_season：</th><td><input type="text" name="season" value="<?= $result['season'] ?>"></td></tr></label>
                <label><tr><th>target_gender：</th>
                    <td>
                        <select name="gender">
                            <option value="wemens"<?php if ( $result['gender'] === 'wemens' ) { echo ' selected'; } ?>>Wemens</option>
                            <option value="mens"<?php if ( $result['gender'] === 'mens' ) { echo ' selected'; } ?>>Mens</option>
                            <option value="unisex"<?php if ( $result['gender'] === 'unisex' ) { echo ' selected'; } ?>>Unisex</option>    
                        </select>
                    </td></tr></label>
                <label><tr><th>item_cat：</th>
                    <td>
                        <select name="itemcat">
                            <option value="jacket"<?php if ( $result['category'] === 'jacket' ) { echo ' selected'; } ?>>JACKET</option>
                            <option value="pants"<?php if ( $result['category'] === 'pants' ) { echo ' selected'; } ?>>PANTS/BOTTOMS</option>
                            <option value="shirt"<?php if ( $result['category'] === 'shirt' ) { echo ' selected'; } ?>>SHIRT</option>    
                            <option value="coat-outer"<?php if ( $result['category'] === 'coat-outer' ) { echo ' selected'; } ?>>COAT/OUTER</option>    
                            <option value="knit"<?php if ( $result['category'] === 'knit' ) { echo ' selected'; } ?>>KNIT</option>    
                            <option value="blouse"<?php if ( $result['category'] === 'blouce' ) { echo ' selected'; } ?>>BLOUSE</option>    
                            <option value="skirt"<?php if ( $result['category'] === 'skirt' ) { echo ' selected'; } ?>>SKIRT</option>    
                            <option value="leggins"<?php if ( $result['category'] === 'leggins' ) { echo ' selected'; } ?>>LEGGINS</option>    
                            <option value="sport-bra"<?php if ( $result['category'] === 'sport-bra' ) { echo ' selected'; } ?>>SPO-BRA</option>    
                            <option value="vest"<?php if ( $result['category'] === 'vest' ) { echo ' selected'; } ?>>VEST-GILET</option>    
                            <option value="Tshirt"<?php if ( $result['category'] === 'Tshirt' ) { echo ' selected'; } ?>>T-SHIRT</option>    
                            <option value="one-piece"<?php if ( $result['category'] === 'one-piece' ) { echo ' selected'; } ?>>ONE-PIECE</option>    
                            <option value="good"<?php if ( $result['category'] === 'good' ) { echo ' selected'; } ?>>GOODS</option>    
                        </select>
                        </td></tr></label>
                <label><tr><th>item_genre：</th>
                    <td>
                    <select name="itemgenre">
                            <option value="athletic"<?php if ( $result['genre'] === 'athletic' ) { echo ' selected'; } ?>>Athletic</option>
                            <option value="business"<?php if ( $result['genre'] === 'business' ) { echo ' selected'; } ?>>Business</option>
                        </select>
                    </td></tr></label>
                <label><tr><th>item_name：</th><td><input type="text" name="itemname" value="<?= $result['item_name'] ?>"></td></tr></label>
                <label><tr><th>item_price：</th><td><input type="text" name="price" value="<?= $result['item_price'] ?>"></td></tr></label>
                <label><tr><th>memo:</th><td><textArea name="memo" rows="4" cols="40"><?= $result['memo'] ?></textArea></td></tr></label>
                </table>
                <input type="hidden" name="id" value="<?= $result['id'] ?>">
                <input type="submit" value="編集">
            </fieldset>
        </div>
    </form>
</div>