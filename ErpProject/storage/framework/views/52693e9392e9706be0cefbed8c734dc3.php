<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Purchase Request')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Purchase Request')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        

        <a href="<?php echo e(route('purchase_request.create')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
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
                                <th class="text-center"><?php echo e(__('Purchase Request Code')); ?></th>
                                <th class="text-center"><?php echo e(__('Purchase Request Name')); ?></th>
                                <th class="text-center"><?php echo e(__('Requester')); ?></th>
                                <th class="text-center"><?php echo e(__('Department')); ?></th>
                                <th class="text-center"><?php echo e(__('Request Time')); ?></th>
                                <th class="text-center"><?php echo e(__('Status')); ?></th>
                                <th class="text-center"><?php echo e(__('Actions')); ?></th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php $__currentLoopData = $purchaseRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($request->purchase_request_code); ?></td>
                                <td class="text-center"><?php echo e($request->purchase_request_name); ?></td>
                                <td class="text-center"><?php echo e($request->requester_id ?? 'N/A'); ?></td> <!-- assuming requester relationship is set -->
                                <td class="text-center"><?php echo e($request->department_id ?? 'N/A'); ?></td> <!-- assuming department relationship is set -->
                                <td class="text-center"><?php echo e($request->created_at->format('Y-m-d H:i')); ?></td>
                                <td class="text-center"><?php echo e(ucfirst($request->status)); ?></td>
                                <td class="text-center">
                                    
                                    <!-- You can add delete button or any other actions as needed -->

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
                                        <a href="#" class="mx-3 btn btn-sm align-items-center" data-url="" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__(' Details')); ?>" data-title="<?php echo e(__(' Details')); ?>">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                    </div>
                                        <div class="action-btn bg-info ms-2">
                                            <a href="<?php echo e(route('purchase_request.edit', $request->id)); ?>" class="mx-3 btn btn-sm align-items-center"> <i class="ti ti-pencil text-white"></i></a>
                                        </div>

                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['purchase_request.destroy', $request->id], 'id'=>'delete-form-'.$request->id]); ?>

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


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\Modules/Purchases\Resources/views/purchase_request/index.blade.php ENDPATH**/ ?>