<?php

include ("functions.php");
// POST COMMENT
if (isset($_GET['action']) && $_GET['action'] == 'post_comment') {
    
    echo "From: {$_POST['author']} <br>";
    echo "Comment: {$_POST['content']} <br>";
    echo "To comment id: {$_POST['parentId']} <br>";
    
    
    $level = 1;
    if ($_POST['parentId'] == 0) {
        $level = 1;
    }
    else {
        $query = "SELECT * FROM tree WHERE id=".mysqli_real_escape_string($link, $_POST['parentId'])." LIMIT 1";
        echo "parentId = ".$_POST['parentId']." <br>";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $level = $row['level'] + 1;
        }
        else {
            echo "Can't find parentId";
            exit();
        }
    }
    $query = "INSERT INTO tree(`author`, `comment`, `level`, `parentId`, `datetime`) VALUES ('".mysqli_real_escape_string($link, $_POST['author'])."', '".mysqli_real_escape_string($link, $_POST['content'])."', ".mysqli_real_escape_string($link, $level).", ".mysqli_real_escape_string($link, $_POST['parentId']).", '".date("Y-m-d H:i:s")."')";
    $result = mysqli_query($link, $query);
    
    
}
else if (isset($_GET['action']) && $_GET['action'] == 'delete_coment') {
    
    $query_delete_root = "DELETE FROM tree WHERE id=".mysqli_real_escape_string($link,$_POST['id']);
    $result_delete_root = mysqli_query($link, $query_delete_root);
    //echo $_POST['id'];
    deleteSubTree($_POST['id']);
    
    if ($result_delete_root) {
        echo "OK";
    }
    else {
        echo "Error: can't delete comments block.";
    }
}
    



?>
