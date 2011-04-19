<?

/**
 @author : Nguyen Quoc Bao <quocbao.coder@gmail.com>
 @version : 1.4
 @distribution It's free as long as you keep this header
**/

class basic_template {
	
	var $dir = '.';
	var $data = array('' => array(0 => array()));
	var $result = null;
	var $blockname = '';
	var $blockindex = 0;
	
	function set($name , $var , $blockname = '' , $blockindex = 0) {
		if (is_array($var) && count($var)) {
			foreach ($var as $key => $key_var) {
				$this->set($name . "." . $key , $key_var , $blockname , $blockindex);
			}
		} else if (is_object($var)) {
			$var = get_object_vars($var);
			foreach ($var as $key => $key_var) {
				$this->set($name . "->" . $key , $key_var , $blockname , $blockindex);
			}
		} else {
		print 'VAR = '.$var;
			$name = "{" .$name . "}";
			$this->data[$blockname][$blockindex][$name] = $var;
		}
	}
	
	function set_block($name , $vars) {
		foreach ($vars as $key => $var) {
			$this->set($name , $var , $name , $key);
		}
	}
	
	function output($tpl_name) {
		if ($tpl_name == '' || !file_exists($this->dir . DIRECTORY_SEPARATOR . $tpl_name)) return false;
		$file = implode('' , file($this->dir . DIRECTORY_SEPARATOR . $tpl_name));
		$this->result = $this->_compile($file);
		return true;
	}
	
	function _compile($tpl) {
		if (preg_match('/(.*)?({\[([\w]+)[^\]}]*\]})(.*)({\[\/\\3\]})(.*)?/sU' , $tpl , $matchs)) {
			$result = '';
			while (preg_match('/(.*)?({\[([\w]+)[^\]}]*\]})(.*)({\[\/\\3\]})(.*)?/sU' , $tpl , $matchs)) {
				$result .= $this->_compile($matchs[1]);
				$old_blockname = $this->blockname;
				$this->blockname = $matchs[3];
				$old_index = $this->blockindex;
				if (isset($this->data[$this->blockname])) {
					foreach ($this->data[$this->blockname] as $index => $block) {
						$this->blockindex = $index;
						$result .= $this->_compile($matchs[4]);
					}
				}
				$this->blockindex = $old_index;
				$this->blockname = $old_blockname;
				$tpl = substr($tpl , strlen($matchs[0]));
			}
			$result .= $this->_compile($tpl);
			return $result;
		} else if (preg_match("/(.*)?{@([^}]*)}(.*)?/sU" , $tpl , $matchs)) {
			$result = '';
			while (preg_match("/(.*)?{@([^}]*)}(.*)?/sU" , $tpl , $matchs)) {
				$result .= $this->_compile($matchs[1]);
				$matchs[2] = trim($matchs[2]);
				if (!($matchs[2] == '' || !file_exists($this->dir . DIRECTORY_SEPARATOR . $matchs[2]))) {
					$file = implode('' , file($this->dir . DIRECTORY_SEPARATOR . $matchs[2]));
					$result .= $this->_compile($file);
				}
				$tpl = substr($tpl , strlen($matchs[0]));
			}
			$result .= $this->_compile($tpl);
			return $result;
		} else {
			if (!isset($this->data[$this->blockname])) return '';
			if (!isset($this->data[$this->blockname][$this->blockindex])) return '';
			$result = '';
			$result .= strtr($tpl , ($this->blockname != '' ? $this->data[$this->blockname][$this->blockindex] + $this->data[''][0] : $this->data[''][0]));
			return $result;
		}
	}
	
}

?>