<form method="GET">
  <input type="text" name="search_term" />
  <input type="submit" value="Search" />
</form>
<?php
// connection is refused but I'm not sure why #frustrating
$servername = "159.89.127.140";
$username = "root";
$password = "aeee90415b257c7a06edd93b532da01ac9fd348d5736b073";
$dbname = "Users";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// using prepared statements this time
$search_term = $_GET["search_term"];
$sql = $conn->prepare("SELECT * FROM Users WHERE firstname = (?) AND active = 1;");
$sql->bind_param("s", $search_term);
$result = $conn->query($sql);

echo "<table>";
if ($result->num_rows > 0) {
    // output data of each row into a table
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>id: " . $row["id"]. "</td><td>Username: " . $row["username"].
        "</td><td>Email: ". $row["email"]. "</tr><tr>First Name: " . $row["firstname"] .
        "</td><td>Last Name: " . $row["lastname"] . "</td><td>Active: " . $row["active"] .
        "</td></tr>";
    }
} else {
    echo "No results found.";
}
echo "</table>";
$conn->close(); // close connection
?>