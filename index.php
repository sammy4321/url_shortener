<!DOCTYPE html>
<html>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
<?php

$uri = $_SERVER['REQUEST_URI'];
#echo $uri;
$path = parse_url($url, PHP_URL_PATH);
$segments = explode('/', rtrim($path, '/'));

#if($uri == "/king")
#{
#	header('Location: https://www.google.com/');
#}
if($uri == "/")
{

}
else{
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
$exists_flag = 0;
$sql = "SELECT original, shortened_url FROM urls";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    echo "<table>";
    echo "<tr><th>Original</th><th>Shortened</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["original"]. "</td><td>" . $row["shortened_url"]. "</td></tr>";
        if($row["shortened_url"]==$uri)
        {
        	header('Location: '.$row["original"]);
        	$exists_flag = 1;
        }
    }
    echo "</table>";
} else {
    
}
if($exists_flag==0){
	echo "Shortened url doesnt exist";die();
}
}

?>
<head>
	<title>ISTE URL SHORTENER</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
</head>

<body>
<br>
<br>
<br>
<br>
<div class="container">
  <h2>Url Shortener : </h2>
  <form action="url_shortener.php" method="POST">
    <div class="form-group">
      <label for="current_url">Current Url : </label>
      <input type="text" class="form-control" id="current_url" placeholder="Enter Current Url" name="current_url" required>
    </div>
    <div class="form-group">
      <label for="shortened_url">Shortened Url : </label>
      <input type="text" class="form-control" id="shortened_url" placeholder="Enter Shortened Url" name="shortened_url" required>
    </div>
    <button type="submit" class="btn btn-primary">Create Shortened Url</button>
  </form>
</div>

</body>
</html>