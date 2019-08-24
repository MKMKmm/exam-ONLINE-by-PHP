<?php
if(!session_id()) session_start();
$username=$_SESSION['username'];
if ($username) {
    echo "<script>alert(\"$username ,欢迎回来！！\");</script>";
}
else
{
    echo "<script>alert('您还尚未登录！请返回登录~~');</script>";
    echo "<a href='../login1.php'>如果跳转失败请点击跳转~~</a>";
    header("Refresh:1;url=../login1.php");
    //header("location:../login1.php");
}
?>
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>学员</title>
<style type="text/css">
#container{
            width:100%;
            height: 720px;
            position: relative;
            background-image:url(../images/考试.jpg);
        }
#user{
    width: 10%;
    height:5%;
    position: inherit;
    top: 3%;
    left: 85%;

}
#cddh{
    width: 30%;
    height: 10%;
    position: absolute;
    top: 5%;
    left: 20%;
}
#body{
    width: 100%;
    height: 85%;
    position: inherit;
    top: 8%;
}
</style>
</head>
<body>
<div id="container">
<div id="user">
<td><?=$_SESSION['username'];?></td>
<td><a target="" href="../login1.php">退出</a></td>
<td><a target="body" href="xiugai.php">修改密码</a></td>
</div>

<div id="cddh">
<a target="body" href="xuanzezhuanye.php">选择学习专业</a>
<a target="body" href="resul.php">随机抽取试题</a></div>

<div id="body">
<iframe name="body" width="1500" height="600"></iframe>
</div>
</div>
</body>
</html>
