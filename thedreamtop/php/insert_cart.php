<?php
error_reporting(0);
include_once ("dbconnect.php");
$email = $_POST['email'];
$code = $_POST['code'];
$userquantity = $_POST['quantity'];

$sqlsearch = "SELECT * FROM CART WHERE EMAIL = '$email' AND CODENO = '$code'";

$result = $conn->query($sqlsearch);
if ($result->num_rows > 0) {
    while ($row = $result ->fetch_assoc()){
        $prquantity = $row["CQUANTITY"];
    }
    $prquantity = $prquantity + $userquantity;
    $sqlinsert = "UPDATE CART SET CQUANTITY = '$prquantity' WHERE CODENO = '$code' AND EMAIL = '$email'";
    
}else{
    $sqlinsert = "INSERT INTO CART(EMAIL,CODENO,CQUANTITY) VALUES ('$email','$code',$userquantity)";
}

if ($conn->query($sqlinsert) === true)
{
    $sqlquantity = "SELECT * FROM CART WHERE EMAIL = '$email'";

    $resultq = $conn->query($sqlquantity);
    if ($resultq->num_rows > 0) {
        $quantity = 0;
        while ($row = $resultq ->fetch_assoc()){
            $quantity = $row["CQUANTITY"] + $quantity;
        }
    }

    $quantity = $quantity;
    echo "success,".$quantity;
}
else
{
    echo "failed";
}

?>