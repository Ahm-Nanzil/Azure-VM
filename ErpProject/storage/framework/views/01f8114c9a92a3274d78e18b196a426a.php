<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Inventory Cust & Supp Returns')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Inventory Cust & Supp Returns')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">


        <a href="<?php echo e(route('inventory.cust-supp.create')); ?>" data-size="lg"   title="<?php echo e(__('add')); ?>" class="btn btn-sm btn-primary">
            Receipt return order
        </a>
        <a href="<?php echo e(route('inventory.de-return.create')); ?>" data-size="lg"   title="<?php echo e(__('add')); ?>" class="btn btn-sm btn-primary">
            Delivery return purchasing goods

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
                                        <th><?php echo e(__('Order Return Number')); ?></th>
                                        <th><?php echo e(__('Customer Name')); ?></th>
                                        <th><?php echo e(__('Total Amount')); ?></th>
                                        <th><?php echo e(__('Discount Total')); ?></th>
                                        <th><?php echo e(__('Date Created')); ?></th>
                                        <th><?php echo e(__('Type')); ?></th>
                                        <th><?php echo e(__('Status')); ?></th>
                                        <th><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $custSuppLists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr class="font-style">
                                            <td><?php echo e($list->order_return_number); ?></td>
                                            <td><?php echo e($list->customer_id); ?></td> <!-- Assuming customer relationship exists -->
                                            <td><?php echo e(\Auth::user()->priceFormat($list->total_payment)); ?></td>
                                            <td><?php echo e(\Auth::user()->priceFormat($list->total_discount)); ?></td>
                                            <td><?php echo e(\Carbon\Carbon::parse($list->created_at)->format('d-m-Y H:i')); ?></td>
                                            <td><?php echo e($list->related_data_id); ?></td> <!-- Assuming relatedType relationship exists -->
                                            <td><?php echo e($list->status ? __('Active') : __('Inactive')); ?></td>
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
                                                    <a href="<?php echo e(route('inventory.cust-supp.edit', $list->id)); ?>" class="text-white" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil"></i>
                                                    </a>
                                                </div>

                                                <div class="action-btn bg-danger ms-2">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.cust-supp.destroy', $list->id], 'id'=>'delete-form-'.$list->id]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" onclick="document.getElementById('delete-form-<?php echo e($list->id); ?>').submit();">
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


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/cust_supp/index.blade.php ENDPATH**/ ?>