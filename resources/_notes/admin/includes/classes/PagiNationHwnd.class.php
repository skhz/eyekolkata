<?php
	class PagiNationHwnd{
		var $DbHwnd;
		var $displayLimit;
		var $pagiNations;
		var $QryRegExp = "/^SELECT +([A-Za-z0-9\*\(\)\,\.\_\s\+\-\/\=\!\%\'\"\?\#\<\>])+ FROM+/";
		var $CountQry;
		var $RsltCount;
		var $ReturnResult;
		var $returnKey;
		var $SBlock;
		var $Javascript;
		var $JavaScriptRegExp = "/PAGE_VALUE/";
		var $showExtra;
		var $ignoreKey;
		var $pageName;
				
		function PagiNationHwnd($DbHwnd,$displayLimit,$pageSize,$ignoreKey = false){
			$this->DbHwnd = $DbHwnd;
			$this->displayLimit = $displayLimit;
			$this->pageSize = $pageSize;
			$this->ignoreKey = $ignoreKey;
		}
		
		function callPaginat($query,$CountQry = NULL,$returnKey = 'page',$SBlock = false,$Javascript = false,$showExtra = true,$tagParm = ''){
			global $Message;
			$this->returnKey = $returnKey;
			$this->SBlock = $SBlock;
			$this->showExtra = $showExtra;
			$this->Javascript = $Javascript;
			$CountQry = $CountQry != NULL ? $CountQry : preg_replace($this->QryRegExp,'SELECT COUNT(*) AS Count FROM',$query);
			if($CRslt = $this->DbHwnd->dBQueryExecute($CountQry)){
				$CRsltSet = mysql_fetch_array($CRslt);
				$this->RsltCount = $CRsltSet['Count'];
			}
			$currentPage = (int)$_GET[$returnKey] == 0 ? $_GET[$returnKey] : ($_GET[$returnKey] - 1);
			$MainQuery = $query." LIMIT ".($currentPage * $this->displayLimit).",".$this->displayLimit;
			$this->ReturnResult = $this->DbHwnd->dBQueryExecute($MainQuery);
			$this->prepearPagination();
		}
		
		function prepearPagination(){
			/*Set Pagination Number Limit*/
			if((int)$this->pageSize % 2 != 0){
				$pageSize = (int)$this->pageSize;
			}else{
				$pageSize = ((int)$this->pageSize + 1);
			}
			
			/*Page Count*/
			if((int)$this->RsltCount % (int)$this->displayLimit == 0){
				$pageCount = (int)((int)$this->RsltCount / (int)$this->displayLimit);
			}else{
				$pageCount = ((int)((int)$this->RsltCount / (int)$this->displayLimit) + 1);
			}
			
			/*Set Psgination Buffer */
			$PageBuffer = (int)((int)$pageSize / 2);
			
			/*Set Page Name*/
			$pageName = trim($this->pageName) != "" ?  trim($this->pageName) : basename($_SERVER['PHP_SELF']);

			/*Loop Settings*/
			if($pageCount <= $pageSize){
				$currentPage = (int)($_GET[$this->returnKey]  > 0 ? $_GET[$this->returnKey] : 1);
				$loopStart = 1;
				$loopEnd = $pageCount;
			}else if($pageCount > $pageSize){
				$currentPage = (int)($_GET[$this->returnKey]  > 0 ? $_GET[$this->returnKey] : 1);
				if((int)($currentPage - $PageBuffer) <= 1){
					$loopStart = 1;
					$loopEnd = (int)$pageSize;
				}else if((int)($currentPage + $PageBuffer) > $pageCount){
					$loopStart = (int)($pageCount - $pageSize) + 1;
					$loopEnd = (int)$pageCount;
				}else{
					$loopStart = (int)($currentPage - $PageBuffer);
					$loopEnd = (int)($currentPage + $PageBuffer);
				}
			}
			if($loopEnd > 1){
				for($i = $loopStart;$i <= $loopEnd;$i++){
					$parm = $i == $currentPage ? ' class="selectedPage" ' : '';
					if($this->SBlock && $i == $currentPage){
						$this->pagiNations.= '&nbsp;'.$this->linkPrep($i,$i,$pageName,$parm,false);
					}else{
						$this->pagiNations.= '&nbsp;'.$this->linkPrep($i,$i,$pageName,$parm);
					}
				}
			}
			
			if($this->showExtra){
				$First = (($loopStart - 1) > 1) ? '&nbsp;'.$this->linkPrep('',1,$pageName) : '';
				$Previous = ($loopStart > 1) ? '&nbsp;'.$this->linkPrep('<img src="images/arrow-1.jpg" alt="" border="0" />',(int)($currentPage - 1) ,$pageName) : '';
				$Next = ($loopEnd < $pageCount) ? '&nbsp;'.$this->linkPrep('<img src="images/arrow.jpg" alt="" border="0" />',(int)($currentPage + 1),$pageName) : '';
				$Last = (($loopEnd + 1) < $pageCount) ? '&nbsp;'.$this->linkPrep('',$pageCount,$pageName) : '';
				$this->pagiNations = $First.$Previous.$this->pagiNations.$Next.$Last;
			}
		}
		
		function linkPrep($dKey,$id,$PageName,$parm = '',$link = true){
			if($this->Javascript != false){
				$returnStr = '<a '.$tagParm.($link ? ' onClick="'.preg_replace($this->JavaScriptRegExp,"'".$id."'",$this->Javascript).'"' : '').' '.$parm.' >'.$dKey.'</a>';
				return $returnStr;
			}else{
				$returnStr = '<a '.$tagParm.($link ? ' href="'.$PageName.'?'.$this->queryStringPrep($id).'"' : '').' '.$parm.' >'.$dKey.'</a>';
				return $returnStr;
			}
		}
		
		function queryStringPrep($id){
			$pageKey = true;
			$returnStr = '';
			if(is_array($_GET)){
				foreach($_GET as $k => $v){
					if($k == $this->returnKey){
						$pageKey = false;
						$returnStr.= ($returnStr != '' ? '&' : '').$this->returnKey.'='.$id;
					}else{
						if(is_bool($this->ignoreKey) && $this->ignoreKey){
							$returnStr.= ($returnStr != '' ? '&' : '').$k.'='.$v;
						}else if(is_array($this->ignoreKey) && count($this->ignoreKey) > 0){
							if(!in_array($k,$this->ignoreKey)){
								$returnStr.= ($returnStr != '' ? '&' : '').$k.'='.$v;
							}
						}
					}
				}
			}
			if($pageKey){
				$returnStr.= ($returnStr != '' ? '&' : '').$this->returnKey.'='.$id;
			}
			return $returnStr;
		}
		
		function getResultSet(){
			return $this->ReturnResult;
		}
		
		function getPagiNation(){
			return $this->pagiNations;
		}
	}
?>