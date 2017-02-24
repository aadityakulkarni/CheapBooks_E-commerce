<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<?php
/**
 * Created by PhpStorm.
 * User: Aaditya
 * Date: 11/26/2016
 * Time: 10:37 PM
 */

$prj_url = explode("index.php", site_url())[0];

$navigation = "

<nav class=\"navbar navbar-inverse\">
  <div class=\"container-fluid\">
    <div class=\"navbar-header\">
      <button type=\"button\" class=\"navbar-toggle collapsed\" data-toggle=\"collapse\" data-target=\"#bs-example-navbar-collapse-1\" aria-expanded=\"false\">
        <span class=\"sr-only\">Toggle navigation</span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
        <span class=\"icon-bar\"></span>
      </button>
      <a class=\"navbar-brand\" href=\"".$prj_url."\">CheapBooks</a>
    </div>
    <div class=\"collapse navbar-collapse pull-right\" >
      <ul id='logout' class=\"nav navbar-nav\">
        <li><a href=\"".$prj_url."index.php/logout\">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

";
?>