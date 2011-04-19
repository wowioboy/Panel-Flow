<?php

require_once(HTML2PS_DIR.'css/stream.string.php');

class TestCSSParser9 extends PHPUnit_Framework_TestCase {
  function test() {
    $stream = new CSSStreamString(file_get_contents(dirname(__FILE__).'/test.parser.9.css'));
    $lexer = new CSSLexer($stream);
    $parser = new CSSParser($lexer);
    $result = $parser->parse();    

    $this->assertTrue($result); 
  }
}

?>