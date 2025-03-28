<?php require_once "../database.php";?>

<?php
session_start();
if(!isset($_SESSION['userid']))
{
   header("Location:$baseurl/login/");
}
$filters = getSearchFilters();
$period_sql = $filters['period_sql'];
$show_date = $filters['show_date'];
$cat_sql = $filters['cat_sql'];
$filter_sql = $period_sql.$cat_sql;

$expense_object = new Expense();
$category_object = new Category();
?>

<style>
table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}
th {
    background-color: #4CAF50;
    color: white;
}
h1, h2 {
    font-family: Arial, Helvetica, sans-serif;
}
th,td {
    font-family: verdana;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>

<!-- <div style="margin-top: -55px;" id="head" align="center"><img src="../images/header.png"></div>   -->
<h2 style="text-align:center;margin-bottom:1px;">EXPENSE REPORT</h2>
<table align="center" style="width:90%;">
     <tr>
          <td width="50%">
               <span style="font-size:15px;"></span>
          </td>
          <td width="50%" style="text-align:right"><span style="font-size:15px;"> Date: From <?php echo $show_date;?></span></td>
     </tr>     
</table>  
    
<table id="tbl1" align="center" style="width:90%;">
        <thead>
          <tr>
               <th>
                  Sl No
              </th>
              <th>
                  Expense
              </th>
              <th>
                  Particular
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
          </tr>
        </thead>
        <tbody style="font-size:11px;">
		<?php
            $sl=1;
            $tot_amount=0;
            $expenses = $expense_object->getExpensesWithInPeriod($filter_sql);
            foreach($expenses as $expense) {
             $id = $expense['id'];

             $catId = $expense['category'];
             $category_details = $category_object->getCategoryDetails($catId);
             $categoryName = $category_details['name'];
        ?>
          <tr>
               <td><?php echo $sl;?></td>
               <td>EXP|<?php echo sprintf("%06d", $id);?></td>
               <td><?php echo $expense['particular'];?></td>
               <td><?php echo $categoryName;?></td>
               <td><?php echo $expense['date'];?></td>
               <td><?php echo $expense['amount'];?></td>
          </tr>
		<?php 
            $sl=$sl+1;
            $tot_amount = $tot_amount+$expense['amount'];
            }
        ?>
        <tr>
            <td colspan="5"></td>
            <td colspan="1"><b><?php echo $tot_amount;?></b></td>
        </tr>
        </tbody>
      </table>
<?php
if(isset($_POST['print']))
{?>
<body onload="window.print()">
<?php } ?>