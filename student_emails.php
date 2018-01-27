
<?php
//Jonathan Brooks
//Software Engineering
//1/24/18
//This program returns the email and name of students (stored in a database) after
//the user inputs that student's ID

$output = NULL;
if(isset($_POST['submit'])){     //execute if there is a submit option 
$servername = "student-database.cojaktkgsyol.us-east-2.rds.amazonaws.com"; //connecting to database
$username = "jbrooks01";
$password = "";       //password information omitted
$dbname = "Studen_Emails";


$conn = new mysqli($servername, $username, $password, $dbname);   //connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);    //print error if there is no connection
} 

$search = $conn->real_escape_string($_POST['search']); //omits special characters from search for sql use
$userResult = mysqli_query($conn,"SELECT Name, Email FROM Students where ID = '$search'");
//query based on user input (ID input retrns Name, Email)
if($userResult->num_rows > 0){
 while($rows = $userResult->fetch_assoc())    //fetch result row
 {
 $Name = $rows['Name'];
 $Email = $rows['Email'];
 
 $output = "Name: $Name<br /> Email: $Email";
 
 }

}
else{
$output = "No results"; 
}
}
?>


 
<form method = "POST">
<input type = "TEXT" name = "search" />
<input type = "SUBMIT" name = "submit" value = "search" />
</form>

<?php echo $output; ?>