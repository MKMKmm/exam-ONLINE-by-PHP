<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('../function/page.php'); //分页类 
$showrow = 2; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
$sql = "SELECT * FROM tb_student"; 
//$total = mysql_num_rows(mysql_query($sql)); //记录总条数 
$total=$conn->query($sql)->num_rows;
if (!empty($_GET['page']) && $total != 0 && $curpage > ceil($total / $showrow)) 
    $curpage = ceil($total_rows / $showrow); //当前页数大于最后页数，取最后一页 
//获取数据 
$sql .= " LIMIT " . ($curpage - 1) * $showrow . ",$showrow;"; 
//$query = mysql_query($sql);

$query=$conn->query($sql);
?>
<!DOCtype>
<html>
<head>
<title>学员信息管理</title>
<style>
table{background-color: white;  width: 500px;height: 100px;margin: 0 auto; border: 1px solid #000;}
td{height: 20px;line-height: 20px;font-family: "微软雅黑";font-size: 14px;font-weight: normal;color: #0080FF;
text-align: center;border: 1px solid #CCC;background-color: white;;
}
#dht{padding:10px;

boder:1px solid#000000;

background: "教官信息管理.jpg";}
</style>
</head>
<body background="教官信息管理.jpg"
      style=" background-repeat:no-repeat ;
background-size:100% 100%;
background-attachment: fixed;">
<div align="center">
<h2>学生信息管理</h2>
</div>
<table>
<tr>

<td>学生编号</td>
<td>学生姓名</td>
<td>登录密码</td>
<td>性别</td>
<td>系统编号</td>
<td></td>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr>
<form method="post">
<td><input type="text" readonly="readonly" name="Student_ID" value="<?php echo $row['Student_ID']?>"/></td>
<td><input type="text" name="Student_Name" value="<?php echo $row['Student_Name']?>"/></td>
<td><input type="text" name="Student_Pwd" value="<?php echo $row['Student_Pwd']?>"/></td>
<td><input type="text" name="Student_Sex" value="<?php echo $row['Student_Sex']?>"/></td>
<td><input type="text" name="SID" value="<?php echo $row['SID']?>"/></td>
<td><input type="submit" name="modif" value="修改"/>
<input type="submit" name="delete" value="删除"/></td>
</form>
</tr>
<?php } ?> 
<tr>
<form method="post">
<td></td>
<td><input type="text" name="Student_Name"/></td>
<td><input type="text" name="Student_Pwd"/></td>
<td><input type="text" name="Student_Sex"/></td>
<td><input type="text" name="SID"/></td>
<td><input type="submit" name="ZJ" value="增加信息" style="height:30px;width:70px;"/></td>
</form>
</tr>
</tr>
</table> 
<div class="showPage"> 
    <?php 
    if ($total > $showrow) {//总记录数大于每页显示数，显示分页 
        $page = new page($total, $showrow, $curpage, $url, 2); 
        echo $page->myde_write(); 
    } 
    ?> 
</div>
</body>
</html>
<?php
    if(isset($_POST['modif'])){
        $Student_ID=$_POST['Student_ID'];
        $Student_Name=$_POST['Student_Name'];
        $Student_Pwd=$_POST['Student_Pwd'];
        $Student_Sex=$_POST['Student_Sex'];
        $SID=$_POST['SID'];
        $sql1="update tb_student set Student_Name='$Student_Name',Student_Pwd='$Student_Pwd',Student_Sex='$Student_Sex',SID='$SID' where Student_ID='$Student_ID'";
        $result1=$conn->query($sql1);
        if($result1){
            echo "<script>alert('修改成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
        if(isset($_POST['delete'])){
        $Student_ID=$_POST['Student_ID'];
        $SID=$_POST['SID'];
        $sql2="delete from tb_student where Student_ID='$Student_ID'";
        $result2=$conn->query($sql2);
        if($result2){
            echo "<script>alert('删除成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }

    if(isset($_POST['ZJ'])){
        
        $Student_Name=$_POST['Student_Name'];
        $Student_Pwd=$_POST['Student_Pwd'];
        $Student_Sex=$_POST['Student_Sex'];
        $SID=$_POST['SID'];
        $sql3="insert into tb_student (Student_Name,Student_Pwd,Student_Sex,SID) values ('$Student_Name','$Student_Pwd','$Student_Sex','$SID')";
        $result3=$conn->query($sql3);
        if($result3){
            echo "<script>alert('增加成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
?>