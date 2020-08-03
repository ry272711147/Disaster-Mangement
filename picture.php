if(isset($_POST['sub']))
{
global $post_id;
$filename=$_FILES["upload_image"]["name"];
$tempname=$_FILES["upload_image"]["tmp_name"];
$folder="images/".$filename;
$content=$_POST['content'];
$title=$_POST['title'];
$user="rimpa";
$type=$_POST['type'];
if(strlen($filename) >= 1 && strlen($content) >= 1){
move_uploaded_file($tempname, $folder);
$sql="insert into posts(post_id,post_content,post_image,title,name,type) values('$post_id','$content','$folder','$title','$user','$type')";
$run=mysqli_query($con,$sql);
if($run){
	$_SESSION['folder']=$folder;
	echo "<script>alert('Your Post updated a moment ago!')</script>";
	}
}
}
?>