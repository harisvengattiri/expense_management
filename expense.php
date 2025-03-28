<?php require_once "includes/menu.php"; ?>
<?php require_once "database.php"; ?>
<?php
    $expene_object = new Expense();
    $category_object = new Category();
?>
<div class="app-body">
    <!-- ############ PAGE START-->
    <div class="padding">
        <div class="box">
        <?php 
            $status = getStatusFromUrl();
            if($status) {
                displaySubmissionStatus($status);
            }
        ?>
            <div class="box-header">
                <span style="float: left;">
                    <h2>Expenses</h2>
                </span>
                <span style="float: right;">
                    <a href="<?php echo BASEURL; ?>/add/expense"><button class="btn btn-outline btn-sm rounded b-primary text-primary"><i class="fa fa-plus"></i> Add New Expense</a></button>
                    &nbsp;
                </span>
            </div><br />
            <div class="box-body">

                <form role="form" action="<?php echo BASEURL; ?>/expense" method="POST">
                    <div class="form-group row">
                        <div class="col-sm-2">
                            <input type="text" name="fdate" id="date" placeholder="From Date" class="form-control has-value" data-ui-jp="datetimepicker" data-ui-options="{
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
                  }" required>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="tdate" id="date" placeholder="To Date" class="form-control has-value" data-ui-jp="datetimepicker" data-ui-options="{
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
                  }" required>
                        </div>
                        <div class="col-sm-2">
                            <button name="submit" type="submit" class="btn btn-sm btn-outline rounded b-success text-success">Search</button>
                        </div>
                    </div>
                </form>
                <?php
                $filters = getSearchFilters();
                    $period_sql = $filters['period_sql'];
                    $mode = $filters['mode'];
                    $show_date = $filters['show_date'];
                    $filterSql = $period_sql;
                ?>
                <h4 style="padding: 15px 0;color: green;float:left;"><span style="font-weight:600;">Mode:</span> <?php echo $mode . $show_date; ?></h4>

                <span style="float: left;"></span>
                <span style="float: right;">Filter: <input id="filter" type="text" class="form-control form-control-sm input-sm w-auto inline m-r" /></span>
            </div>
            <div>
                <table class="table m-b-none" data-ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th>
                                Sl No
                            </th>
                            <th>
                                Expense
                            </th>
                            <th>
                                Category
                            </th>
                            <th>
                                Date
                            </th>
                            <th>
                                Amount
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($_POST['fdate'])) {
                            $expenses = $expene_object->getFilteredExpenses($filterSql);
                        } else {
                            $expenses = $expene_object->getExpensesWithLimit(100);
                        }
                        foreach($expenses as $expense) {
                            $id = $expense["id"];
                            
                            $catId = $expense['category'];
                            $category_details = $category_object->getCategoryDetails($catId);
                            $categoryName = $category_details['name'];
                        ?>
                                <tr>
                                    <td>EXP|<?php echo sprintf("%06d", $id); ?></td>
                                    <td><?php echo $expense["particular"];?></td>
                                    <td><?php echo $categoryName;?></td>
                                    <td><?php echo $expense["date"];?></td>
                                    <td><?php echo $expense["amount"];?></td>
                                    <td>
                                        <a href="<?php echo BASEURL; ?>/edit/expense?id=<?php echo $id;?>"><button class="btn btn-xs btn-icon info"><i class="fa fa-pencil"></i></button></a>
                                        <a href="<?php echo BASEURL; ?>/controller?controller=expense&delete_expense&id=<?php echo $id;?>" onclick="return confirm('Are you sure?')"><button class="btn btn-xs btn-icon danger"><i class="fa fa-trash"></i></button></a>
                                    </td>
                                </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot class="hide-if-no-paging">
                        <tr>
                            <td colspan="5" class="text-center">
                                <ul class="pagination"></ul>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php include "includes/footer.php"; ?>
