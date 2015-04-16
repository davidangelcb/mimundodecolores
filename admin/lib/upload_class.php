<?php 
//--------------------------------------------------------------------
class file_upload {
                  
    var $the_file;
	var $the_temp_file;
    var $upload_dir;
    var $extensions;
	var $http_error;
	var $message;
	var $codeError;
	var $pathFile;
	
	function file_upload() {
		$this->upload();
	}
	function upload() {
		$source_file = trim($this->the_temp_file);
		//$dest_file = trim($this->the_file);
		if ($source_file != "") {
			$ext = $this->validateExtension();
			if ($ext) {
				if (is_uploaded_file($source_file)) {
					if ($this->move_upload($dest_file)) {
						$this->message = "File: <b>".$dest_file."</b> successfully uploaded!";
						$this->codeError = 0;
						$this->pathFile = $dest_file;
						return true;
					}
				} else {
					$this->report_error();
					return false;
				}
			} else {
				$poss_ext = implode(" ", $this->extensions);
				$this->message = "<strong>Error:</strong> This file extension is not allowed";
				$this->codeError = 1;
				return false;
			}
		} else {
			$this->message = "<strong>Warning:</strong> Please select a file for upload.";
			$this->codeError = 2;
		}
	}
	function validateExtension() {
		$file_name = trim($this->the_file);
		$extension = strtolower(strrchr($file_name,"."));
		$ext_array = $this->extensions;
		if (in_array($extension, $ext_array)) { 
			return true;
		} else {
			return false;
		}
	}
	function verify_namefile($a,$i) {
	    // $a = $this->the_file;
		$file_name = trim($a);
		$extension = strrchr($file_name,".");
		$nombre = substr($file_name,0,strrpos($file_name,"."));
		if($i==0){
		   $newfile = $this->upload_dir.$file_name;
		}else{
		   $newfile = $this->upload_dir.$nombre."[".$i."]".$extension;
		}
		if(file_exists($newfile))
		{
			return $this->verify_namefile($a,$i+1);
		}else{
		    return $newfile;
		}
	}	
	//
	function move_upload(&$a) {
		umask(0);
		$newfile = $this->verify_namefile($this->the_file,0);
		$a = substr($newfile,strrpos($newfile,"/")+1);
		$tmp_file = trim($this->the_temp_file);
		if (move_uploaded_file($tmp_file, $newfile)) {
			system("sudo chmod 604 $newfile");
			return true;
		} else {
			return false;
		}
	}
	// some error (HTTP)reporting, change the messages or remove options if you like.
	function report_error() {
		switch($this->http_error) {
			case 1: 
			$this->message = "<strong>Error:</strong> The uploaded file exceeds the max. upload filesize directive in the server configuration.";
			$this->codeError = 10;
			break;
			case 2: 
			$this->message = "<strong>Error:</strong> The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the html form.";
			$this->codeError = 11;
			break;
			case 3: 
			$this->message = "<strong>Error:</strong> The uploaded file was only partially uploaded.";
			$this->codeError = 12;
			break;			
			case 4:
			$this->message = "<strong>Error:</strong> No file was uploaded.";
			$this->codeError = 13;
			break;			
			default:
			$this->message = "<strong>Error:</strong> There was a problem with your upload.";
			$this->codeError = 100;
		}
	}
}
?>