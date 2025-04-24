<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Quotations')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Quotations')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        

        <a href="<?php echo e(route('quotations.create')); ?>" class="btn btn-sm btn-primary">
            create new estimate
        </a>

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body table-border-style">
                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo e(__('Estimate #')); ?></th>
                                <th class="text-center"><?php echo e(__('Amount (USD)')); ?></th>
                                <th class="text-center"><?php echo e(__('Vendors')); ?></th>
                                <th class="text-center"><?php echo e(__('Purchase Request')); ?></th>
                                <th class="text-center"><?php echo e(__('Date')); ?></th>
                                <th class="text-center"><?php echo e(__('Expiry Date')); ?></th>
                                <th class="text-center"><?php echo e(__('Actions')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $estimates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $estimate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($estimate->estimate_number); ?></td>
                                <td class="text-center"><?php echo e(number_format($estimate->grand_total, 2)); ?></td>
                                <td class="text-center"><?php echo e($estimate->vendor_id); ?></td>
                                <td class="text-center"><?php echo e($estimate->purchase_request_id); ?></td>
                                <td class="text-center"><?php echo e($estimate->estimate_date); ?></td>
                                <td class="text-center"><?php echo e($estimate->expiry_date); ?></td>
                                <td class="text-center">

                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\Modules/Purchases\Resources/views/quotations/index.blade.php ENDPATH**/ ?>