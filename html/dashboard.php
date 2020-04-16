<!DOCTYPE html> 
<!--  
Template Name: Marvin - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/

    <?php 
    
        session_start();
        if(!isset($_SESSION['intUsuario'])){
            header('Location: login.html?error=1');
        }
        include('Templates/header.php'); 
        include('Templates/scriptheader.php'); 
    ?>

 
    <!-- Adapte sus script -->

</head>

<body>
    <!-- Preloader 
    <div class="preloader-it">
        <div class="loader-pendulums"></div>
    </div>
    --><!-- /Preloader -->
	
    <!-- HK Wrapper -->
    <div class="hk-wrapper hk-vertical-nav">
        <?php include('Templates/aside.php'); ?>
    
        <!-- Main Content -->
        <div class="hk-pg-wrapper">
        <!-- crear funcion alerts.php -->
        <?php if(isset($_REQUEST['varPermiso']) && $_REQUEST['varPermiso'] == 1){ ?>
            <div class="alert alert-danger" id="divMensajeError" role="alert" style="text-align: center;">
                <label id="lblMensajeError" style="color: #8b0c12;">No cuentas con los permisos necesarios</label>
            </div>
        <?php } ?>


            <!-- Footer -->
            <?php include('Templates/footer.php'); ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

        

    </div>
    <!-- /HK Wrapper -->
    <!-- Adapte sus script -->
    <?php include('Templates/scriptFooter.php'); ?>
</body>

</html>