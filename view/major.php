<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('../function/page.php'); //分页类 
$showrow = 2; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
$sql = "SELECT * FROM tb_major"; 
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
<html >
<head>
<title>导弹专业信息管理</title>
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
<h2>导弹专业信息管理</h2>
</div>
<table>

<td>导弹编号</td>
<td>导弹专业</td>
<td>导弹说明</td>
<td></td>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr>
<td><input type="text" readonly="readonly" name="Speciality_ID" value="<?php echo $row['Speciality_ID']?>"/></td>
<td><input type="text" name="Speciality_Name" value="<?php echo $row['Speciality_Name']?>"/></td>
<td><input type="text" name="Speciality_Info" value="<?php echo $row['Speciality_Info']?>"/></td>
<td><input type="submit" name="modif" value="修改"/>
<input type="submit" name="delete" value="删除"/></td>
</tr>
<?php } ?> 
<tr>
<form method="post">
<td><input type="text" name="Speciality_ID" /></td>
<td><input type="text" name="Speciality_Name" /></td>
<td><input type="text" name="Speciality_Info" /></td>
<td><input type="submit" name="ZJ" value="增加信息" style="height:30px;width:70px;"/></td>
</form>
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
        $Speciality_ID=$_POST['Speciality_ID'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $Speciality_Info=$_POST['Speciality_Info'];
        $sql1="update tb_major set Speciality_Name='$Speciality_Name',Speciality_Info='$Speciality_Info' where Speciality_ID='$Speciality_ID'";
        $result1=$conn->query($sql1);
        if($result1){
            echo "<script>alert('修改成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
        if(isset($_POST['delete'])){
        $Speciality_ID=$_POST['Speciality_ID'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $Speciality_Info=$_POST['Speciality_Info'];
        $sql2="delete from tb_major where Speciality_ID='$Speciality_ID'";
        $result2=$conn->query($sql2);
        if($result2){
            echo "<script>alert('删除成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }

    if(isset($_POST['ZJ'])){
        $Speciality_ID=$_POST['Speciality_ID'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $Speciality_Info=$_POST['Speciality_Info'];
        $sql3="insert into tb_major (Speciality_Name,Speciality_Info) values ('$Speciality_Name','$Speciality_Info')";
        $result3=$conn->query($sql3);
        if($result3){
            echo "<script>alert('增加成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
?>
