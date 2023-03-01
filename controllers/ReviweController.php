<?php
include_once($_SERVER['DOCUMENT_ROOT'] . '/models/ReviweModel.php');

if(isset($_REQUEST['text_review'])){
    $text = trim(filter_var($_POST['text_review'], FILTER_SANITIZE_SPECIAL_CHARS));

    $status = [];
    if (empty($text)){
        $status['error'] = 'Заповніть полe';
    }
    else if(mb_strlen($text) < 2) {
        $status['error'] = 'Коментарій  закороткий';
    }

    if($status != null){
        echo json_encode($status);
        exit();
    }else{
        session_start();
        // потрібно вставити в class="userr">
        $nameUser = $_SESSION['user_id'];
        $sql = "SELECT user FROM users WHERE id = $nameUser";
        $res = $db->prepare($sql);
        $res->execute();
        $row_user = $res->fetch();

        $status['userName'] = $row_user['user'];
        $status['text'] = $text;

        $fields = ['id_user' => $nameUser,
            'text' => $text
        ];

        $sql = "INSERT INTO reviews (`id_user`, `text`) VALUES (:id_user, :text)";
        dbRequest($sql, $fields);
        $status['message'] = "Your commit is done!";
        $status['Done'] = 1;
        echo  json_encode($status);
    }

}