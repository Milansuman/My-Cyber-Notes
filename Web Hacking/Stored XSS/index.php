<?php
$commentdb = new SQLite3("comments.db");
if(isset($_POST["comment_box"])){
    $commentdb->query("INSERT INTO comments(id, comment) VALUES (" . rand(1, 1000) . ", \"" . $_POST["comment_box"] . "\");");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stored XSS Example</title>
    <style>
        body{
            background-color: #222222;
            display: flex;
            color: #efefef;
            align-items: center;
            flex-direction: row;
            height: 100vh;
            font-family: Arial, Helvetica, sans-serif;
            justify-content: space-between;
            margin: 0px 0px 0px 100px;
        }

        form{
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        textarea{
            outline: none;
            border: none;
            background-color: #555555;
            color: #efefef;
            border-radius: 5px;
            padding-left: 10px;
            padding-top: 10px;
            font-weight: bold;
            font-size: 16px;
        }

        input{
            outline: none;
            border: none;
            background-color: #555555;
            color: #efefef;
            font-weight: bold;
            font-size: 16px;
            border-radius: 5px;
            padding: 5px;
        }

        #comment_area{
            padding: 10px;
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 60%;
            height: 100%;
            background-color: #333333;
            padding-left: 30px;
        }

        #comment_area>div{
            background-color: #555555;
            font-weight: bold;
            font-size: 16px;
            border-radius: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>
    <form action="index.php" method="post">
        <textarea name="comment_box" id="comment_box" cols="30" rows="10"></textarea>
        <input type="submit" value="comment">
    </form>

    <div id="comment_area">
    <h1> Comments </h1>
    <?php
    $result = $commentdb->query("SELECT * FROM comments;");
    if($result->numColumns() && $result->columnType(0) !== SQLITE3_NULL){
        while($res = $result->fetchArray(SQLITE3_ASSOC)){
            echo "<div>" . $res["comment"] . "</div>";
        }
    }
    ?>
    </div>
</body>
</html>