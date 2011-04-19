<?php
// $Header: /cvsroot/html2ps/demo/html2ps.php,v 1.10 2007/05/17 13:55:13 Konstantin Exp $

error_reporting(E_ALL);
ini_set("display_errors","1");
if (ini_get("pcre.backtrack_limit") < 1000000) { ini_set("pcre.backtrack_limit",1000000); };
@set_time_limit(10000);

require_once('generic.param.php');
require_once('../config.inc.php');
require_once(HTML2PS_DIR.'pipeline.factory.class.php');

ini_set("user_agent", DEFAULT_USER_AGENT);

$g_baseurl = trim(get_var('URL', $_REQUEST));

if ($g_baseurl === "") {
  die("Please specify URL to process!");
}

// Add HTTP protocol if none specified
if (!preg_match("/^https?:/",$g_baseurl)) {
  $g_baseurl = 'http://'.$g_baseurl;
}

$g_css_index = 0;

// Title of styleshee to use (empty if no preferences are set)
$g_stylesheet_title = "";

$GLOBALS['g_config'] = array( 
                             'compress'      => isset($_REQUEST['compress']),
                             'cssmedia'      => get_var('cssmedia', $_REQUEST, 255, "screen"),
                             'debugbox'      => isset($_REQUEST['debugbox']),
                             'debugnoclip'   => isset($_REQUEST['debugnoclip']),
                             'draw_page_border'        => isset($_REQUEST['pageborder']),
                             'encoding'      => get_var('encoding', $_REQUEST, 255, ""),
                             'html2xhtml'    => !isset($_REQUEST['html2xhtml']),
                             'imagequality_workaround' => isset($_REQUEST['imagequality_workaround']),
                             'landscape'     => isset($_REQUEST['landscape']),
                             'margins'       => array(
                                                      'left'    => (int)get_var('leftmargin',   $_REQUEST, 10, 0),
                                                      'right'   => (int)get_var('rightmargin',  $_REQUEST, 10, 0),
                                                      'top'     => (int)get_var('topmargin',    $_REQUEST, 10, 0),
                                                      'bottom'  => (int)get_var('bottommargin', $_REQUEST, 10, 0),
                                                      ),
                             'media'         => get_var('media', $_REQUEST, 255, "A4"),
                             'method'        => get_var('method', $_REQUEST, 255, "fpdf"),
                             'mode'          => 'html',
                             'output'        => get_var('output', $_REQUEST, 255, ""),
                             'pagewidth'     => (int)get_var('pixels', $_REQUEST, 10, 800),
                             'pdfversion'    => get_var('pdfversion', $_REQUEST, 255, "1.2"),
                             'ps2pdf'        => isset($_REQUEST['ps2pdf']),
                             'pslevel'       => (int)get_var('pslevel', $_REQUEST, 1, 3),
                             'renderfields'  => isset($_REQUEST['renderfields']),
                             'renderforms'   => isset($_REQUEST['renderforms']),
                             'renderimages'  => isset($_REQUEST['renderimages']),
                             'renderlinks'   => isset($_REQUEST['renderlinks']),
                             'scalepoints'   => isset($_REQUEST['scalepoints']),
                             'smartpagebreak' => isset($_REQUEST['smartpagebreak']),
                             'transparency_workaround' => isset($_REQUEST['transparency_workaround'])
                             );
print_r($GLOBALS['g_config']);


?>