<?php 
/** 
 * Plugin Name: Help Scout Beacon
 * 
 * 
 * 
*/
error_log("Test");



if(!(defined('ABSPATH'))) {
    exit;
}
add_action('plugins_loaded', 'verifyUser');
function getUser() {
    $user = wp_current_user();
}
//gets current logged in user
function verifyUser() {
    add_action('plugins_loaded', 'getUser');
    if(!(in_array('administrator', $user->roles))) {
        return;
    } 
}



//checking user permission, and if not valid, exists out of plugin

add_action('admin_footer', 'help_scout_beacon_js');


function help_scout_beacon_js() {
    ?>
    <script type="text/javascript">
        !function(e,t,n){ 
            function a(){
                var e = t.getElementsByTagName("script")[0], n = t.createElement("script");
                n.type="text/javascript", n.async=!0, n.src="https://beacon-v2.helpscout.net", e.parentNode.insertBefore(n,e)
            }
            if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a(); e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script><script type="text/javascript">window.Beacon('init', '85735735-ed6d-4731-92d9-babe3804e93a')
    </script>


    <?php
}
//if user is in wordpress admin panel
//if(!is_admin()) {
   // return;
//}









