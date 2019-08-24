<?php

if(isset($_POST['Submit']))
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    if($username == "" || $password == "")  
        {  
            echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";  
        }  
        else 
        {
            $conn=new mysqli("127.0.0.1","root","","_pro");
            
            mysqli_set_charset($conn,"utf8");
            
            $sql="select Student_Name,Student_Pwd from tb_Student where Student_Name='$username' and Student_Pwd='$password'";
            $result=$conn->query($sql);
            //$num=mysql_num_rows($result);
            if($result->num_rows>0)
            {
                session_start();
                $_SESSION['username']=$username;
                $_SESSION['password']=$password;
                
                //$row=$result->fetch_array();
                //echo $row[0]."<br/>".$row[1];
                //echo $_SESSION["username"];
                header("location:./loginxueyuan.php");
            }
            else
            echo "<script>alert('用户名或密码不正确！');history.go(-1);</script>"; 
            
        }

}
else{
    echo "<script>alert('提交未成功！'); history.go(-1);</script>";  
}


?>
<meta http-equiv="content-type" content="text/html;charset=utf-8"/>