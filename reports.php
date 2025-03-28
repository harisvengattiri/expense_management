<?php require_once "config.php"; ?>
<?php require_once "includes/menu.php"; ?>
<?php require_once "database.php"; ?>
<?php
    $category_object = new Category();
?>

<script>
    function target_popup(form) {
        window.open('', 'formpopup', 'width=1350,height=650,resizeable,scrollbars');
        form.target = 'formpopup';
    }
</script>

<div class="app-body">
    <!-- ############ PAGE START-->
    <div class="padding">
        <div style="" id="batch" class="row">
            <div class="col-md-6">
                <div class="box">
                    <div class="box-header">
                        <h2>Report of Expense</h2>
                    </div>
                    <div class="box-divider m-a-0"></div>
                    <div class="box-body">
                        <form role="form" action="<?php echo BASEURL; ?>/report/expense" method="post" onsubmit="target_popup(this)">
                            <div class="form-group row">
                                <label for="date" align="right" class="col-sm-1 form-control-label">From</label>
                                <div class="col-sm-3">
                                    <input type="text" name="fdate" id="fdate" placeholder="Start Date" class="form-control has-value" data-ui-jp="datetimepicker" data-ui-options="{
                                        format: 'DD/MM/YYYY',
                                        icons: {
                                        time: 'fa fa-clock-o',
                                        date: 'fa fa-calendar',
                                        up: 'fa fa-chevron-up',
                                        down: 'fa fa-chevron-down',
                                        previous: 'fa fa-chevron-left',
                                        next: 'fa fa-chevron-right',
                                        today: 'fa fa-screenshot',
                                        clear: 'fa fa-trash',
                                        close: 'fa fa-remove'
                                        }
                                    }">
                                </div>

                                <label for="date" align="right" class="col-sm-1 form-control-label">To</label>
                                <div class="col-sm-3">
                                    <input type="text" name="tdate" id="tdate" placeholder="End Date" Required="Required" class="form-control has-value" data-ui-jp="datetimepicker" data-ui-options="{
                                        format: 'DD/MM/YYYY',
                                        icons: {
                                        time: 'fa fa-clock-o',
                                        date: 'fa fa-calendar',
                                        up: 'fa fa-chevron-up',
                                        down: 'fa fa-chevron-down',
                                        previous: 'fa fa-chevron-left',
                                        next: 'fa fa-chevron-right',
                                        today: 'fa fa-screenshot',
                                        clear: 'fa fa-trash',
                                        close: 'fa fa-remove'
                                        }
                                    }">
                                </div>

                                <div class="col-sm-3">
                                    <select name="category" class="form-control select2-multiple" data-ui-jp="select2" data-ui-options="{theme: 'bootstrap'}">
                                        <option value="">All Category</option>
                                        <?php
                                            $categories = $category_object->getCategriesWithLimit(100);
                                            foreach($categories as $category) {
                                        ?>
                                            <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                            </div>

                            <div class="form-group row m-t-md">
                                <div align="right" class="col-sm-offset-2 col-sm-12">
                                    <button type="reset" class="btn btn-sm btn-outline rounded b-danger text-danger">Clear</button>
                                    <button name="submit" type="submit" class="btn btn-sm btn-outline rounded b-success text-success">View</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ############ PAGE END-->

</div>
</div>
<!-- / -->

<?php include "includes/footer.php"; ?>