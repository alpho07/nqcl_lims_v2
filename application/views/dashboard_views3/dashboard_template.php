<?php $this->load->view('dashboard_views/header_files'); ?><body>
    <!-- start: Header -->
    <?php $this->load->view('dashboard_views/navbar'); ?>
    <!-- start: Header -->

    <div class="container-fluid-full">
        <div class="row-fluid">

            <!-- start: Main Menu -->
            <?php $this->load->view('dashboard_views/main_menu'); ?>
            <!-- end: Main Menu -->

            <!-- start: Content -->
            <div id="content" class="span10">

                <?php $this->load->view($contents); ?>
            </div>
            <!-- end: Content -->

        </div><!--/fluid-row-->

        <div class="modal hide fade" id="myModal">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h3>Settings</h3>
            </div>
            <div class="modal-body">
                <p>Here settings can be configured...</p>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn" data-dismiss="modal">Close</a>
                <a href="#" class="btn btn-primary">Save changes</a>
            </div>
        </div>

        <div class="clearfix"></div>

        <?php $this->load->view('dashboard_views/footer'); ?>
    </div>
    <?php $this->load->view('dashboard_views/js'); ?>

</body>
</html>