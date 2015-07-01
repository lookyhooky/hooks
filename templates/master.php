<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="The Hooks Crane Service Website">
    <meta name="author" content="John Hooks">
    <meta name="google-site-verification" content="z9C4ax8RVA32m2HLESQKTdwvpcId5qRS1b6LWUjrfTo" />

    <title>HCS | <?=$this->e($title)?></title>

    <script>
     (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
     })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

     ga('create', 'UA-56085589-1', 'auto');
     ga('send', 'pageview');
    </script>
    
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- My CSS -->
    <link rel="stylesheet" href="/css/main.css">

    <!-- Fonts -->
    <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  
  <body>
    <!-- navbar -->
    <nav class="navbar navbar-default navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button"
                  class="navbar-toggle collapsed"
                  data-toggle="collapse"
                  data-target="#navbar"
                  aria-expanded="false"
                  aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">HCS</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li<?php
               if (strtolower($title) == 'home') {
                 echo ' class="active"';
               }
              ?>><a href="/">Home</a></li>
            <li<?php
               if (strtolower($title) == 'about') {
                 echo ' class="active"';
               }
               ?>><a href="/pages/about">About</a></li>
            <li<?php
               if (strtolower($title) == 'cranes') {
                 echo ' class="active"';
               }
              ?>><a href="/pages/cranes">Cranes</a></li>
            <li<?php
               if (strtolower($title) == 'contact') {
                 echo ' class="active"';
               }
               ?>><a href="/pages/contact">Contact</a></li>
            <!-- <li<?php
                    //if (strtolower($title) == 'schedule') {
                    //echo ' class="active"';
                    //}
                    ?>><a href="/schedule">Schedule</a></li> -->
          </ul>
        </div>
      </div><!-- .container -->
    </nav>

    <div class="container">
      <?=$this->section('content')?>
    </div>

    <footer class="footer">
      <div class="container text-center">
        <p class="text-muted">
          Hooks Crane &#160;&#149;&#160;
          Richland, WA &#160;&#149;&#160;
          509-547-5852
        </p>
      </div>
    </footer>
      
    <script src="/js/jquery.js"></script>
    <script src="/js/bootstrap.js"></script>
    <script src="/js/main.js"></script>
  </body>
</html>
