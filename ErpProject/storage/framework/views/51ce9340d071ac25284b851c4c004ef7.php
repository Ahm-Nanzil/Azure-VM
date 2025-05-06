<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Inventory Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Minmax')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.css">
<script src="https://cdn.jsdelivr.net/npm/handsontable/dist/handsontable.full.min.js"></script>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>




<script>
    document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('hot-table');

    // Convert Laravel array to JavaScript-compatible array
    const preloadedData = <?php echo json_encode($tableData, 15, 512) ?>;

    // Ensure preloaded data includes the ID column (add null if ID is missing for new rows)
    const formattedData = preloadedData.map(row => {
        if (row.length === 5) {
            // Add a null ID for rows without one
            return [null, ...row];
        }
        return row; // Keep rows with ID as is
    });

    // Handsontable instance
    const hot = new Handsontable(container, {
        data: formattedData, // Preload saved data here
        colHeaders: [
            'ID', // ID column
            'Commodity Code',
            'Commodity Name',
            'SKU Code',
            'Minimum Inventory Value',
            'Maximum Inventory Qty'
        ],
        columns: [
            { data: 0, readOnly: true }, // ID (Read-Only Column)
            { data: 1, type: 'text' },   // Commodity Code
            { data: 2, type: 'text' },   // Commodity Name
            { data: 3, type: 'text' },   // SKU Code
            { data: 4, type: 'numeric' }, // Minimum Inventory Value
            { data: 5, type: 'numeric' }  // Maximum Inventory Qty
        ],
        hiddenColumns: {
            columns: [0], // Hide the ID column from the user
            indicators: false
        },
        rowHeaders: true,
        contextMenu: true,
        manualRowMove: true,
        manualColumnMove: true,
        minSpareRows: 1, // Always keep an empty row for new entries
        licenseKey: 'non-commercial-and-evaluation' // Free for personal use
    });

    // Save data to the form
    document.getElementById('saveBtn').addEventListener('click', function () {
        const tableData = hot.getData();

        // Ensure rows with empty fields are filtered out
        const filteredData = tableData.filter(row => {
            return row.some((cell, index) => {
                // Skip the ID column (index 0) when checking for empty rows
                return index > 0 && cell !== null && cell !== '';
            });
        });

        document.getElementById('table_data').value = JSON.stringify(filteredData);
        document.getElementById('inventory-form').submit();
    });
});

</script>


<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>

<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>





<div class="row">
    <div class="col-3">
        <?php echo $__env->make('layouts.inventory_setup', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
    <div class="col-9">
        <div class="row">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">
                        <h5>
                            Set Minimum and Maximum Inventory Values
                        </h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <!-- Ensure the table container takes up full width -->
                            <div id="hot-table" class="mb-3" style="100%;"></div>

                            <form action="<?php echo e(route('inventory.minmax')); ?>" method="POST" id="inventory-form">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="table_data" id="table_data">
                                <button type="button" class="btn btn-success" id="saveBtn">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/minmax.blade.php ENDPATH**/ ?>