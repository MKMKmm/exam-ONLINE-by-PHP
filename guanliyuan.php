<!DOCTYPE html>
    <html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>管理员登录界面</title>
    <style type="text/css">
        body{
            margin: 0 auto;
        }
        #container{
            width:100%;
            height: 720px;
            background-image:url(./images/考试.jpg);
            
        }
        #content_menu{
            width:40%;
            height:100%;
            background-repeat:no-repeat;
            float:left;
        }
        #content_body{
            width:60%;
            height:100%;
            float:left;
            
        } 
        /*嵌套样式*/    
   #child { 
    width:600px; 
    height:500px;
    position: relative;   
    top: 50%;   
    left: 50%;   
    -webkit-transform: translate(-50%, -50%);   
    -moz-transform: translate(-50%, -50%);   
    -ms-transform: translate(-50%, -50%);   
    -o-transform: translate(-50%, -50%);   
    transform: translate(-50%, -50%);  
    border:1px solid black
    
    } 
    #child1{
        width: 200px;
        height: 100px;
        position: relative;   
    top: 30%;   
    left: 50%;   
    -webkit-transform: translate(-50%, -50%);   
    -moz-transform: translate(-50%, -50%);   
    -ms-transform: translate(-50%, -50%);   
    -o-transform: translate(-50%, -50%);   
    transform: translate(-50%, -50%);  
        
    }
    #user{
        width: 150px;
        height: 50px;
         position: inherit;   
    top: 20%;   
    left: 50%;   
    -webkit-transform: translate(-50%, -50%);   
    -moz-transform: translate(-50%, -50%);   
    -ms-transform: translate(-50%, -50%);   
    -o-transform: translate(-50%, -50%);   
    transform: translate(-50%, -50%);
        
    } 
    #pass{
        width: 150px;
        height: 50px;
         position: inherit;   
    top: 30%;   
    left: 50%;   
    -webkit-transform: translate(-50%, -50%);   
    -moz-transform: translate(-50%, -50%);   
    -ms-transform: translate(-50%, -50%);   
    -o-transform: translate(-50%, -50%);   
    transform: translate(-50%, -50%);
        
    }
    #submit{
        width: 100px;
        height: 50px;
         position: inherit;   
    top: 40%;   
    left: 50%;   
    -webkit-transform: translate(-50%, -50%);   
    -moz-transform: translate(-50%, -50%);   
    -ms-transform: translate(-50%, -50%);   
    -o-transform: translate(-50%, -50%);   
    transform: translate(-50%, -50%);
    } 
    </style>
</head>
<body>
<form action="./view/logincheck.php" method="post">
<div id="container">
<div id="content_menu"></div>        
  <div id="content_body">     
    <div id="child">
      <div id="child1">
        <td>选择身份登录：</td>
        <td><select name="login">
        <option selected>管理员</option>
        <option>教官</option>
        </select></td></div>
        
        <div  id="user">用户名:
        <input name="username" type="text" /></div>
        <div  id="pass">密码:
        <input name="password" type="text"/></div>
        <div id="submit">
        <input name="Submit" type="submit" value="登录"/></div>
    </div>  
  </div>      
</form>
  
</div>
</body>
</html>


<?php




?>