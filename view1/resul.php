<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
$conn->query("set names 'utf8'");
$sql="select Lesson_Name from tb_lesson";
$result=$conn->query($sql);
$count=$result->num_rows;
$data=[];
$i=0;
while($row=$result->fetch_array()){
    $data[$i]=$row['Lesson_Name'];
    $i++;
}


?>
<!DOCTYPE html>
    <html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>Title</title>
<style type="text/css">
         body{
            margin: 0 auto;
        }
        #container{
            width:100%;
            height: 720px;
            position: relative;
        }
        #header{
            width: 100%;
            height: 150px;
            background-color:transparent;
             position:  absolute;
            position: relative;
           
        }
        #random{
            width: 15%;
            height: 40%;
            background-color:transparent;
            position: absolute;
            left: 40%;
            right: 60%;
            top: 20%;
            bottom: 80%;
        }
        
        #body{
            width:50%;
            height:75%;
            background-color:transparent;
            position: absolute;
            position: relative;
            left: 25%;
            right: 0;
            top: 0;
            bottom: 0;
            border:1px solid black
        }
        #center{
            width: 20%;
            height: 5%;
            background: silver;
            margin: auto;
            position: absolute;
            left: 0;
            right: 0;
            top: 70%;
            bottom: 30%;
        }
        #choose{
            width: 40%;
            height: 5%;
            margin: auto;
            position: absolute;
            top: 80%;
            bottom: 20%;
            background-color:transparent;
            
        }

   </style> 
</head>
<body>
<div id="container">
<div id="header">
<div id="random"><h1>随机抽取试题</h1></div>
</div>
<div id="body"><h1>阅读考试规则：</h1>
<td>一、自觉服从监考员等考试工作人员管理，不得以任何理由妨碍监
考员等考试工作人员履行职责，不得扰乱考场及其他考试工作地点的秩序。</td><br />
<td>二、凭《准考证》、有效身份证件等规定证件，按规定时间和地点参加考试。应主
动接受监考员按规定进行的身份验证和对随身物品等进行的必要检查。</td><br />
<td>三、迟到15分钟后不准进入考点参加当科目考试。交卷出场时间不得早于每科目考
试结束前30分钟，交卷出场后不得再次进场续考，也不得在考场附近逗留或交谈。</td><br />
<td>四、在考场内须保持安静，不准吸烟，不准喧哗，不准交头接耳、左顾右盼、打手
势、做暗号，不准夹带、旁窥、抄袭或有意让他人抄袭，不准传抄答案。</td><br />
<td>五、考试结束前要离开考场的考生须先再举手提出离场，经监考员允许后才准离开
考场，离开后不准在考场附近逗留。</td><br />
<td>六、考试结束信号发出后，坐好静候。待监考员检查无误，根据监考员指令依次
退出考场。</td><br />
<td>七、如不遵守考试规则，不服从考试工作人员管理，有违纪、作弊等行为，要依
法进行处理。</td><br />
<form method="post">
<div id="center">
<input name="accept" type="radio" value="1"/>我已接受以上规则</div>
<div id="choose"><td>选择考试科目：</td>
        <td><select name="choose">
        <?php
        foreach($data as $v){  
        ?>
        <option ><?php echo $v;?></option>
        <?php }?>
        </select>
        </td>
<td>
<input type="submit" name="exam" value="开始考试" />
</td><br />
<td>全程考试时长为：       90分钟</td></div>
</form>
</div>
</div>
</body>
</html>
<?php
if(isset($_POST['exam'])){

    if(!($_POST['accept'])){
        echo "<script>alert('请阅读考试规则');</script>";
    }
    else{
        $accept=$_POST['accept'];
        $choose=$_POST['choose'];
        header("location:./exam.php?exam=$choose");
    }
    
}


?>

