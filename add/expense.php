<?php require_once "../includes/menu.php";?>
<?php require_once "../database.php"; ?>
<?php
    $category_object = new Category();
?>
<div class="app-body">
<!-- ############ PAGE START-->
<div class="padding">
  <div class="row">
    <div class="col-md-6">
      <div class="box">
        <div class="box-header">
          <h2>Add New Expense</h2>
          </div>
        <div class="box-divider m-a-0"></div>
        
        <div class="box-body">
          <form role="form" action="<?php echo BASEURL;?>/controller" method="post">
            <input type="hidden" name="controller" value="expense">
            <div class="form-group row">
              <label for="Quantity" class="col-sm-3 form-control-label">Particular</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" name="particular" placeholder="Particular">
              </div>
            </div>
            <div class="form-group row">
              <label for="Quantity" class="col-sm-3 form-control-label">Category</label>
              <div class="col-sm-8">
                <select name="category" class="form-control select2-multiple" data-ui-jp="select2" data-ui-options="{theme: 'bootstrap'}" required>
                  <option value="">Select Category</option>
                  <?php
                    $categories = $category_object->getCategriesWithLimit(100);
                    foreach($categories as $category) {
                  ?>
                    <option value="<?php echo $category['id'];?>"><?php echo $category['name'];?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
            <?php 
            $today = date("d/m/Y");
            ?>
              <label for="Quantity" align="left" class="col-sm-3 form-control-label">Date</label>
              <div class="col-sm-8">
                <input type="text" name="date" value="<?php echo $today;?>" id="date" placeholder="Production Date" class="form-control has-value" data-ui-jp="datetimepicker" data-ui-options="{
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
                <input type="text" class="form-control" name="amount" placeholder="Amount">
              </div>    
            </div>
               
            <div class="form-group row m-t-md">
              <div align="right" class="col-sm-offset-2 col-sm-12">
                <button type="reset" class="btn btn-sm btn-outline rounded b-danger text-danger">Clear</button>
                <button name="add_expense" type="submit" class="btn btn-sm btn-outline rounded b-success text-success">Save</button>
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
