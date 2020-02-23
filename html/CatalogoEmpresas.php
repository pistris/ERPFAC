<!DOCTYPE html> 
<!--  
Template Name: Marvin - Responsive Bootstrap 4 Admin Dashboard Template
Author: Hencework
Contact: https://hencework.ticksy.com/

    <?php include('Templates/header.php'); ?>
    <?php include('Templates/scriptheader.php'); ?>


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


        <?php include('Modulos/Empresas/Empresas.html'); ?>
           

        </div>
        <!-- /Main Content -->

        
            <!-- Footer -->
            <?php include('Templates/footer.php'); ?>
            <!-- /Footer -->

    </div>
    <!-- /HK Wrapper -->

    <?php include('Templates/scriptFooter.php'); ?>
</body>

</html>