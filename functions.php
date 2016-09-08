<?php

$link = mysqli_connect("localhost", "cl51-comment-5wa", "XjttVYyX^", "cl51-comment-5wa");

if (mysqli_error($link)) {
    die("Couldn't connect to database");
}




$error = "";

function maxId() {
    global $link;
    $query_max = "SELECT * FROM tree ORDER BY `id` DESC LIMIT 1";
    $result_max = mysqli_query($link, $query_max);
    if ($result_max) {
        $max = mysqli_fetch_array($result_max);
        return $max['id'];
    }
    else return "";
}


function time_since($since) {
    $chunks = array(
        array(60 * 60 * 24 * 365 , 'year'),
        array(60 * 60 * 24 * 30 , 'month'),
        array(60 * 60 * 24 * 7, 'week'),
        array(60 * 60 * 24 , 'day'),
        array(60 * 60 , 'hour'),
        array(60 , 'minute'),
        array(1 , 'second')
    );

    for ($i = 0, $j = count($chunks); $i < $j; $i++) {
        $seconds = $chunks[$i][0];
        $name = $chunks[$i][1];
        if (($count = floor($since / $seconds)) != 0) {
            break;
        }
    }

    $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
    return $print;
}

function printComment(& $comment) {
    global $link;
    $str = '';
    $str .= '<div class="comment" data-level="'.$comment['level'].'" data-commentId="'.$comment['id'].'"><strong>commentID: </strong>'.mysqli_real_escape_string($link, $comment['id']).'<br>';
    $str .=  '<strong>From</strong>: '.mysqli_real_escape_string($link, $comment['author']);
    $str .= '<small class="form-text text-muted time">'.time_since(time() - strtotime($comment['datetime'])).' ago</small>';
    $str .= '<p><strong>Comment</strong>: '.mysqli_real_escape_string($link, $comment['comment']).'</p>';
    
    $str.= '<div class="row"><div class="col-xs-6">';
    
    $str.= '<p class="commentButton" data-toggle="modal" data-target="#commentModal">Comment</p></div>';
    
    $str.= '<div class="col-xs-6"><p class="deleteButton" data-commentId="'.$comment['id'].'">Delete</p></div></div>';
    
    
    $str.= '</div>';
    return $str;
}


function deleteSubTree($rootId) {
    global $link;
//    $query_root = "DELETE FROM tree WHERE id=".mysqli_real_escape_string($link, $rootId)." LIMIT 1";
//    $result_root = mysqli_query($link, $query_root);
    
    $query_childs = "SELECT * FROM tree WHERE parentId=".mysqli_real_escape_string($link, $rootId);
    $result_childs = mysqli_query($link, $query_childs);
    if ($result_childs) {
        while ($child = mysqli_fetch_array($result_childs)) {
            $query_child_delete = "DELETE FROM tree WHERE id=".mysqli_real_escape_string($link, $child['id']);
            $result_child_delete = mysqli_query($link, $query_child_delete);
            //echo "deleted";
            deleteSubTree($child['id']);

        }
    }
    else echo "WRONG";
}

function displaySubTree($rootId) {
    global $link;
    $query_root = "SELECT * FROM tree WHERE id=".mysqli_real_escape_string($link, $rootId)." LIMIT 1";
    $result_root = mysqli_query($link, $query_root);
    if (mysqli_num_rows($result_root) > 0) {
        $root = mysqli_fetch_array($result_root); 
        echo printComment($root);
        
        $query_childs = "SELECT * FROM tree WHERE parentId=".mysqli_real_escape_string($link, $rootId)." ORDER BY `level`, `datetime` DESC";
        $result_childs = mysqli_query($link, $query_childs);
        if (mysqli_num_rows($result_childs)) {
            while ($child = mysqli_fetch_array($result_childs) ) {
                displaySubTree($child['id']);
            }
        }
    }
}
function displayTree($parentId) {
    global $link;
    $query = "SELECT * FROM tree WHERE parentId=".mysqli_real_escape_string($link, $parentId)." ORDER BY `level`, `datetime` DESC";
    $result = mysqli_query($link, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result))
            displaySubTree($row['id']);
    }
}

if (isset($_GET['function']) && $_GET['function'] == 'maxId') {
    $maxId = maxId();
    if ($maxId != "") {
        echo $maxId;
    }
    
}


?>
