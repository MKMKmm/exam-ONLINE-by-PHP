<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
$conn->query("set names 'utf8'");
$lesson=$_GET['exam'];
$sql="select ChooseContent,ChooseAns1,ChooseAns2,ChooseAns3,ChooseAns4,RightAns from tb_choose where ChooseCourse='$lesson' order by rand() limit 5";
$result=$conn->query($sql);
$count=$result->num_rows;
$data=[];
$ans=[];
$i=0;
while($row=$result->fetch_array()){
    $data[$i]['ChooseContent']=$row['ChooseContent'];
    $data[$i]['ChooseAns1']=$row['ChooseAns1'];
    $data[$i]['ChooseAns2']=$row['ChooseAns2'];
    $data[$i]['ChooseAns3']=$row['ChooseAns3'];
    $data[$i]['ChooseAns4']=$row['ChooseAns4'];
    $ans[$i]=$row['RightAns'];
    $i++;
}
?>
<!DOCTYPE>
<html>
<head>
<title><?php echo $lesson;?></title>
<script language="JavaScript">
<!-- //
var runtimes = 10;
function GetRTime(){
var nMS =runtimes*1000;
var nH=Math.floor(nMS/(1000*60*60))%24;
var nM=Math.floor(nMS/(1000*60)) % 60;
var nS=Math.floor(nMS/1000) % 60;
document.getElementById("RemainH").innerHTML=nH;
document.getElementById("RemainM").innerHTML=nM;
document.getElementById("RemainS").innerHTML=nS;
if(nMS==5*60*1000)
{
alert("还有最后五分钟！");
}
if(nMS==0){
    alert("考试结束！");
    document.getElementById("TD").submit();
    //window.location.href='resul.php';
    //window.clearTimeout();
    

}

runtimes--;
setTimeout("GetRTime()",1000);
}
window.onload=GetRTime;
// -->
</script>
<meta http-equiv="content-type" content="text/ html;charset=utf-8"/>
<style type="text/css">
#header{
    width: 100%;
    height: 10%;
    background: white;
    position: relative;
}
#header1{
    width: 10%;
    height: 100%;
    background: white;
    position: absolute;
    left: 25%;
}
#body{
    width: 70%;
    height:2500px;
    background: white;
    float: left;
    border:1px solid black
}
#question-wrap{
    width: 100%;
    height: 98%;
    background: white;
    
}
#question-type{
    width: 10%;
    height: 1%;
    background: white;
}
#question-each{
    width: 100%;
    height: 4.5%;
    background: white;
}
#question-name{
    width: 100%;
    height: 40%;
    background:white;
}
#question-option{
    width: 100%;
    height: 60%;
    background: white;
}
#body1{
    width: 29.8%;
    height:2500px;
    background: white;
    float: right;
}
#time{
    width: 25%;
    height: 5%;
    float: right;
    position: fixed;
    top: 50%;
    bottom: 50%;
    left: 73%;
    
}
#jiaojuana{
    width: 7%;
    height: 8%;
    position: fixed;
    top: 94%;
    bottom:6%;
    left: 93%;
    background: white;
}
#time1{
    width: 80%;
    height: 80%;
    font-family:"Arial Unicode MS";
    font-size:110px; 
    font-weight:normal;
    position: absolute;
    top: 8%;
    left: 13%; 
}
</style>
</head>
<body>
<div id="header">
<div id="header1"><h1><?php echo $lesson;?></h1></div>
</div>
<div id="body">	
					<div id="question-wrap">
                        <form method="post" id="TD">
                            
						<div id="question-type">一、单选题</div>
						<div id="question-each">
                            <?php
                                foreach($data as $k=>$v){
                             ?>
							<!-- 标题 -->
							<div id="question-name"><?php echo $k+1;echo ".".$v['ChooseContent'];?></div>
							<!-- 选项 -->
							<div id="question-option">
                            <label><input type="radio" value="A" name="choose[<?=$k?>]" >A.<?=$v['ChooseAns1']?></label>
							<label><input type="radio" value="B" name="choose[<?=$k?>]" >B.<?=$v['ChooseAns2']?></label>
							<label><input type="radio" value="C" name="choose[<?=$k?>]" >C.<?=$v['ChooseAns3']?></label>
							<label><input type="radio" value="D" name="choose[<?=$k?>]" >D.<?=$v['ChooseAns4']?></label>
                            </div>
                            <?php }?>
						</div>
                        
                    

                    
             </div>
          </div>
<div id="body1">
<div id="time">距离考试结束还有:
<div id="time1">
<h6><strong id="RemainH">XX</strong>:<strong id="RemainM">XX</strong>:<strong id="RemainS">XX</strong></h6>
</div>
</div>
<div id="jiaojuana">
<input type="submit" value="交卷"style="height:50px;width:100px;display:inline-block;"/></div>
</div>
</form>
</body>
</html>
<?php

    if($_POST){
        $choose=$_POST['choose'];
        //print_r($choose);
        $sum=0;
        $j=0;
        if(!session_id()) session_start();
        $username=$_SESSION['username'];
        for($j;$j<$count;++$j)
        {
            if($choose[$j]==$ans[$j])
            $sum+=2;
        }
        $conn=new mysqli("127.0.0.1","root","","_pro");
        mysqli_set_charset($conn,"utf8");
        $sql1="select Student_ID from tb_student where Student_Name='$username'";
        $re=$conn->query($sql1);
        //print_r( $re->fetch_row());
        $id=$re->fetch_row()[0];
        //echo $id;
        $studentAns=implode(",",$choose);
        $rightAns=implode(",",$ans);
        $sql2="insert into tb_score (Student_ID,Lesson_Name,score,Student_Name,StudentAns,RightAns) values ('$id','$lesson','$sum','$username','$studentAns','$rightAns')";
        $result=$conn->query($sql2);
        if($result){
            
            echo "<script>alert('总分:$sum');window.location.href='resul.php';</script>";
            
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试')</script>";
        }
    }

?>