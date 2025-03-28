<?php require_once "includes/menu.php"; ?>
<?php require_once "database.php"; ?>
<?php
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
                    <h2>Category List</h2>
                </span>
                <span style="float: right;">
                    <a href="<?php echo BASEURL; ?>/add/category"><button class="btn btn-outline btn-sm rounded b-primary text-primary"><i class="fa fa-plus"></i> Add New Category</a></button>
                    &nbsp;
                </span>
            </div><br />
            <div>
                <table class="table m-b-none" data-ui-jp="footable" data-filter="#filter" data-page-size="10">
                    <thead>
                        <tr>
                            <th>
                                Sl No
                            </th>
                            <th>
                                Category Name
                            </th>
                            <th>
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $categories = $category_object->getCategriesWithLimit(100);
                        
                        foreach($categories as $category) {
                            $id = $category["id"];
                        ?>
                                <tr>
                                    <td>CAT|<?php echo sprintf("%06d", $id); ?></td>
                                    <td><?php echo $category["name"];?></td>
                                    <td></td>
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
