<?php
	class UploadHwnd{
		
		var $file;
		var $fileUploadPath;
		var $fileUploadSizeAry;
		var $destPathAry;
		var $fileNameToAry;
		var $fileNamePreFixAry;
		var $supportFileTypeAry;
		var $rootPath;
		var $fileInfo;
		var $extensions;
		var $UploadFilesInfo;
		
		function UploadHwnd($rootPath){
			$this->rootPath = $rootPath;
		}
		
		function fileUpload($file,$fileUploadPath,$supportFileType,$fileNameTo = '',$fileNamePreFix = ''){
			$this->file = $file;
			$this->destPathAry = $fileUploadPath;
			$this->supportFileTypeAry = $supportFileType;
			$this->fileNameToAry = $fileNameTo;
			$this->fileNamePreFixAry = $fileNamePreFix;
			$setFile = $this->setFile();
			if($setFile && $this->fileExtCheck() && $this->checkDestinations()){
				$this->uploadFile();
			}
		}
		
		function fileUploadWithResiseing($file,$fileUploadPath,$supportFileType,$fileSizes,$fileNameTo = '',$fileNamePreFix = '',$rationMaintain = true,$unlinkBase = false){
			$this->file = $file;
			$this->destPathAry = $fileUploadPath;
			$this->supportFileTypeAry = $supportFileType;
			$this->fileNameToAry = $fileNameTo;
			$this->fileNamePreFixAry = $fileNamePreFix;
			$this->fileUploadSizeAry = $fileSizes;
			$setFile = $this->setFile();
			if($setFile && $this->fileExtCheck() && $this->checkDestinations() && $this->checkFileIsResizable() && $this->checkDimension() && $this->checkResizeingSupportFunctions()){
				$this->resizeUploadFile($rationMaintain,$unlinkBase);
			}
		}
		
		function setFile(){
			global $HTTP_POST_FILES;
			$this->fileInfo = array();
			if(isset($_FILES[$this->file])){
				$this->fileInfo = array('Name' => $_FILES[$this->file]['name'],
										'Type' => $_FILES[$this->file]['type'],
										'Size' => $_FILES[$this->file]['size'],
										'TmpName' => $_FILES[$this->file]['tmp_name']);
				return true;
			}else if(isset($HTTP_POST_FILES[$this->file])){
				$this->fileInfo = array('Name' => $HTTP_POST_FILES[$this->file]['name'],
										'Type' => $HTTP_POST_FILES[$this->file]['type'],
										'Size' => $HTTP_POST_FILES[$this->file]['size'],
										'TmpName' => $HTTP_POST_FILES[$this->file]['tmp_name']);
				return true;
			}
			return false;
		}
		
		function fileExtCheck(){
			global $Message;
			$fileType = $this->supportFileTypeAry;
			$ext = strtolower(end(explode('.',$this->fileInfo['Name'])));
			if(is_array($fileType) && count($fileType) > 0){
				for($i = 0;$i < count($fileType);$i++){
					if(strtolower($fileType[$i]) == $ext){
						$this->extensions = $ext;
						return true;
					}
				}
				$Message->prepearMessageGroup("<b>SORRY!</b> We don't support this type file. <br />&nbsp;&nbsp;Please try with <b>.".(is_array($fileType) ? join(', .',$fileType) : $fileType)."</b> type file(s).");
				return false;
			}else if(is_string($fileType) || !$fileType){
				$this->extensions = $ext;
				return true;
			}else if(count($fileType) <= 0){
				$this->extensions = $ext;
				return true;
			}
			return false;
		}
		
		function checkDestinations(){
			global $Message;
			$destPathAry = $this->destPathAry;
			$return = true;
			if(is_array($destPathAry) && count($destPathAry) > 0){
				foreach($destPathAry as $key => $value){
					$return = (!$this->checkDestination($value)) ? false : $return;
				}
			}else if(is_string($destPathAry)){
				$return = (!$this->checkDestination($destPathAry)) ? false : $return;
			}
			return $return;
		}
		
		function checkDestination($destination){
			global $Message;
			if(is_dir($destination)){
				return true;
			}else{
				$Message->prepearMessageGroup("The destination directory is not exists.<br /> Set Destination : ".$destination);
				return false;
			}
		}
		
		function uploadFile(){
			global $Message;
			$setFilePath = false;
			$return = true;
			if(is_array($this->destPathAry)){
				foreach($this->destPathAry as $key => $value){
					if(is_string($this->fileNamePreFixAry) || trim($this->fileNamePreFixAry) != ''){
						$fileNamePrefix = trim($this->fileNamePreFixAry) == '' ? '' : trim($this->fileNamePreFixAry);
					}else if(is_array($this->fileNamePreFixAry)){
						$fileNamePrefix = trim($this->fileNamePreFixAry[$key]) == '' ? '' : trim($this->fileNamePreFixAry[$key]);
					}
					
					if(is_string($this->fileNameToAry) || trim($this->fileNameToAry) == ''){
						$fileNameTo = trim($this->fileNameToAry) == '' ? $fileNamePrefix.$this->fileInfo['Name'] : $fileNamePrefix.trim($this->fileNameToAry).'.'.$this->extensions;
					}else if(is_array($this->fileNameToAry)){
						$fileNameTo = trim($this->fileNameToAry[$key]) == '' ? $fileNamePrefix.$this->fileInfo['Name'] : $fileNamePrefix.trim($this->fileNameToAry[$key]).'.'.$this->extensions;
					}
					
					$fileForm = !$setFilePath ? $this->fileInfo['TmpName'] : $setFilePath;
					$fileTo = $value.$fileNameTo;
					
					if(is_file($setFilePath) && copy($fileForm,$fileTo)){
						$this->UploadFilesInfo[] = $fileTo;
						$Message->prepearMessageGroup("Your file is uploaded sucessfully.","info");
					}else if(move_uploaded_file($fileForm,$fileTo)){
						$this->UploadFilesInfo[] = $fileTo;
						$setFilePath = !$setFilePath ? $fileTo : $setFilePath;
						$Message->prepearMessageGroup("Your file is uploaded sucessfully.","info");
					}else{
						$Message->prepearMessageGroup("Your file is not uploaded.","err");
						$return = false;
					}
				}
			}else if(is_string($this->destPathAry)){
				$fileNamePrefix = trim($this->fileNamePreFixAry) == '' ? '' : trim($this->fileNamePreFixAry);
				$fileNameTo = trim($this->fileNameToAry) == '' ? $fileNamePrefix.$this->fileInfo['Name'] : $fileNamePrefix.trim($this->fileNameToAry).'.'.$this->extensions;
				$fileForm = $this->fileInfo['TmpName'];
				$fileTo = $this->destPathAry.$fileNameTo;
				if(move_uploaded_file($fileForm,$fileTo)){
					$this->UploadFilesInfo[] = $fileTo;
					$Message->prepearMessageGroup("Your file is uploaded sucessfully.","info");
				}else{
					$this->UploadFilesInfo[] = '';
					$Message->prepearMessageGroup("Your file is not uploaded.");
					$return = false;
				}
			}
			return $return;
		}
		
		function resizeUploadFile($rationMaintain,$unlinkBase = false){
			global $Message;
			$setFilePath = false;
			$return = true;
			if(is_array($this->destPathAry)){
				foreach($this->destPathAry as $key => $value){
					$doResize = false;
					/*Check And Set file name prefix*/
					if(is_string($this->fileNamePreFixAry) || trim($this->fileNamePreFixAry) != ''){
						$fileNamePrefix = trim($this->fileNamePreFixAry) == '' ? '' : trim($this->fileNamePreFixAry);
					}else if(is_array($this->fileNamePreFixAry)){
						$fileNamePrefix = trim($this->fileNamePreFixAry[$key]) == '' ? '' : trim($this->fileNamePreFixAry[$key]);
					}
					
					/*Check And Set file resize Height & Width*/
					if(is_string($this->fileUploadSizeAry) && trim($this->fileUploadSizeAry) != ''){
						$doResize = true;
						$getImageHeightWidth = $this->setImageHeightWidth($this->fileUploadSizeAry);
					}else if(is_array($this->fileUploadSizeAry) && trim($this->fileUploadSizeAry[$key]) != ''){
						$doResize = true;
						$getImageHeightWidth = $this->setImageHeightWidth($this->fileUploadSizeAry[$key]);
					}
					
					/*Check And Set file name To*/
					if(is_string($this->fileNameToAry) || trim($this->fileNameToAry) == ''){
						$fileNameTo = trim($this->fileNameToAry) == '' ? $fileNamePrefix.$this->fileInfo['Name'] : $fileNamePrefix.trim($this->fileNameToAry).'.'.$this->extensions;
					}else if(is_array($this->fileNameToAry)){
						$fileNameTo = trim($this->fileNameToAry[$key]) == '' ? $fileNamePrefix.$this->fileInfo['Name'] : $fileNamePrefix.trim($this->fileNameToAry[$key]).'.'.$this->extensions;
					}
					
					$fileForm = !$setFilePath ? $this->fileInfo['TmpName'] : $setFilePath;
					$fileTo = $value.$fileNameTo;
					
					if(is_file($setFilePath) && $doResize && $setFilePath && is_array($getImageHeightWidth)){
						if($this->resizeAndSaveFile($fileForm,$fileTo,$getImageHeightWidth['height'],$getImageHeightWidth['width'],$rationMaintain)){
							$this->UploadFilesInfo[] = $fileTo;
							$Message->prepearMessageGroup("Your file is uploaded with resizeing sucessfully.","info");
						}
					}else if(is_file($setFilePath) && copy($fileForm,$fileTo)){
						$this->UploadFilesInfo[] = $fileTo;
						$Message->prepearMessageGroup("Your file is uploaded sucessfully.","info");
					}else if(move_uploaded_file($fileForm,$fileTo)){
						$this->UploadFilesInfo[] = $fileTo;
						$setFilePath = !$setFilePath ? $fileTo : $setFilePath;
						$Message->prepearMessageGroup("Your file is uploaded sucessfully.","info");
					}else{
						$this->UploadFilesInfo[] = '';
						$Message->prepearMessageGroup("Your file is not uploaded.","err");
						$return = false;
					}
				}
			}else if(is_string($this->destPathAry)){
				$doResize = false;
				$fileNamePrefix = trim($this->fileNamePreFixAry) == '' ? '' : trim($this->fileNamePreFixAry);
				/*Check And Set file resize Height & Width*/
				if(is_string($this->fileUploadSizeAry) && trim($this->fileUploadSizeAry) != ''){
					$doResize = true;
					$getImageHeightWidth = $this->setImageHeightWidth($this->fileUploadSizeAry);
				}
				$fileNameTo = trim($this->fileNameToAry) == '' ? $fileNamePrefix.$this->fileInfo['Name'] : $fileNamePrefix.trim($this->fileNameToAry).'.'.$this->extensions;
				$fileForm = $this->fileInfo['TmpName'];
				$fileTo = $this->destPathAry.$fileNameTo;
				if($doResize){
					if(move_uploaded_file($fileForm,$fileTo)){
						if($this->resizeAndSaveFile($fileTo,$fileTo,$getImageHeightWidth['height'],$getImageHeightWidth['width'],$rationMaintain)){
							$this->UploadFilesInfo[] = $fileTo;
							$Message->prepearMessageGroup("Your file is uploaded with resizeing sucessfully.","info");
						}
					}else{
						$this->UploadFilesInfo[] = '';
						$Message->prepearMessageGroup("Your file is not uploaded.");
						$return = false;
					}
				}else if(!$doResize){
					if(move_uploaded_file($fileForm,$fileTo)){
						$this->UploadFilesInfo[] = $fileTo;
						$Message->prepearMessageGroup("Your file is uploaded sucessfully.","info");
					}else{
						$this->UploadFilesInfo[] = '';
						$Message->prepearMessageGroup("Your file is not uploaded.");
						$return = false;
					}
				}else{
					$this->UploadFilesInfo[] = '';
					$Message->prepearMessageGroup("Your file is not uploaded.");
					$return = false;
				}
			}
			
			/*To Unlink Base File*/
			if($unlinkBase && is_file($setFilePath)){
				unlink($setFilePath);
			}
			return $return;
		}
		
		function resizeAndSaveFile($file_path,$file_path_to,$height,$width,$ratio = true){
			global $Message;
			$save = $file_path_to; 	//This is the new file save path
		 	$file = $file_path; 	//This is the original file
			
			list($width_to,$height_to) = getimagesize($file);
			$height = (int)$height;
		  	$width = (int)$width;
		  
		  	$image_type = $this->extensions;
		  
		  	$ratio = $ratio;
		  
		  	if($ratio){
			  if($height_to > $width_to){
				$height_new = round($height);
				$width_new = round((($height/$height_to) * $width_to));
			  }elseif($height_to < $width_to){
				$height_new = round((($width/$width_to) * $height_to));
				$width_new = round($width);
			  }else{
				$height_new = round($height);
				$width_new = round($width);
			  }
		  	}else{
		    	$height_new = round($height);
				$width_new = round($width);
		  	}
		  
		  	$height_new = ($height_new <= 0) ? 1 : $height_new;
		  	$width_new = ($width_new <= 0) ? 1 : $width_new;
	  
		  	$tn = @imagecreatetruecolor($width_new,$height_new);
		  
		  	if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'jpeg' || $image_type == 'JPEG')
			  	$image = @imagecreatefromjpeg($file);
		  	elseif($image_type == 'gif' || $image_type == 'GIF')
		  	  	$image = @imagecreatefromgif($file);
		  	elseif($image_type == 'png' || $image_type == 'PNG')
		  	  	$image = @imagecreatefrompng($file);
		  
		  
		  	imagecopyresampled($tn, $image, 0, 0, 0, 0, $width_new, $height_new, $width_to, $height_to);
		  
		  	if($image_type == 'jpg' || $image_type == 'JPG' || $image_type == 'jpeg' || $image_type == 'JPEG'){
				if(@imagejpeg($tn,$save)){
					$return = true;
				}else{
					$return = false;
				}
		  	}else if($image_type == 'gif' || $image_type == 'GIF'){
				if(@imagegif($tn,$save)){
					$return = true;
				}else{
					$return = false;
				}
		  	}else if($image_type == 'png' || $image_type == 'PNG'){
		  	  	if(@imagepng($tn,$save)){
					$return = true;
				}else{
					$return = false;
				}
			}
			return $return;
		}
		
		function checkResizeingSupportFunctions(){
			global $Message;
			if($this->extensions == 'gif' && function_exists('imagecreatetruecolor') && function_exists('imagecopyresampled') && function_exists('imagecreatefromgif') && function_exists('imagegif')){
				return true;
			}else if(($this->extensions == 'jpg' || $this->extensions == 'jpeg') && function_exists('imagecreatetruecolor') && function_exists('imagecopyresampled') && function_exists('imagecreatefromjpeg') && function_exists('imagejpeg')){
				return true;
			}else if($this->extensions == 'png' && function_exists('imagecreatetruecolor') && function_exists('imagecopyresampled') && function_exists('imagecreatefrompng') && function_exists('imagepng')){
				return true;
			}
			$Message->prepearMessageGroup("Your current PHP configuration is not supported to resizeing with this type file.<br />&nbsp;&nbsp;Plesae check your PHP configuration.");
			return false;
		}
		
		function setImageHeightWidth($value){
			$hght_wdth_ary = explode("|",$value);
			$height = $hght_wdth_ary[0];
			$width = $hght_wdth_ary[1];
			return array('height' => $height,'width' => $width);
		}
		
		function checkFileIsResizable(){
			global $Message;
			$fileType = $this->fileInfo['Type'];
			if($fileType == 'image/pjpeg' || $fileType == 'image/jpeg' || $fileType == 'image/jpg' || $fileType == 'image/png' || $fileType == 'image/x-png' || $fileType == 'image/gif' || $fileType == 'application/octet-stream'){
				return true;
			}else{
				$Message->prepearMessageGroup("We don't support to resize this type file.<br />&nbsp;&nbsp;Please try with <b>.jpge, .jpg, .gif, .png</b> type files.<br />&nbsp;&nbsp;Current file type is : <b>".$fileType."</b>");
				return false;
			}
		}
		
		function checkDimension(){
			global $Message;
			list($width,$height) = getimagesize($this->fileInfo['TmpName']);
			if($height > 2000 || $width > 3000){
				$Message->prepearMessageGroup("The file dimension is too large.<br />&nbsp;&nbsp;Please try within <b>Max. Height : 2000 and  Max. Width : 3000</b>.<br />&nbsp;&nbsp;Current dimension : <b>Height : ".$height." and  Width : ".$width."</b>");
				return false;
			}
			return true;
		}
		
		function getUploadFilesName(){
			return $this->UploadFilesInfo;
		}
	}
?>