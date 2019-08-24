<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
<?php

//$allowedExts = array("pdf");
//$temp = explode(".", $_FILES["file"]["name"]);
////echo "name:".$_FILES["file"]["name"];
////echo "<br/>";
////echo "type:".$_FILES["file"]["type"];
////echo "<br/>";
////echo "size:".$_FILES["file"]["size"];
////echo "<br/>";
////echo "tmp_name:".$_FILES["file"]["tmp_name"];
////echo "<br/>";
//$extension = end($temp);     // 获取文件后缀名
//echo $extension;
//if ((($_FILES["file"]["type"] == "application/pdf"))
////&& ($_FILES["file"]["size"] < 204800)   // 小于 200 kb
//&& in_array($extension, $allowedExts))
//{
//    if ($_FILES["file"]["error"] > 0)
//    {
//        echo "错误：: " . $_FILES["file"]["error"] . "<br>";
//    }
//    else
//    {
//        echo "上传文件名: " . $_FILES["file"]["name"] . "<br>";
//        echo "文件类型: " . $_FILES["file"]["type"] . "<br>";
//        echo "文件大小: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
//        echo "文件临时存储的位置: " . $_FILES["file"]["tmp_name"] . "<br>";
//        
//        // 判断当期目录下的 upload 目录是否存在该文件
//        // 如果没有 upload 目录，你需要创建它，upload 目录权限为 777
//        if (file_exists("upload/" . $_FILES["file"]["name"]))
//        {
//            echo $_FILES["file"]["name"] . " 文件已经存在。 ";
//        }
//        else
//        {
//            // 如果 upload 目录不存在该文件则将文件上传到 upload 目录下
//            move_uploaded_file($_FILES["file"]["tmp_name"], "upload/" . $_FILES["file"]["name"]);
//            echo "文件存储在: " . "upload/" . $_FILES["file"]["name"];
//        }
//    }
//}
//else
//{
//    echo "非法的文件格式";
//}


//$file_name="书籍5.pdf";
$file_name=$_GET['f'];//需要下载的文件
echo $file_name;
//$file_name=iconv("utf-8","gb2312","$file_name");
$fp=fopen("./upload/".$file_name,"r+");//下载文件必须先要将文件打开，写入内存
if(!file_exists("./upload/".$file_name)){//判断文件是否存在
    echo "文件不存在";
    exit();
}
$file_size=filesize("./upload/".$file_name);//判断文件大小
//返回的文件
header("content-type: application/octet-stream");
//按照字节格式返回
header("accept-ranges: bytes");
//返回文件大小
header("accept-length: ".$file_size);
//弹出客户端对话框，对应的文件名
header("content-disposition: attachment; filename=".$file_name);
//防止服务器瞬时压力增大，分段读取
$buffer=1024;
while(!feof($fp)){
    $file_data=fread($fp,$buffer);
    echo $file_data;
}
//关闭文件
fclose($fp);


?>