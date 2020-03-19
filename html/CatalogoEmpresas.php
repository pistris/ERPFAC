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
           

            <!-- Footer -->
            <?php include('Templates/footer.php'); ?>
            <!-- /Footer -->
        </div>
        <!-- /Main Content -->

        

    </div>
    <!-- /HK Wrapper -->

    <?php include('Templates/scriptFooter.php'); ?>
    
<!-- Data Table JavaScript -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../vendors/datatables.net-dt/js/dataTables.dataTables.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="SRC/dist/js/dataTables-data.js"></script>


</body>

</html>