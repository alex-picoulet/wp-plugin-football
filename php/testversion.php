<?php
    require_once('ripcord/ripcord.php');
    $url = "http://host.docker.internal:8069";
    $common = ripcord::client($url."/xmlrpc/2/common");
    var_dump($common->version());
