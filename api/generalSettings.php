<?php
    if(isset($_POST['acceptedSiteRules'])){
        setcookie("accepted","true",time()+60*60*24*30,"/");       
    }