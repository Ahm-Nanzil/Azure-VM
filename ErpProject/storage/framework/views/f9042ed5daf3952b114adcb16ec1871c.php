<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Inventory Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Model')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
<script>
    $(document).on('click', '[data-ajax-popup="true"]', function () {
    var modal = $('#commonModal');

    // Add a larger size class dynamically
    modal.find('.modal-dialog').addClass('modal-xl'); // Add Bootstrap's extra-large size
    modal.modal('show');
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

            <div class="card mb-3">
                <div class="card-header">
                    <h5>
                        Models
                    </h5>
                    <div class="float-end">
                        <a href="#" data-url="<?php echo e(route('inventory.model.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Model')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
                            <i class="ti ti-plus"></i>
                        </a>
                </div>
                </div>
                <div class="card-body">


                    <div class="mb-3">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th><?php echo e(__('Model Code')); ?></th>
                                        <th><?php echo e(__('Model Name')); ?></th>
                                        <th><?php echo e(__('Order')); ?></th>
                                        <th><?php echo e(__('Display')); ?></th>
                                        <th><?php echo e(__('Note')); ?></th>
                                        <th><?php echo e(__('Actions')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $model; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($m->code); ?></td>
                                            <td><?php echo e($m->name); ?></td>
                                            <td><?php echo e($m->order); ?></td>
                                            <td>
                                                <span class="badge bg-<?php echo e($m->display ? 'success' : 'danger'); ?>">
                                                    <?php echo e($m->display ? __('Enabled') : __('Disabled')); ?>

                                                </span>
                                            </td>
                                            <td><?php echo e($m->note); ?></td>
                                            <td>
                                                <!-- Edit Button -->
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="#" class=""  data-url="<?php echo e(route('inventory.model.edit', $m->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Model')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                </div>

                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.model.destroy',$m->id], 'class' => 'modalForm','id'=>'delete-form-'.$m->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                    <?php echo Form::close(); ?>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" class="text-center"><?php echo e(__('No Model found.')); ?></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/model.blade.php ENDPATH**/ ?>