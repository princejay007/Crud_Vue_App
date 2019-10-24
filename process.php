<?php
$conn = new mySQLi("localhost","root","","crud_vue");
if ($conn->connect_error) {
    die("Connection Failed!".$conn->connect_error);
}

$result = array('error' =>false );
$action = '';

if(isset($_GET['action'])){
$action = $_GET['action'];

}

if($action == 'read'){
    $sql = $conn->query("SELECT * FROM users");
    $users = array();
    while ($row = $sql->fetch_assoc()) {
        array_push($users, $row);
    }
    $result['users'] = $users;

}


if($action == 'create'){
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
    $age = $_POST['age'];
    $height = $_POST['height'];
    $haircolor = $_POST['haircolor'];
    $weight = $_POST['weight'];
    

    $sql = $conn->query("INSERT INTO users (firstname,surname,dob,age,height,haircolor,weight)
     VALUES('$firstname','$surname','$dob','$age','$height','$haircolor','$weight')");

    if($sql){
        $result['message'] = "user added successfully";
    }
   else{
       $result['error'] = true;
       $result['message'] = "failed to add user";
   }

}

if($action == 'update'){
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $surname = $_POST['surname'];
    $dob = "";
            if ($_POST["dob"]) {
                $dob_timestamp = strtotime($_POST["dob"]);
                $dob = date("Y-m-d", $dob_timestamp);
            }
    $age = $_POST['age'];
    $height = $_POST['height'];
    $haircolor = $_POST['haircolor'];
    $weight = $_POST['weight'];
    

    $sql = $conn->query("UPDATE users SET firstname='$firstname',surname='$surname',dob='$dob',age='$age',height='$height',haircolor='$haircolor',weight='$weight' WHERE id='$id'");

    if($sql){
        $result['message'] = "user updated successfully";
    }
   else{
       $result['error'] = true;
       $result['message'] = "failed to update user";
   }

}

if($action == 'delete'){
    $id = $_POST['id'];
   
    $sql = $conn->query("DELETE FROM users WHERE id='$id'");

    if($sql){
        $result['message'] = "user deleted successfully!";
    }
   else{
       $result['error'] = true;
       $result['message'] = "failed to delete user";
   }

}


$conn->close();

echo json_encode($result);  
?>