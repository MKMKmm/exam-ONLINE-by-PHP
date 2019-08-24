<?php
$conn=new mysqli("127.0.0.1","root","","_pro");
mysqli_set_charset($conn,"utf8");
require_once('../function/page.php'); //分页类 
$showrow = 2; //一页显示的行数 
$curpage = empty($_GET['page']) ? 1 : $_GET['page']; 
$url = "?page={page}"; //分页地址，如果有检索条件 ="?page={page}&q=".$_GET['q'] 
$sql = "SELECT * FROM tb_book"; 
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
<title>教材信息管理</title>
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
<form name="form1" action="#" onsubmit="return a()" method="post" enctype="multipart/form-data">
<div align="center">
<h2>教材信息管理</h2>
</div>
<table>
<tr>
<td>教材编号</td>
<td>教材名称</td>
<td>教材类型</td>
<td>专业岗位名称</td>
<td>导弹专业</td>
<td>教材文档</td>
<td></td>
<?php while ($row =$query->fetch_array() ) { ?> 
<tr>
<form method="post">
<td><input type="text" readonly="readonly" name="Book_ID" value="<?php echo $row['Book_ID']?>"/></td>
<td><input type="text" readonly="readonly" name="BookName" value="<?php echo $row['BookName']?>"/></td>
<td><input type="text" name="BookType" value="<?php echo $row['BookType']?>"/></td>
<td><input type="text" name="Position_Name" value="<?php echo $row['Position_Name']?>"/></td>
<td><input type="text" name="Speciality_Name" value="<?php echo $row['Speciality_Name']?>"/></td>
<td><input type="text" name="BookInfo" value="<?php echo $row['BookInfo']?>"/></td>
<td><input type="submit" name="modif" value="修改"/>
<input type="submit" name="delete" value="删除"/></td>
</form>
</tr>
<?php } ?> 
<tr>
<form method="post" enctype="multipart/form-data">
<td></td>
<td><label for="file">文件名：</label><input type="file" name="file" id="file"></td>


<td><input type="text" name="BookType"/></td>
<td><input type="text" name="Position_Name"/></td>
<td><input type="text" name="Speciality_Name"/></td>
<td><input type="text" name="BookInfo"/></td>
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
        $Book_ID=$_POST['Book_ID'];
        $BookName=$_POST['BookName'];
        $BookType=$_POST['BookType'];
        $Position_Name=$_POST['Position_Name'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $BookInfo=$_POST['BookInfo'];
        $sql1="update tb_book set BookName='$BookName',BookType='$BookType',Position_Name='$Position_Name',Speciality_Name='$Speciality_Name',BookInfo='$BookInfo' where Book_ID='$Book_ID'";
        $result1=$conn->query($sql1);
        if($result1){
            echo "<script>alert('修改成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }
        if(isset($_POST['delete'])){
        $Book_ID=$_POST['Book_ID'];
        $BookName=$_POST['BookName'];
        $BookType=$_POST['BookType'];
        $Position_Name=$_POST['Position_Name'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $BookInfo=$_POST['BookInfo'];
        $sql2="delete from tb_book where Book_ID='$Book_ID'";
        $result2=$conn->query($sql2);
        
        if($result2){
            echo "<script>alert('删除成功！')</script>";
        }
        else{
            echo "<script>alert('系统繁忙，请稍后再试！')</script>";
        }
    }

    if(isset($_POST['ZJ'])){
        
        $BookName=$_FILES["file"]["name"];
        $BookType=$_POST['BookType'];
        $Position_Name=$_POST['Position_Name'];
        $Speciality_Name=$_POST['Speciality_Name'];
        $BookInfo=$_POST['BookInfo'];
        $sql3="insert into tb_book (BookName,BookType,Position_Name,Speciality_Name,BookInfo) 
        values ('$BookName','$BookType','$Position_Name','$Speciality_Name','$BookInfo')";
        $result3=$conn->query($sql3);
        
        $allowedExts = array("pdf");
        $temp = explode(".", $_FILES["file"]["name"]);
//echo "name:".$_FILES["file"]["name"];
//echo "<br/>";
//echo "type:".$_FILES["file"]["type"];
//echo "<br/>";
//echo "size:".$_FILES["file"]["size"];
//echo "<br/>";
//echo "tmp_name:".$_FILES["file"]["tmp_name"];
//echo "<br/>";
    $extension = end($temp);      //获取文件后缀名
    echo $extension;
    if ((($_FILES["file"]["type"] == "application/pdf"))
    //&& ($_FILES["file"]["size"] < 204800)    //小于 200 kb
    && in_array($extension, $allowedExts))
    {
        if ($_FILES["file"]["error"] > 0)
        {
            echo "错误：: " . $_FILES["file"]["error"] . "<br>";
        }
        else
        {
            echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
            echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
            echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
            echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
        
         //判断上一级目录下的 upload 目录是否存在该文件
         //如果没有 upload 目录，你需要创建它，upload 目录权限为 777
            if (file_exists("../upload/" . $_FILES["file"]["name"]))
            {
                echo $_FILES["file"]["name"] . " 文件已经存在。 ";
            }
            else
            {
             //如果 upload 目录不存在该文件则将文件上传到 upload 目录下
                move_uploaded_file($_FILES["file"]["tmp_name"], "../upload/" . $_FILES["file"]["name"]);
                echo "文件存储在: " . "../upload/" . $_FILES["file"]["name"];
            }
        }
    }
    else
    {
        echo "非法的文件格式";
    }
        
            if($result3){
                echo "<script>alert('增加成功！')</script>";
            }
            else{
                echo "<script>alert('系统繁忙，请稍后再试！')</script>";
            }
        }
?>