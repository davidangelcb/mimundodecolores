<?php
//-----------------------------------------------------
require_once('funcs_images.php');
require_once('lib/upload_class.php');
$muestra = false;
$opp = 1;
$max_size = 1024*100000; // the max. size for uploading<a href="tools/upload_class.php"></a>

$my_upload = new file_upload;

$my_upload->upload_dir = "temp/"; // the (absolute) folder for the uploaded files
$my_upload->extensions = array(".jpg", ".jpeg", ".png", ".gif"); // specify the allowed extensions here

if(isset($_FILES['upload']['name'])) {
	$my_upload->the_temp_file = $_FILES['upload']['tmp_name'];
	$my_upload->the_file = $_FILES['upload']['name'];
	$my_upload->http_error = $_FILES['upload']['error'];
	if($my_upload->upload()) {
		// hacer el rezise
		$ext = strtolower(strrchr($my_upload->pathFile,"."));
				//require_once("../tools/ImageEditor.php");
				ini_set("memory_limit","200M");
				/////////////////////////////////////////////////////////////////////////////////////////////
				$anchomax=674;
				$altomax=400;
		        $size=GetImageSize('temp/'.$my_upload->pathFile);
				if ($size[0]<$anchomax)
				{
				    $a=$anchomax/$size[0];
				    $anchomax=$size[0];
				    $altomax=$a*$size[1];
				}
			    image_createThumb('temp/'.$my_upload->pathFile,'temp/thumb_'.$my_upload->pathFile,$anchomax,$altomax,100);
				// todo ok
				$muestra = true;

	}
}
$msg = "";
$msg = strip_tags($my_upload->message);
?>
<script>
<?php if($muestra){
//echo urldecode(trim($my_upload->pathFile));
?>
	parent.document.getElementById('previewImg').innerHTML = '<img height="65" src="temp/<?php echo trim('thumb_'.$my_upload->pathFile);?>"/>';
	parent.document.getElementById('frm_8_logo').value = "<?php echo trim($my_upload->pathFile);?>";
<?php } else {?>
	alert("<?php echo $msg;?>");
<?php }?>
</script>