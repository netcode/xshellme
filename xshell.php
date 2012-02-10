<?php
error_reporting(E_ALL);

/********************************************
 *** @author:NetCode eslam@netcode.me *******
 *** @website:netcode.me ********************
 *******************************************/

class xShellMe {
	
	public $checkTypes = array('php','php3','php4','asp','aspx','sh','py');
	private $_pattern = '%(passthru|shell_exec|exec|base64_decode|eval|system|proc_open|popen|curl_exec|curl_multi_exec|parse_ini_file|show_source)%'; //system: regex for detect Suspicious behavior
	/* TODO: seperate patterns to levels so you can check files and define infecttion level
	private $_pattern_level = array(
		'1'=> '', // high risk
		'2'=>'', // medium risk
		'3'=>'' // low risk
	);
	 */
	private $result = array();
	
	/*
	 * 
	 */
	function __construct() {
		//set time limit
		//no timeout
		set_time_limit(0);
		//and set proper permissions
	}
	
	/*
	 * 
	 */
	function start($current = './'){
		echo '<h2>Result</h2>';
		$this->goDeep($current);
		echo '<hr />';
		echo '<h2>Details:</h2>';
		echo '<pre>';print_r($this->result);echo '</pre>';
	}
	
	/*
	 * 
	 */
	function goDeep($folder){
		$contents = scandir($folder);
		foreach($contents as $content){
			if($content == '.' || $content == '..'){
				continue;
			}elseif(is_dir($folder.$content)){
				$this->goDeep($folder.$content.'/');
			}else{
				if($content == 'xshell.php' && $folder == './'){ //must recheck
					continue;
				}
				if($this->check($folder.$content)){
					echo '<p style="color:red;"> Found Shell: '.$folder.$content.'</p>';
				}else{
					//echo '<p style="color:green;"> Good: '.$folder.$content.'</p>';
				}
			}
		}		
	}
	
	/*
	 * 
	 */
	private function check($file){
		//get extention
		//$ext = $file;
		
		$ext = substr(strrchr($file, "."), 1); 		
		if(in_array($ext, $this->checkTypes)){
			//first check signatures
			//$this->checkSignatures($file);
			//first check patterns
			return $this->checkPatterns($file);
		}
	}
	
	/*
	 * 
	 */
	private function checkSignatures($file){
		
	}
	
	/*
	 * 
	 */
	private function checkPatterns($file){
		//echo $file;
		$content = file_get_contents($file);
		//echo $content;
        if(preg_match_all($this->_pattern, $content, $matches)) {
        	$this->result[$file] = $matches[0];
        	return true;	
		}else{
			return false;
		}
	}
	
	/*
	 * 
	 */
	private function action_move(){
		
	}
	
	/*
	 * 
	 */
	private function action_delete(){
		
	}
	
	/*
	 * 
	 */
	private function action_onlineCheck(){
		
	}
	
	/*
	 * 
	 */
	private function _log(){
		
	}
	
	/*
	 * 
	 */
	public function update(){
		
	}	
}

$xshell = new xShellMe();
$xshell->start();
?>