<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Inventory Setup')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Product Categories')); ?></li>
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
            <div class="tabs-container">
                <ul class="nav nav-tabs" id="categoryTabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="main-categories-tab" data-bs-toggle="tab" href="#main-categories" role="tab" aria-controls="main-categories" aria-selected="true">Main Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="sub-categories-tab" data-bs-toggle="tab" href="#sub-categories" role="tab" aria-controls="sub-categories" aria-selected="false">Sub Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="child-categories-tab" data-bs-toggle="tab" href="#child-categories" role="tab" aria-controls="child-categories" aria-selected="false">Child Categories</a>
                    </li>
                </ul>
                <div class="tab-content" id="categoryTabsContent">
                    <div class="tab-pane fade show active" id="main-categories" role="tabpanel" aria-labelledby="main-categories-tab">

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>
                                    Main List
                                </h5>
                                <div class="float-end">
                                    <a href="#" data-url="<?php echo e(route('inventory.product-categories.main.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Main Category')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                                    <th><?php echo e(__('Main Category Code')); ?></th>
                                                    <th><?php echo e(__('Main Category Name')); ?></th>
                                                    <th><?php echo e(__('Order')); ?></th>
                                                    <th><?php echo e(__('Display')); ?></th>
                                                    <th><?php echo e(__('Note')); ?></th>
                                                    <th><?php echo e(__('Actions')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $mainCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $mainCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <td><?php echo e($mainCategory->code); ?></td>
                                                        <td><?php echo e($mainCategory->name); ?></td>
                                                        <td><?php echo e($mainCategory->order); ?></td>
                                                        <td>
                                                            <span class="badge bg-<?php echo e($mainCategory->display ? 'success' : 'danger'); ?>">
                                                                <?php echo e($mainCategory->display ? __('Enabled') : __('Disabled')); ?>

                                                            </span>
                                                        </td>
                                                        <td><?php echo e($mainCategory->note); ?></td>
                                                        <td>
                                                            <!-- Edit Button -->
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#" class=""  data-url="<?php echo e(route('inventory.product-categories.main.edit', $mainCategory->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Main Category')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                            </div>

                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.product-categories.main.destroy',$mainCategory->id], 'class' => 'modalForm','id'=>'delete-form-'.$mainCategory->id]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center"><?php echo e(__('No Main Categorys found.')); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="sub-categories" role="tabpanel" aria-labelledby="sub-categories-tab">

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>
                                    Sub List
                                </h5>
                                <div class="float-end">
                                    <a href="#" data-url="<?php echo e(route('inventory.product-categories.sub.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Sub Category')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                                    <th><?php echo e(__('Sub Category Code')); ?></th>
                                                    <th><?php echo e(__('Sub Category Name')); ?></th>
                                                    <th><?php echo e(__('Main Category Name')); ?></th>
                                                    <th><?php echo e(__('Order')); ?></th>
                                                    <th><?php echo e(__('Display')); ?></th>
                                                    <th><?php echo e(__('Note')); ?></th>
                                                    <th><?php echo e(__('Actions')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $subCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <td><?php echo e($subCategory->code); ?></td>
                                                        <td><?php echo e($subCategory->name); ?></td>
                                                        <td><?php echo e($subCategory->mainCategory->name ?? 'N/A'); ?></td>
                                                        <td><?php echo e($subCategory->order); ?></td>
                                                        <td>
                                                            <span class="badge bg-<?php echo e($subCategory->display ? 'success' : 'danger'); ?>">
                                                                <?php echo e($subCategory->display ? __('Enabled') : __('Disabled')); ?>

                                                            </span>
                                                        </td>
                                                        <td><?php echo e($subCategory->note); ?></td>
                                                        <td>
                                                            <!-- Edit Button -->
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#" class=""  data-url="<?php echo e(route('inventory.product-categories.sub.edit', $subCategory->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Sub Category')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                            </div>

                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.product-categories.sub.destroy',$subCategory->id], 'class' => 'modalForm','id'=>'delete-form-'.$subCategory->id]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center"><?php echo e(__('No Sub Categorys found.')); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="child-categories" role="tabpanel" aria-labelledby="child-categories-tab">

                        <div class="card mb-3">
                            <div class="card-header">
                                <h5>
                                    Child List
                                </h5>
                                <div class="float-end">
                                    <a href="#" data-url="<?php echo e(route('inventory.product-categories.child.create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Child Category')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"  class="btn btn-sm btn-primary">
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
                                                    <th><?php echo e(__('Child Category Code')); ?></th>
                                                    <th><?php echo e(__('Child Category Name')); ?></th>
                                                    <th><?php echo e(__('Main Category Name')); ?></th>
                                                    <th><?php echo e(__('Sub Category Name')); ?></th>
                                                    <th><?php echo e(__('Order')); ?></th>
                                                    <th><?php echo e(__('Display')); ?></th>
                                                    <th><?php echo e(__('Note')); ?></th>
                                                    <th><?php echo e(__('Actions')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__empty_1 = true; $__currentLoopData = $childCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $childCategory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                    <tr>
                                                        <td><?php echo e($key + 1); ?></td>
                                                        <td><?php echo e($childCategory->code); ?></td>
                                                        <td><?php echo e($childCategory->name); ?></td>
                                                        <td><?php echo e($childCategory->mainCategory->name ?? 'N/A'); ?></td>
                                                        <td><?php echo e($childCategory->subCategory->name ?? 'N/A'); ?></td>
                                                        <td><?php echo e($childCategory->order); ?></td>
                                                        <td>
                                                            <span class="badge bg-<?php echo e($childCategory->display ? 'success' : 'danger'); ?>">
                                                                <?php echo e($childCategory->display ? __('Enabled') : __('Disabled')); ?>

                                                            </span>
                                                        </td>
                                                        <td><?php echo e($childCategory->note); ?></td>
                                                        <td>
                                                            <!-- Edit Button -->
                                                            <div class="action-btn bg-info ms-2">
                                                                <a href="#" class=""  data-url="<?php echo e(route('inventory.product-categories.child.edit', $childCategory->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Child Category')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                            </div>

                                                            <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['inventory.product-categories.child.destroy',$childCategory->id], 'class' => 'modalForm','id'=>'delete-form-'.$childCategory->id]); ?>

                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                    <tr>
                                                        <td colspan="7" class="text-center"><?php echo e(__('No Child Categorys found.')); ?></td>
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
    </div>
<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/inventorySetup/product-categories.blade.php ENDPATH**/ ?>