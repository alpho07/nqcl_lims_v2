<!-- Page Content -->

<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">NQCL LIMS </h3><span>Issues Overview</span><a href="<?php echo base_url();?>Issues/create_new" class="btn btn-large btn-primary pull-right"><span class="glyphicon glyphicon-plus-sign"></span> NEW ISSUE</a>
            
        </div>
        <!-- /.col-lg-12 -->
    </div>
       <!-- /.row -->
       <div class="row" style="margin: 10px;">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                            <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example " style="width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>My Issues: OPEN</th>                                          
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($myissues as $issues ):?>
                                        <tr class="odd gradeX">
                                            <td>
                                           
                                                <span class="btn btn-small btn-danger">CREATED</span> 
                                         
                                                <a href="<?php echo base_url();?>issues/issue_pending/<?php echo $issues->id;?>"> <strong><?php echo $issues->title;?></strong></a> Was created by <strong><?php echo $issues->whose;?></strong> | <span class="glyphicon glyphicon-time"></span> <?php echo $issues->date_time;?> | Assigned to <strong><?php echo $issues->developer;?> </strong>  |  <a class="btn edit" href="<?php echo base_url();?>issues/issue_edit/<?php echo $issues->id;?>">Edit</a></td>                                            
                                            
                                        </tr>
                                        <?php endforeach;?>
                                       
                                       
                                       
                                    </tbody>
                                </table>
                            </div>
                       
                        </div>
                        <!-- /.panel-body -->
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
</div>
<!-- /.container-fluid -->

 <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
           "JQueryUI":true   
        });
    });
    </script>


