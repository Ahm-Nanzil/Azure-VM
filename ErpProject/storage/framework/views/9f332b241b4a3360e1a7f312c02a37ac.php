<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Loss & adjustment')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Loss & adjustment')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">


        <a href="<?php echo e(route('inventory.loss-adjustment.create')); ?>" data-size="lg"   title="<?php echo e(__('Loss and adjustment')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus text-white"></i>

        </a>
        

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
                                        <th><?php echo e(__('Type')); ?></th>
                                        <th><?php echo e(__('Time (Lost or Adjusted)')); ?></th>
                                        <th><?php echo e(__('Date Created')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Reason')); ?></th>
                                        <th><?php echo e(__('Creator')); ?></th>
                                        <th><?php echo e(__('Options')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $lossAdjustments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $adjustment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="font-style">
                                            <td><?php echo e($adjustment->type); ?></td>
                                            <td><?php echo e($adjustment->time); ?></td>
                                            <td><?php echo e($adjustment->created_at->format('Y-m-d')); ?></td>
                                            <td><?php echo e($adjustment->status ? __('Active') : __('Inactive')); ?></td>
                                            <td><?php echo e($adjustment->reason); ?></td>
                                            <td><?php echo e($adjustment->createdBy->name ?? __('Unknown')); ?></td> <!-- Assuming a relationship with User -->
                                            <td class="Action">
                                                <div class="btn-group card-option">
                                                    <button type="button" class="btn" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>
                                                            <a href="" class="dropdown-item">
                                                                <i class="ti ti-eye"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit customer')): ?>
                                                            <a href="#" data-url="" data-ajax-popup="true" class="dropdown-item">
                                                                <i class="ti ti-pencil"></i>
                                                                <span><?php echo e(__('Edit')); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete customer')): ?>
                                                            <?php echo Form::open(['method' => 'DELETE', 'id' => 'delete-form-']); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-trash"></i>
                                                                <span><?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div class="action-btn bg-warning ms-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Warehouse Details')); ?>" data-title="<?php echo e(__('Warehouse Details')); ?>">
                                                        <i class="ti ti-eye text-white"></i>
                                                    </a>
                                                </div>
                                                <div class="action-btn bg-info ms-2">
                                                    <a href="<?php echo e(route('inventory.loss-adjustment.edit', $adjustment->id)); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.loss-adjustment.destroy', $adjustment->id], 'id' => 'delete-form-' . $adjustment->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>">
                                                        <i class="ti ti-trash text-white"></i>
                                                    </a>
                                                    <?php echo Form::close(); ?>

                                                </div>
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
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/loss_adjustment/index.blade.php ENDPATH**/ ?>