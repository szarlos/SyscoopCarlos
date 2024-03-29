
<!--</div> -->
<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>

    <meta charset="utf-8" />

    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>SysCoop</title>

    <meta name="description" content="" />
    
     <!-- Mobile viewport optimized: j.mp/bplateviewport -->
 	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css" />
    <link href="http://fonts.googleapis.com/css?family=Droid+Serif:regular,bold" rel="stylesheet" /> <!-- Load Droid Serif from Google Fonts -->
      
    <!-- All JavaScript at the bottom, except for Modernizr and Respond.
    	Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries -->
    
    <script src="js/modernizr-1.7.min.js"></script>
    <script src="js/respond.min.js"></script>
</head>

<body>

<div id="wrapper">

    <header id="header" class="clearfix" role="banner">
    
        <hgroup>
            <h1 id="site-title"><?php echo anchor('index/', 'SysCoop'); ?></h1>
            
        </hgroup>
    </header> <!-- #header -->
    <ul id="menu">
        <p>
            <a href="#"></a>
        </p>
    </ul>
 <!-- #main -->

<div id="main" class="content"> 
   <?php  if (!(is_null($contenidoPrincipal))){
        echo $contenidoPrincipal;
          }
     ?>
    </div>
 <!-- #footer -->
<footer id="footer">
        <!-- You're free to remove the credit link to Jayj.dk in the footer, but please, please leave it there :) -->
        <p>
              Habilitación Profesional 2012 | Grupo 1
            <!-- 
            Copyright &copy; 2011 <a href="#" target="_blank">Sitename.com</a>
            <span class="sep">|</span>
            Design by <a href="http://jayj.dk" title="Design by Jayj.dk" target="_blank">Jayj.dk</a>
			<span class="sep">|</span>
			And my dearest sister in law <a href="https://twitter.com/marilau_ml"  target="_blank">Grupo 1 menos Marilau</a>
       -->
            </p>
    </footer> <!-- #footer -->
    
    <div class="clear"></div>

</div> <!-- #wrapper -->

	<!-- JavaScript at the bottom for fast page loading -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
