<?php
session_start();
require_once("./funcs.php");

$prod_no = $_POST["prod_no"];
$id = $_POST["id"];


 if (isset($_FILES["image"] ) && $_FILES["image"]["error"] ==0 ) {
     $file_name = $_FILES["image"]["name"];
     $tmp_path  = $_FILES["image"]["tmp_name"];
     $extension = pathinfo($file_name, PATHINFO_EXTENSION);
     $file_name = date("YmdHis").md5(session_id()) . "." . $extension;

     $img="";
     $file_dir_path = "../img/".$file_name;

     echo $prod_no.$id.$file_dir_path;//ok

    if ( is_uploaded_file( $tmp_path ) ) {
        if ( move_uploaded_file( $tmp_path, $file_dir_path ) ) {
            chmod( $file_dir_path, 0644 );
                $pdo = db_conn();
                $sql = "INSERT INTO img_table(id,prod_no, img_path, upload_date) VALUES(null, :prod_no, :img, sysdate())";
                $stmt = $pdo->prepare($sql);
                $stmt->bindValue(':prod_no', $prod_no, PDO::PARAM_STR);
                $stmt->bindValue(':img', $file_name, PDO::PARAM_STR);
                $status = $stmt->execute();
                //データ登録処理後
                if ($status == false) {
                    sql_error($stmt);
                } else {
                    redirect('../prd_plan_modify.php?id='.$id);
                    //$img = '<img src=../"'.$file_dir_path.'">';
                }
        } else {
        }
     }


}else{
    $img = "画像が送信されていません";
}

?>