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
    <link href="<?php echo base_url(); ?>css/calendar.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>js/calendar.js"></script>
</head>

<body>

<div id="wrapper">

    <header id="header" class="clearfix" role="banner">
    
        <hgroup>
            <h1 id="site-title"><?php echo anchor('index/', 'SysCoop'); ?></h1>
        </hgroup>
        <hgroup style="text-align: right">
            <p><small><?php echo $this->session->userdata('name'),' - ', $this->session->userdata('puesto'); ?></small> </p>
        </hgroup>
       
    </header> <!-- #header -->
    <ul id="menu">
        <li>
            <a href="#">Ingreso</a>
                <ul>
                    <li><?php echo anchor('estampillas', 'Estampillas'); ?> </li>
                    <li><?php echo anchor('cuotas', 'Cuotas'); ?> </li>
                    <li><?php echo anchor('alquileres', 'Alquileres'); ?> </li>
                    <li><?php echo anchor('radios', 'Radio'); ?> </li>
                    <li><?php echo anchor('servicios_ingreso', 'Servicios a Terceros'); ?> </li>
                        <ul>
                            <li><a href="#">3.1.1 Download</a></li>
                            <li><a href="#">3.1.2 Tutorial</a></li>
                        </ul>
                    <li><?php echo anchor('otras_rendiciones', 'Rendiciones Cajeros'); ?> </li>
                    <li><?php echo anchor('reintegros', 'Reintegros de Anticipos'); ?> </li>
                    <li><?php echo anchor('otros_ingresos', 'Otros Ingresos'); ?> </li>
                </ul>
        </li>
	<li>
            <a href="#">Egreso</a>
		<ul>
                    <li><?php echo anchor('anticipos', 'Anticipos para Gastos'); ?> </li>
                    <li><?php echo anchor('honorarios', 'Honorarios'); ?> </li>
                    <li><?php echo anchor('becas', 'Becas'); ?> </li>
                    <li><?php echo anchor('serv_egr', 'Servicios de Terceros'); ?> </li>
                    <li><?php echo anchor('viaticos', 'Viaticos'); ?> </li>
                    <li><?php echo anchor('publicidad', 'Publicidad'); ?> </li>
                    <li><?php echo anchor('otros_egresos', 'Otros Egresos'); ?> </li>
                </ul>
	</li>
        <li>
            <a href="#">Informes</a>
		<ul>
                    <li><?php echo anchor('rendiciones', 'Rendiciones Diarias'); ?> </li>
                    <!--<li> <?php echo anchor('index/otros_informes', 'Otros informes?'); ?> </li>-->
                </ul>
        </li>
        <li>
            <?php echo anchor('index/cerrar_caja', 'Cerrar Caja'); ?> 
        </li>
	<li>
            <?php echo anchor('index/logout', 'Salir'); ?> 
        </li>
</ul>


<div id="main" class="content"> 
   <?php  if (!(is_null($contenidoPrincipal))){
        echo $contenidoPrincipal;
          }
     ?>
</div> <!-- #main -->
<footer id="footer">
        <!-- You're free to remove the credit link to Jayj.dk in the footer, but please, please leave it there :) -->
        <small>Habilitación Profesional 2012 | Grupo 1</small>
              
            <!-- 
            Copyright &copy; 2011 <a href="#" target="_blank">Sitename.com</a>
            <span class="sep">|</span>
            Design by <a href="http://jayj.dk" title="Design by Jayj.dk" target="_blank">Jayj.dk</a>
			<span class="sep">|</span>
			And my dearest sister in law <a href="https://twitter.com/marilau_ml"  target="_blank">Grupo 1 menos Marilau</a>
       -->
            
</footer> <!-- #footer -->
    


</div> <!-- #wrapper -->

	<!-- JavaScript at the bottom for fast page loading -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js"></script>
    <script src="js/script.js"></script>

</body>
</html>
