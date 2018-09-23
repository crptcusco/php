<div class="contain-to-grid sticky">
    <nav class="top-bar" data-topbar role="navigation" data-options="sticky_on: large"> 

        <section class="top-bar-section">
            <!-- Right Nav Section -->
            <ul class="left">
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <li><a href="<?php get_module_url('autentificacion') ?>"><?php echo $_SESSION['usuario'] ?></a></li>
<?php } else { ?>
                    <li><a href="#">...</a></li>
<?php } ?>
                <li class="has-dropdown">
                    <a href="#">SISTEMA VENTAS - COTIZACION</a>
                    <ul class="dropdown">
                        <li><a href="<?php get_module_url('ventas') ?>">Ventas</a></li>
                        <li><a href="<?php get_module_url('cotizacion') ?>">Cotización</a></li>
                        <li><a href="<?php get_module_url('coordinacion') ?>">Coordinación</a></li>
                        <!--<li><a href="<?php get_module_url('facturacion') ?>">Facturación</a></li>-->
                    </ul>
                </li>    
                <li><a href="../paginas/index.php">Paginas de Consulta</a></li>
                <li><a href="../estudio_mercado/index.php">Estudios de Mercado</a></li>
            </ul>
            <!-- Left Nav Section -->
            <ul class="right">
                <?php if (isset($_SESSION['usuario'])) { ?>
                    <li><a href="<?php get_module_url('autentificacion/logout.php') ?>">LogOut</a></li>
<?php } else { ?>
                    <li><a href="<?php get_module_url('autentificacion') ?>">Login</a></li>
<?php } ?>
            </ul>
        </section>
    </nav> 
</div>
<?php

function get_module_url($modulo) {
    global $modulos_url;
    echo $modulos_url . $modulo;
}
