<?php 
/** 
 * Plugin Name: Help Scout Beacon
 * 
 * 
 * 
*/
error_log("Test");


//this ensures that no one can brute force into the application, safety measure
if(!(defined('ABSPATH'))) {
    exit;
}
//when the pluggins are loaded and intialized, the verifyUser function will run
add_action('plugins_loaded', 'verifyUser');
//functino returns the current user objects 
function getUser() {
    return wp_get_current_user(); // Retrieve the current user object
}

//main function that will execute the plugin depending on authentication
function verifyUser() {
    $user = getUser(); // Call getUser() to get the current user
    //checks if the current user is an administrator or not 
    if (!(in_array('administrator', $user->roles))) {
        //will not return the plugin
        return;
    } else {

       //using action hook to execute function into admin footer 
        add_action('admin_footer', 'help_scout_beacon_js');
        //using action hook to execute function into elementor footer 
        add_action('elementor/editor/footer', 'help_scout_beacon_js');
    }
}






//function executes the javascript for the helpScout beacon
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









