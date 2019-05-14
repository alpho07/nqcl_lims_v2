
<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation" style="margin-bottom: 0; ">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a href="<?php echo base_url()?>"><span class="icon-backward">< Back</span></a>
        <a class="navbar-brand" style="color: #FFFFFF; font-weight: bold;" href="<?php echo base_url().'report_engine/dep/'.$year; ?>/">REPORTS</a>
    </div>
    <!-- /.navbar-header -->
    <ul class="nav navbar-nav">
           <!--   <li  ><a class="white" style="color: #FFFFFF; font-weight: bold; " href="<?php echo base_url(); ?>Issues"><i class="fa fa-dashboard yellow "></i> Dashboard</a></li> 
        <span class="btn-separator"></span>

        <li ><a class="white" style="color: #FFFFFF; font-weight: bold;" href="<?php echo base_url();?>issues/log_open/0"><i class="fa fa-exclamation-circle"></i> Your Issues</a></li>
              <li><a href="#contact">Contact</a></li>-->
        <!--            <li class="dropdown">
                      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Dropdown <span class="caret"></span></a>
                      <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                      </ul>
                    </li>-->
    </ul>
    <ul class="nav navbar-top-links navbar-right">
        <li class="dropdown">
            <?php $userarray = $this->session->userdata;
 $user_id = $userarray['user_id'];
if($user_id ==''){
    redirect('user_management/login');
}                   

                    $user_typ = User::getUserType($user_id);
                    $title = $user_typ[0]['title'];
                    $user_name = $user_typ[0]['fname'];
                     $lname = $user_typ[0]['lname'];
                    //$messages = $user_typ[0]['pm_count'];
                    //echo $user_id;
                    ?>
        <li  style="color: white; font-weight: bold;"><i class="fa fa-user yellow "></i> Welcome : <?php echo $title . $user_name." ". $lname;?> </a></li> 

            <ul class="dropdown-menu dropdown-messages">
               
            </ul>
            <!-- /.dropdown-messages -->
        </li>
        <!-- /.dropdown -->
      
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-bell fa-fw"></i>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
              
           
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
  
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">

                <li style="text-align: left; margin-top: 10px;  font-weight: bold;">
                    LIMS REPORTS
                    <span class="glyphicon glyphicon-arrow-down"></span>                  
                </li>
                          <li style="margin-top: 10px; text-align: left;">
                    <a href="<?php echo base_url();?>report_engine/dep/<?php echo date('Y');?>"> <strong>Analysts</strong><span class="glyphicon glyphicon-menu-right"></span></a>

                </li>
                            <li style="margin-top: 10px; text-align: left;">
                    <a href="<?php echo base_url().'dreport/supervisor/'.date('Y');?>"> <strong>Supervisors </strong><span class="glyphicon glyphicon-menu-right"></span></a>

                </li>
                            <li style="margin-top: 10px; text-align: left;">
                    <a href="<?php echo base_url().'dreport/reviewer/'.date('Y');?>"> <strong>Reviewers</strong><span class="glyphicon glyphicon-menu-right"></span></a>

                </li>
                            <li style="margin-top: 10px; text-align: left;">
                    <a href="<?php echo base_url();?>dreport/dcoarev/<?php echo date('Y');?>"> <strong>Draft COA Review</strong><span class="glyphicon glyphicon-menu-right"></span></a>

                </li>

            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>