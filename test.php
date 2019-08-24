<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
$conn->query("set names 'utf8'");
$lesson=$_GET['exam'];
$sql="select ChooseContent,ChooseAns1,ChooseAns2,ChooseAns3,ChooseAns4,RightAns from tb_choose where ChooseCourse='$lesson'";
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

print_r($data);
?>