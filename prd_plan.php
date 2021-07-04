<?php
session_start();

require_once('./php/funcs.php');

loginCheck();
$user_name = $_SESSION['name'];
$role_flg = $_SESSION['role_flg'];


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
    $view .='<td><a href="./prd_plan_modify.php?id='.h($result['id']).'">編集</a></td>';
    $view .='<td><a href="./php/delete_item.php?id='.h($result['id']).'">削除</a></td>';
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
    <link rel="stylesheet" href="./css/prd_plan.css">
    <title>商品管理</title>
</head>
<body>
<header>
    <h1>Product Management Tool</h1>
    <p>user:  <?= $user_name.'('.$role_flg.')'?></p>
    <a href="./php/logout.php"><p>Log OUT</p></a>
</header>

<h2>商品管理</h2>
<a href="./main.php">HOMEに戻る</a>
<div class="prd_reg">
    <h3>商品登録</h3>
    <form method="POST" action="./php/prdregi.php">
        <div>
            <fieldset>
                <table>
                <label><tr><th>item_no：</th><td><input type="text" name="item_no"></td></tr></label>
                <label><tr><th>target_year：</th><td><input type="text" name="year"></td></tr></label>
                <label><tr><th>target_season：</th><td><input type="text" name="season"></td></tr></label>
                <label><tr><th>target_gender：</th>
                    <td>
                        <select name="gender">
                            <option value="wemens">Wemens</option>
                            <option value="mens">Mens</option>
                            <option value="unisex">Unisex</option>    
                        </select>
                    </td></tr></label>
                <label><tr><th>item_cat：</th>
                    <td>
                        <select name="itemcat">
                            <option value="jacket">JACKET</option>
                            <option value="pants">PANTS/BOTTOMS</option>
                            <option value="shirt">SHIRT</option>    
                            <option value="coat-outer">COAT/OUTER</option>    
                            <option value="knit">KNIT</option>    
                            <option value="blouse">BLOUSE</option>    
                            <option value="skirt">SKIRT</option>    
                            <option value="leggins">LEGGINS</option>    
                            <option value="sport-bra">SPO-BRA</option>    
                            <option value="vest">VEST-GILET</option>    
                            <option value="Tshirt">T-SHIRT</option>    
                            <option value="one-piece">ONE-PIECE</option>    
                            <option value="good">GOODS</option>    
                        </select>
                        </td></tr></label>
                <label><tr><th>item_genre：</th>
                    <td>
                    <select name="itemgenre">
                            <option value="athletic">Athletic</option>
                            <option value="business">Business</option>
                        </select>
                    </td></tr></label>
                <label><tr><th>item_name：</th><td><input type="text" name="itemname"></td></tr></label>
                <label><tr><th>item_price：</th><td><input type="text" name="price"></td></tr></label>
                <label><tr><th>memo:</th><td><textArea name="memo" rows="4" cols="40"></textArea></td></tr></label>
                </table>
                <input type="submit" value="登録">
            </fieldset>
        </div>
    </form>
</div>
<div class="csvdl">
    <button>csvダウンロード（未）</button>
</div>
<div class="csvul">
    <button>csv一括データ登録（未）</button>
</div>
<div class="list">
    <h3>登録済み商品一覧</h3>
    <table class="list_table">
        <tr>
            <th>ID</th>
            <th>NO</th>
            <th>CAT</th>
            <th>GENDER</th>
            <th>ITEM NAME</th>
            <th>ITEM PRICE</th>
            <th>編集ボタン</th>
            <th>削除ボタン</th>
            </tr>
            <?= $view ?>
    </table>
</div>




</body>
</html>