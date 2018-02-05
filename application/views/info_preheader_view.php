<!DOCTYPE html>
<html>
<head>
<title><?php if(isset($content)): echo $content['title']; else: echo 'Informace o stránky'; endif;?></title>
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<!-- Favicon -->
    <!-- Opera Speed Dial Favicon -->
<link rel="icon" type="image/png" href="<?php echo base_url().'speeddial-160px.png';?>" />			
    <!-- Standard Favicon -->
<link rel="icon" type="image/x-icon" href="<?php echo base_url().'favicon.ico';?>" />
    <!-- For iPhone 4 Retina display: -->
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url().'apple-touch-icon-114x114-precomposed.png'?>">
    <!-- For iPad: -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url().'apple-touch-icon-72x72-precomposed.png';?>">
    <!-- For iPhone: -->
<link rel="apple-touch-icon-precomposed" href="<?php echo base_url().'apple-touch-icon-57x57-precomposed.png';?>">
<!-- End. Favicon -->
<!-- Bootstrap -->
<link href="<?php echo base_url().'assets/bootstrap/css/bootstrap.min.css';?>" rel="stylesheet">
<link href="<?php echo base_url().'assets/fontawesome/css/font-awesome.min.css';?>" rel="stylesheet">
<link href="<?php echo base_url().'assets/template/css/yamm.css';?>" rel="stylesheet">
<link href="<?php echo base_url().'assets/template/css/style.css';?>" rel="stylesheet">
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap.min.js';?>"></script>
<script src="<?php echo base_url().'assets/bootstrap/js/holder.js';?>"></script>
<script src="<?php echo base_url().'assets/bootstrap/js/bootstrap-collapse.js';?>"></script>
<script src="<?php echo base_url().'assets/bootstrap/js/hoverdropdown.js';?>"></script>
<script src="<?php echo base_url().'assets/template/js/init.js';?>"></script>
<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter37048390 = new Ya.Metrika({ id:37048390, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true, trackHash:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://cdn.jsdelivr.net/npm/yandex-metrica-watch/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/37048390" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
</head>