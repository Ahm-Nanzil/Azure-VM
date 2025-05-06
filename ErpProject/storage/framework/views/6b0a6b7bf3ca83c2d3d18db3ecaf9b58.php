<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Inventory Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Colors')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
            <a href="#" data-url="<?php echo e(route('inventory.colors.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Color')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
    </div>
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
                                Colors List
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Color Code')); ?></th>
                                                <th><?php echo e(__('Color Name')); ?></th>
                                                <th><?php echo e(__('Color Hex')); ?></th>
                                                <th><?php echo e(__('Order')); ?></th>
                                                <th><?php echo e(__('Note')); ?></th>
                                                <th><?php echo e(__('Display')); ?></th>
                                                <th><?php echo e(__('Actions')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $__empty_1 = true; $__currentLoopData = $colors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($color->color_code); ?></td>
                                                    <td><?php echo e($color->color_name); ?></td>
                                                    <td>
                                                        <span class="badge" style="background-color: <?php echo e($color->color_hex); ?>;">
                                                            <?php echo e($color->color_hex); ?>

                                                        </span>
                                                    </td>
                                                    <td><?php echo e($color->order); ?></td>
                                                    <td><?php echo e($color->note); ?></td>
                                                    <td><?php echo e($color->display ? __('Yes') : __('No')); ?></td>
                                                    <td>
                                                        <!-- Actions (Edit, Delete) -->
                                                        <div class="action-btn bg-info ms-2">
                                                            <a href="#" class=""  data-url="<?php echo e(route('inventory.colors.edit', $color->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Color')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                        </div>
                                                        <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.colors.destroy', $color->id], 'class' => 'modalForm','id'=>'delete-form-'.$color->id]); ?>

                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                            <?php echo Form::close(); ?>

                                                        </div>

                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr>
                                                    <td colspan="7" class="text-center"><?php echo e(__('No colors found.')); ?></td>
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

        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/colors.blade.php ENDPATH**/ ?>