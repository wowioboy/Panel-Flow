<?php 
/* 
WordPress Force Upgrade Script 
Copyright (C) 2006  Mark Jaquith 

This program is free software; you can redistribute it and/or 
modify it under the terms of the GNU General Public License 
as published by the Free Software Foundation; either version 2 
of the License, or (at your option) any later version. 

This program is distributed in the hope that it will be useful, 
but WITHOUT ANY WARRANTY; without even the implied warranty of 
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the 
GNU General Public License for more details. 

You should have received a copy of the GNU General Public License 
along with this program; if not, write to the Free Software 
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA. 
*/ 

function txfx_log($text) { 
    echo $text . '<br />'; 
} 

switch ($_GET['step']) : 
    case "1": 
        require('wp-config.php'); 
        txfx_log('WordPress loaded...'); 
        require('wp-admin/upgrade-functions.php'); 
        txfx_log('Upgrade functions loaded...'); 
        wp_cache_flush(); 
        txfx_log('Object cache flushed...'); 
        make_db_current(); 
        txfx_log('Database made current...'); 
        upgrade_160(); 
        txfx_log('Data upgraded...'); 
        $wp_rewrite->flush_rules(); 
        txfx_log('Rewrite rules flushed...'); 
        wp_cache_flush(); 
        txfx_log('Object cache flushed...'); 
        txfx_log('<br />'); 
        txfx_log('Hopefully that did it!  <strong>DELETE THIS FILE FROM YOUR SERVER NOW!</strong>'); 
        txfx_log('And then, try to access your <code>/wp-admin/</code>'); 
        break; 
    default : 
        txfx_log('This script will attempt to upgrade your database.  It is intended for users of WordPress 1.5 or later.'); 
        txfx_log('<strong>You should delete this script from your server after you are done using it!</strong>'); 
        txfx_log('<br />'); 
        txfx_log('<a href="?step=1">Click here</a> to attempt the upgrade'); 
        break; 
endswitch; 
?>