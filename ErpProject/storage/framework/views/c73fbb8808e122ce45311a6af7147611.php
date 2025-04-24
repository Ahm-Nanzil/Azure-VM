<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory History')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('History')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">


        

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">

        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('Form Code')); ?></th>
                                        <th><?php echo e(__('Product Code')); ?></th>
                                        <th><?php echo e(__('Warehouse Code')); ?></th>
                                        <th><?php echo e(__('Warehouse Name')); ?></th>
                                        <th><?php echo e(__('Voucher Date')); ?></th>
                                        <th><?php echo e(__('Opening Stock')); ?></th>
                                        <th><?php echo e(__('Closing Stock')); ?></th>
                                        <th><?php echo e(__('Lot Number/Quantity Sold')); ?></th>
                                        <th><?php echo e(__('Expiry Date')); ?></th>
                                        <th><?php echo e(__('Serial Number')); ?></th>
                                        <th><?php echo e(__('Note')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $inventoryHistories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="font-style">
                                            <td><?php echo e($history->form_code); ?></td>
                                            <td><?php echo e($history->product_code); ?></td>
                                            <td><?php echo e($history->warehouse_code); ?></td>
                                            <td><?php echo e($history->warehouse_name); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($history->voucher_date)->format('d-m-Y')); ?></td>
                                            <td><?php echo e($history->opening_stock); ?></td>
                                            <td><?php echo e($history->closing_stock); ?></td>
                                            <td><?php echo e($history->lot_number_quantity_sold); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($history->expiry_date)->format('d-m-Y') ?? '-'); ?></td>
                                            <td><?php echo e($history->serial_number); ?></td>
                                            <td><?php echo e($history->note); ?></td>
                                            <td><?php echo e($history->status); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>



                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventory_history/index.blade.php ENDPATH**/ ?>