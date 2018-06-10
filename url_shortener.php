<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<?php
#echo "Hello";
#echo $_POST["current_url"];
if(isset($_POST["current_url"]))
{#echo "Set";

$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "url_shortened";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT original, shortened_url FROM urls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        #echo "original: " . $row["original"]. " - shortened_url: " . $row["shortened_url"]. "<br>";
        #echo $_POST["shortened_url"];
        if( $row["original"] == $_POST["current_url"] )
        {
        	echo "A shortened URL has already been Created <br>";
        	echo "Shortened URL : ".$row['shortened_url'];
        	die();
        }
        if( $row["shortened_url"] == '/'.$_POST["shortened_url"] )
        {
        	echo "The shortened URL has already been Taken <br>";
        	echo "Used by the following link : <a href=".$row['original'].">".$row['original']."</a>";
        	die();
        }
    }
}


$sql = "INSERT INTO urls VALUES ('".$_POST["current_url"]."', '/".$_POST["shortened_url"]."')";

if ($conn->query($sql) === TRUE) {
    echo "New shortened url created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}
else {
	header('Location: /');
	/*
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "url_shortened";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT original, shortened_url FROM urls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "original: " . $row["original"]. " - shortened_url: " . $row["shortened_url"]. "<br>";
    }
} else {
    echo "0 results";
}
$conn->close();
*/
}
?>

</body>
</html>