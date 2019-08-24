<!DOCTYPE html>
    <html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>教官管理界面</title>
    <style type="text/css">
    body{
            margin: 0 auto;
            background-image:url(./images/考试.jpg);
        }
    #globel{
        width: 100%;
        height:100%;
    }
    #head{
        width:100%;
        height: 20%;
        position: relative;
    }
    #headinga{
        width: 25%;
        height: 50%;
        position: inherit;
        top: 20%;
        left: 40%;
    }
    #body{
        width: 20%;
        height: 80%;
        float: left;
    }
    #body1{
        width: 80%;
        height: 80%;
        float: right;
    }
    </style>
</head>
<body>
<div id="globel">
<div id="head">
<div id="headinga"><h1>教官管理信息</h1></div>
</div>
<div id="body">
<h2><a  target="body1" href="test.php">试题信息管理</a></h2>
<h2><a  target="body1" href="score.php">参训人员考核记录管理</a></h2>
</div>
<div id="body1">
<iframe name="body1" width="1200" height="635"></iframe>
</div>
</div>
</body>
</html>