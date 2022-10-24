<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reflected XSS</title>
    <style>
        body{
            margin: 0px;
            background-color: #eeeeee;
            color: #333333;
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form{
            display: flex;
            gap: 10px;
        }

        input[type=text]{
            outline: none;
            border: none;
            border-radius: 5px;
            height: 30px;
            background-color: #ffffff;
            padding-left: 10px;
        }

        input[type=submit]{
            outline: none;
            border: none;
            border-radius: 5px;
            height: 30px;
            background-color: #dedede;
            font-weight: bold;
            color: #343434;
        }

        #names{
            margin: 20px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        #names>div{
            padding: 15px;
            border-radius: 5px;
            background-color: #ffffff;
        }

    </style>
</head>
<body>
    <form action="index.php" method="get">
        <input type="text" name="name" id="name" placeholder="Find a name.">
        <input type="submit" value="Search">
    </form>
    <div id="names">
        <?php

        if(isset($_GET["name"]) && strlen($_GET["name"]) > 0){
            $conn = new SQLite3("names.db");
            $names = $conn->query("SELECT * FROM names WHERE name LIKE '" . $_GET["name"] . "%';");

            if($names->fetchArray(SQLITE3_ASSOC)){
                $names->reset();
                while($result = $names->fetchArray(SQLITE3_ASSOC)){
                    echo "<div>" . $result["name"] . "</div>";
                }
            }else{
                echo "<span>" . $_GET["name"] . " not found in database.</span>";
            }
        }else{
            echo "Nothing to search";
        }

        ?>
    </div>
</body>
</html>