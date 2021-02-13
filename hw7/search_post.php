<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        body{
            background-image: url("https://images.squarespace-cdn.com/content/v1/5b02186afcf7fdd9101774c4/1592838476881-2X8C96WWIM8RJSRX1VJT/ke17ZwdGBToddI8pDm48kHilYxHgo5pd2DczB5brOCQUqsxRUqqbr1mOJYKfIPR7LoDQ9mXPOjoJoqy81S2I8N_N4V1vUb5AoIIIbLZhVYy7Mythp_T-mtop-vrsUOmeInPi9iDjx9w8K4ZfjXt2djFQkAl81r3lGal7WreTKa0f2v-LTT6-aHhf2hEirDJACjLISwBs8eEdxAxTptZAUg/RainbowDesktopBackground.png");
            background-size: cover;
            font-family: "Times New Roman", Times, serif;
        }
        </style>
</head>
<body>
    <div class="container p-3 my-3 bg-dark text-white">
    <center><h1><p class="text-primary">Search</p></center></h1>
    </div>
    <center><input type="text" id="kw"></center>
    <center><button onclick="search()" class="btn btn-danger">Search</button></center>
    <center><h1><div id="disp"></div><h1></center>
    <center><h2><select id="typ"><h2></center>

<!-- <option value="1">รายเดือน</option>
    <option value="2">รายปี</option>
    <option value="3">ตลอดชีพ</option> -->
<?php
    // connect database 
    $db_host = "localhost";
    $db_user = "root";
    $db_password = "";
    $db_name = "hw6_62160172";
    $mysqli = new mysqli($db_host, $db_user, $db_password, $db_name);
    $mysqli->set_charset("utf8");
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    $sql = "SELECT *
            FROM music
            WHERE Name_song LIKE '%$kw%'";
    $result = $mysqli->query($sql);
    while($row = $result->fetch_object()) {
        echo "<option value='$row->Album_name'>$row->Album_name</option>";
    }
?>
</select>
<div class="container">           
        <img src="https://upload.wikimedia.org/wikipedia/en/5/53/Maroon_5_-_V_%28Official_Album_Cover%29.png" class="img-circle" alt="Cinque Terre" width="304" height="236"> 
        <img src="https://i.pinimg.com/originals/b9/3a/fb/b93afba4bbe3ef407224dd88143d1a1e.jpg" class="img-circle" alt="Cinque Terre" width="304" height="236"> 
        <img src="https://ic.pics.livejournal.com/randomeighter/83846766/32130/32130_original.jpg" class="img-circle" alt="Cinque Terre" width="304" height="236">
        <img src="https://upload.wikimedia.org/wikipedia/th/d/d1/Maroon_5_Sugar_cover.png" class="img-circle" alt="Cinque Terre" width="304" height="236">
        <img src="https://i.pinimg.com/originals/79/85/91/798591423df1fc84892875a97b5d4cf1.jpg" class="img-circle" alt="Cinque Terre" width="304" height="236">        
    </div>
<center><form method="post" action="search.html">
            <input type="submit" value="Back Search">
        </form></center>


<script>
    function search() {
        kw = document.getElementById('kw').value;
        typ = document.getElementById('typ').value;
        console.log("kw=" + kw);
        console.log("typ=" + typ);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // document.getElementById('disp').innerHTML = this.responseText;
                arr = JSON.parse(this.responseText);
                console.log(arr);
                if (arr.length == 0) {
                    document.getElementById('disp').innerHTML = "Not found";
                } else {
                    html = "";
                    for (i = 0; i < arr.length; i++) {
                        html += arr[i].Name_song + ", " + arr[i].Album_name +", " + arr[i].Lyrics + "<br>";
                    }
                    document.getElementById('disp').innerHTML = html;
                }
            }
        }
        parameters = "kw=" + kw + "&typ=" + typ;
        xmlhttp.open("post", "search.php");
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(parameters);
    }
</script>








<!-- <form method="post" action="search.php">
    <input type="text" name="kw" id="kw">
    <input type="submit" value="Search">
</form> -->