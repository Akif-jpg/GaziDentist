<?php
ob_start();
session_start();
?>
<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Gazi Diş Blog">
    <meta name="author" content="Akif Esad Tosun">
    <meta name="keywords" content="Diş hekimliği,Dişçilik, Dişçi,Gazi üniversitesi, Diş hekimliği bölümü">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gazi Dentist</title>
    <!-- Bootstrap Core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/css/w3.css" rel="stylesheet" type="text/css">
    <link href="/css/blog-home.css" rel="stylesheet">    
    <link href="/css/footer.css" rel="stylesheet" type="text/css">
    <link href="/css/side-bar.css" rel="stylesheet" type="text/css"/>
    <link href="/admin/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="/js-snackbar/js-snackbar.css" rel="stylesheet" type="text/css"/> 
    
    <!--favicon-->
    <link href="/favicon.png" rel="icon" type="image/png" />
    <style>
    header{
    padding: 1em;
    color: white;
    background-color: black;
    clear: left;
    text-align: center;
    }
</style>
</head>

<body>
<?php 

    if(!isset($_COOKIE["accepted"])){
        ?>
    <script src="/js-snackbar/js-snackbar.js"></script>
    <script>
        new SnackBar({
            message: "Bu site çalışması için zorunlu olan birtakım çerezleri kullanmaktadır.\
             Daha detaylı bilgi için gizlilik sözleşmesine bakınız.(Uygulama tamamen test aşamasındadır. Kayıt verileriniz sonra silinecektir ve pek ok şey düzgün çalışmayabilir.)",
            type: "info",
            status: "warning",
            icon: "warn",
            timeout: false,
            fixed: true,
            position: "bc",
            actions: [
                {
                    text: "Kabul Ediyorum",
                    dismiss: true,
                    function: function () {
                        $.ajax({
                            type: "POST",
                            url: "/api/generalSettings.php",
                            data: {
                                "acceptedSiteRules" : true
                                },
                            success: function(){
                                console.log("Accepted");
                            }
                        });                        
                    }
                }
            ]       
            
        });
    </script>
        <?php
    }