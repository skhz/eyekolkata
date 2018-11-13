<?php
class Message{
	var $errorMessageArray = array();
	var $warningMessageArray = array();
	var $informationMessageArray = array();
	var $alertMessageArray = array();
	var $errorMessage = '';
	var $warningMessage = '';
	var $informationMessage = '';
	var $alertMessage = '';
	var $spliterIs = '||^||';
	
	function prepearMessageGroup($message = '',$message_type = 'error'){
		switch($message_type){
			case 'err':
			case 'error':
				$this->errorMessageArray[] = $message;
			break;
			case 'warn':
			case 'warning':
				$this->warningMessageArray[] = $message;
			break;
			case 'info':
			case 'information':
				$this->informationMessageArray[] = $message;
			break;
			case 'alert':
			case 'alrt':
				$this->alertMessageArray[] = $message;
			break;
		}
	}
	
	function returnMessage($message_type = 'error'){
		$return = '';
		switch($message_type){
			case 'err':
			case 'error':
				for($i = 0;$i < count($this->errorMessageArray);$i++){
					if($this->errorMessageArray[$i] != ''){
						$return.= (($return == '') ? ''.($i+1).'.&nbsp;&nbsp;' : '<br />'.($i+1).'.&nbsp&nbsp;').$this->errorMessageArray[$i];
					}
				}
				$return = ($return != '') ? '<span class="message error_msg"><span style="display:block;font-size:12px;font-weight:bold;text-align:left;"><img src="images/err.png" />Error :</span><span style="display:block;padding:5px 5px 5px 15px;">'.$return.'</span></span>' : '';
			break;
			case 'warn':
			case 'warning':
				for($i = 0;$i < count($this->warningMessageArray);$i++){
					if($this->warningMessageArray[$i] != ''){
						$return.= (($return == '') ? ''.($i+1).'.&nbsp;&nbsp;' : '<br />'.($i+1).'.&nbsp&nbsp;').$this->warningMessageArray[$i];
					}
				}
				$return = ($return != '') ? '<span class="message warn_msg"><span style="display:block;font-size:12px;font-weight:bold;text-align:left;"><img src="images/warn.png" />Warning :</span><span style="display:block;padding:5px 5px 5px 15px;">'.$return.'</span></span>' : '';
			break;
			case 'info':
			case 'information':
				for($i = 0;$i < count($this->informationMessageArray);$i++){
					if($this->informationMessageArray[$i] != ''){
						$return.= (($return == '') ? ''.($i+1).'.&nbsp;&nbsp;' : '<br />'.($i+1).'.&nbsp&nbsp;').$this->informationMessageArray[$i];
					}
				}
				$return = ($return != '') ? '<span class="message info_msg"><span style="display:block;font-size:12px;font-weight:bold;text-align:left;"><img src="images/info.png" />Information :</span><span style="display:block;padding:5px 5px 5px 15px;">'.$return.'</span></span>' : '';
			break;
			case 'alrt':
			case 'alert':
				for($i = 0;$i < count($this->alertMessageArray);$i++){
					if($this->alertMessageArray[$i] != ''){
						$return.= (($return == '') ? ''.($i+1).'.&nbsp;&nbsp;' : '<br />'.($i+1).'.&nbsp&nbsp;').$this->alertMessageArray[$i];
					}
				}
				$return = ($return != '') ? '<span class="message alrt_msg"><span style="display:block;font-size:12px;font-weight:bold;text-align:left;"><img src="images/alrt.png" />Alert :</span><span style="display:block;padding:5px 5px 5px 15px;">'.$return.'</span></span>' : '';
			break;
		}
		return $return;
	}
	
	function printAllMessages(){
		return $this->returnMessage('err').$this->returnMessage('warn').$this->returnMessage('info').$this->returnMessage('alrt');
	}
}

$Message = new Message();
?>