         <li>
            <a href="#">Ingreso</a>
                <ul>
                    <li><?php echo anchor('index/estampillas', 'Estampillas'); ?> </li>
                    <li><?php echo anchor('index/ver_cuotas', 'Cuotas'); ?> </li>
                    <li><?php echo anchor('index/alquiler', 'Alquileres'); ?> </li>
                    <li><?php echo anchor('index/radio', 'Radio'); ?> </li>
                    <li><?php echo anchor('index/serv_ter', 'Servicios a Terceros'); ?> </li>

                </ul>
        </li>
	<li>
            <a href="#">Egreso</a>
		<ul>
                    <li><?php echo anchor('index/anticipos', 'Anticipos'); ?> </li>
                    <li><?php echo anchor('index/honorarios', 'Honorarios'); ?> </li>
                    <li><?php echo anchor('index/becas', 'Becas'); ?> </li>
                    <li><?php echo anchor('index/serv_egr', 'Servicios'); ?> </li>
                    <li><?php echo anchor('index/viaticos', 'Viaticos'); ?> </li>
                    <li><?php echo anchor('index/publicidad', 'Publicidad'); ?> </li>
                </ul>
	</li>
        <li>
            <a href="#">Informes</a>
		<ul>
                    <li><?php echo anchor('index/rendiciones', 'Rendiciones Diarias'); ?> </li>
                    <!--<li> <?php echo anchor('index/otros_informes', 'Otros informes?'); ?> </li>-->
                </ul>
        </li>
        <li>
            <?php echo anchor('index/cerrar_caja', 'Cerrar Caja'); ?> 
        </li>