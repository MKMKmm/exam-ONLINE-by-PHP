<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>修改密码</title>
<style type="text/css">
#container{
            width:100%;
            height: 720px;
            position: relative;
        }
#alter{
    width: 40%;
    height: 60%;
    position: absolute;
    top: 10%;
    left: 30%;
    border:1px solid black
}
#pwd{
    width: 50%;
    height: 10%;
    position: inherit;
    top: 10%;
    left: 20%;
}
#new{
    width: 50%;
    height: 10%;
    position: inherit;
    top: 20%;
    left: 20%;
}
#again{
    width: 50%;
    height: 10%;
    position: inherit;
    top: 30%;
    left: 20%;
}
#next{
    width: 15%;
    height: 10%;
    position: inherit;
    top: 50%;
    left: 20%;
}
#cancel{
    width: 15%;
    height: 10%;
    position: inherit;
    top: 50%;
    left: 50%;
}
</style>
</head>
<body>
<form method="post">
<div id="container">
<div id="alter">
<div id="pwd">
<tr>
<td>当前密码:</td>
<td>
<input name="pwd" type="text"/>
</td>
</tr>
</div>

<div id="new">
<tr>
<td>新密码:</td>   
<td>
<input name="new" type="text"/>
</td>
</tr>
</div>

<div id="again">
<tr>
<td>确认新密码:</td>
<td>
<input name="confirm" type="text" />
</td>
</tr>
</div>

<div id="next">
<input  name="ok" type="submit" value="修改"/></div>

</div>
</form>
</body>
</html>
<?php
if(isset($_POST['ok'])){
    $pwd=$_POST['pwd'];
    $new=$_POST['new'];
    $confirm=$_POST['confirm'];
    if(!session_id()) session_start();
    $password=$_SESSION['password'];
    $username=$_SESSION['username'];
    if($pwd==""||$new==""||$confirm==""){
        echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";  
    }
    else{
        if($pwd!=$password){
            echo "<script>alert('当前密码错误！');history.go(-1);</script>";
        }
        else{
            if($new!=$confirm){
                echo "<script>alert('两次密码不一致！');history.go(-1);</script>";
            }
            else{
                $conn=new mysqli("127.0.0.1","root","","_pro");
                $conn->query("set names 'utf8'");
                $sql="update tb_student set Student_Pwd='$new' where Student_Name='$username'";
                
                
                $result=$conn->query($sql);
                if($result){
                    echo "<script>alert('修改密码成功！'); history.go(-1);</script>";
                    $_SESSION['password']=$new;
                }
                else{
                    echo "<script>alert('系统繁忙，请稍候再试！'); history.go(-1);</script>";  
                }
            }
        }
        
    }
    
}


?>