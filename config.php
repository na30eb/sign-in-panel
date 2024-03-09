<?php
function getDateTime(){
    echo "logged in : ", date("Y/M/D") , "<br>";
}
session_start();

//form validation
$Name_Entered= isset($_POST['username']) &&
                 strlen($_POST['username'] >= 3) ;

$userCorrectInput= preg_match('/[a-z]/',$_POST['username']) ||
                     preg_match('/[A-Z]/',$_POST['username']);


$family_Entered= isset($_POST['family']) && !empty($_POST['family']) 
                && strlen($_POST['family'] >= 3) ;

$familyCorrectInput= (preg_match('#[a-z]#',$_POST['family']) ||
                     preg_match('#[A-Z]#',$_POST['family']) )&&
                    (!preg_match('#[0-9]#' ,$_POST['family']) && !preg_match('#!@$%^&*()_+= #',$_POST['family'])) ;

$passCorrectInput=  preg_match('/[a-z]/',$_POST['password']) &&
                    preg_match('/[A-Z]/',$_POST['password']) &&
                    preg_match('/[0-9]/',$_POST['password']);

//file upload

$targetdir = "uploads/";
$targetfile = $targetdir . basename($_FILES["fileToUpload"]["name"]);
echo "path : ", $targetfile;
$uploadok = 1;
$imagefiletype = strtolower(pathinfo($targetfile, PATHINFO_EXTENSION));

if (isset($_POST['submit'])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image.";
    } else {
        echo "File is not an image.";
        $uploadok = 0;
    }
}

if ($uploadok == 1) {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetfile)) {
        echo "File has been uploaded successfully!";
    } else {
        echo "Error uploading the file.";
    }
}
if(file_exists($targetfile)){
    $uploadok=0;
}




//vaidation conditions

if($_SERVER["REQUEST_METHOD"] == "POST"){
    getDateTime();

    if( $Name_Entered && $userCorrectInput){
        $username=$_POST['username'];
        $_SESSION['username']=$username;
    }else{
        $user_err="name input is not correct pleas try again!" ;
    }
    if( $family_Entered && $familyCorrectInput){
        $family=$_POST['family'];
        $_SESSION['family']=$family;

    }else{
        $user_err="family input is not correct please try again ! ";
    }
    if(!filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
        $user_err="<br> email is invalid !";
    }else{
        $email=$_POST['email'];
        $_SESSION['email']=$email;
    }
    if(strlen(($_POST['password'])) >=8 && strpos(trim($_POST['password']),' ')==false && $passCorrectInput ){
        $password=$_POST['password'];
        $_SESSION['password']=$password;

    }else{
        $user_err=" <br> passsword is not correct !";
        echo "your pass is : " , $_POST['password'];
        echo "<br> pass input correct : " ,$passCorrectInput;
    }
    if($user_err!=null){
        echo $user_err ; 
    }else{
        echo "session test : ".$_SESSION['username'];
        $userinfo=" name= $username family = $family Email= $email password= $password \n last updated at=".date("Y/M/D") ."\n"; 
        setdata($userinfo);

    }
}
function fileInput(){
    echo "working , this does workkkkk!";
}

//echo $userinfo;

//end of php
?>

<?php
function setdata($userinfo){
    //file handeling
    $myfile="/var/www/ebrahimi/public_html/fileHandeling/form_pro/userinfo.txt";
    $fileOpen=fopen($myfile,"a") or die("failed");
    fwrite($fileOpen,$userinfo);
    fclose($fileOpen);
    }

echo setdata($userinfo);


?>