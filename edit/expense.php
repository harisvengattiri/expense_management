<?php require_once "../includes/menu.php";?>
<?php require_once "../database.php";?>
<?php require_once "../classes/DatabaseConnection.php";?>
<?php require_once "../classes/Expense.php";?>
<?php
if(isset($_GET['id'])) {
    try {
        $expense = $_GET['id'];
        $expense_object = new Expense();
        $expense_details = $expense_object->getExpenseDetails($expense);
    } catch (Exception $e) {
        error_log("Expense Fetch Error: " . $e->getMessage());
        exit;
    }
}
?>
<div class="app-body">
<!-- ############ PAGE START-->
<div class="padding">
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h2>Edit Expense</h2>
          </div>
        <div class="box-divider m-a-0"></div>
        <div class="box-body">
          <form role="form" action="<?php echo BASEURL;?>/controller" method="post">
            <input type="hidden" name="controller" value="expense">
            <input type="hidden" name="expense" value="<?php echo $expense;?>">
            <div class="form-group row">
              <label for="Quantity" class="col-sm-3 form-control-label">Particular</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="particular" value="<?php echo $expense_details['particular'];?>" placeholder="Particular">
              </div>
            </div>
            <div class="form-group row">
              <label for="Quantity" align="left" class="col-sm-3 form-control-label">Date</label>
              <div class="col-sm-8">
                <input type="text" name="date" value="<?php echo $expense_details['date'];?>" id="date" placeholder="Production Date" class="form-control has-value" data-ui-jp="datetimepicker" data-ui-options="{
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
            </div>
            <div class="form-group row">
              <label for="Quantity" align="left" class="col-sm-3 form-control-label">Amount</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="amount" value="<?php echo $expense_details['amount'];?>" placeholder="Amount">
              </div>    
            </div>
               
            <div class="form-group row m-t-md">
              <div align="right" class="col-sm-offset-2 col-sm-12">
                <button type="reset" class="btn btn-sm btn-outline rounded b-danger text-danger">Clear</button>
                <button name="edit_expense" type="submit" class="btn btn-sm btn-outline rounded b-success text-success">Save</button>
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
<?php include "../includes/footer.php";?>
