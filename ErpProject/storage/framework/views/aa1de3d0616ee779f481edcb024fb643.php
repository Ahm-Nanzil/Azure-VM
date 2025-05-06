<?php
 //   $profile=asset(Storage::url('uploads/avatar/'));
$profile=\App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>" id="main-style-link">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>
    <script>
        !function (a) {
            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                a('[data-plugin="dragula"]').each(function () {
                    var t = a(this).data("containers"), n = [];
                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {

                        var order = [];
                        $("#" + target.id + " > div").each(function () {
                            order[$(this).index()] = $(this).attr('data-id');
                        });

                        var id = $(el).attr('data-id');

                        var old_status = $("#" + source.id).data('status');
                        var new_status = $("#" + target.id).data('status');
                        var stage_id = $(target).attr('data-id');
                        var pipeline_id = '<?php echo e($pipeline->id); ?>';

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);
                         // Log data before the AJAX call
    console.log({
        customer_id: id,
        stage_id: stage_id,
        order: order,
        new_status: new_status,
        old_status: old_status,
        pipeline_id: pipeline_id,
        _token: $('meta[name="csrf-token"]').attr('content')
    });
                        $.ajax({
                            url: '<?php echo e(route('customer_stages.order')); ?>',
                            type: 'POST',
                            data: {customer_id: id, stage_id: stage_id, order: order, new_status: new_status, old_status: old_status, pipeline_id: pipeline_id, "_token": $('meta[name="csrf-token"]').attr('content')},
                            success: function (data) {
                            },
                            error: function (data) {
                                data = data.responseJSON;
                                show_toastr('error', data.error, 'error')
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";

            a.Dragula.init()

        }(window.jQuery);


    </script>
    <script>
        $(document).on("change", "#default_pipeline_id", function () {
            $('#change-pipeline').submit();
        });
    </script>
        <script>
            $(document).on('click', '#billing_data', function () {
                $("[name='shipping_name']").val($("[name='billing_name']").val());
                $("[name='shipping_country']").val($("[name='billing_country']").val());
                $("[name='shipping_state']").val($("[name='billing_state']").val());
                $("[name='shipping_city']").val($("[name='billing_city']").val());
                $("[name='shipping_phone']").val($("[name='billing_phone']").val());
                $("[name='shipping_zip']").val($("[name='billing_zip']").val());
                $("[name='shipping_address']").val($("[name='billing_address']").val());
            })

        </script>
        <script>
            $(document).on('submit', '.modalForm', function (e) {
                e.preventDefault();

                var form = $(this);
                var url = form.attr('action');

                // Save the current URL dynamically
                var showLeadUrl = window.location.href;

                $.ajax({
                    url: url,
                    type: 'POST',
                    data: form.serialize(),
                    success: function (response) {
                        // Close the modal
                        $('#commonModal').modal('hide');
                        show_toastr('success', 'Successfully Done');

                        // Refresh the page or redirect explicitly to showLeadUrl
                        window.location.href = showLeadUrl;
                    },
                    error: function (xhr) {
                        $('#website-feedback').text('Duplicate Identified, Please give something else').show();
                        show_toastr('error', 'Duplicate Website Identified, Please give something else');
                    }
                });
            });
        </script>

<?php $__env->stopPush(); ?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Customers')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Customer')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php echo e(Form::open(array('route' => 'customer.change.pipeline','id'=>'change-pipeline','class'=>'btn btn-sm'))); ?>

        <?php echo e(Form::select('default_pipeline_id', $pipelines,$pipeline->id, array('class' => 'form-control select me-4','id'=>'default_pipeline_id'))); ?>

        <?php echo e(Form::close()); ?>

        <a href="<?php echo e(route('customer.list')); ?>" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('List View')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-list"></i>
        </a>
        <a href="#" data-size="md"  data-bs-toggle="tooltip" title="<?php echo e(__('Import')); ?>" data-url="<?php echo e(route('customer.file.import')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Import customer CSV file')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-import"></i>
        </a>
        <a href="<?php echo e(route('customer.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" data-size="lg" data-url="<?php echo e(route('customer.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create Customer')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div class="row">
    <div class="col-sm-12">
        <?php
            $stages = $pipeline->customerStages;

                 $json = [];
                 foreach ($stages as $stage){
                     $json[] = 'task-list-'.$stage->id;
                 }
        ?>
        <div class="row kanban-wrapper horizontal-scroll-cards" data-containers='<?php echo json_encode($json); ?>' data-plugin="dragula">
            <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <?php ($customers = $stage->customers()); ?>
                
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="float-end">
                                <span class="btn btn-sm btn-primary btn-icon count">
                                    <?php echo e(count($customers)); ?>

                                </span>
                            </div>
                            <h4 class="mb-0"><?php echo e($stage->name); ?></h4>
                        </div>
                        <div class="card-body kanban-box" id="task-list-<?php echo e($stage->id); ?>" data-id="<?php echo e($stage->id); ?>">
                            <?php $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="card" data-id="<?php echo e($customer->id); ?>">
                                    <div class="card-header border-0 pb-0">
                                        <h5>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>

                                            <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>">
                                                <?php echo e($customer->name); ?>

                                            </a></h5>
                                            <?php endif; ?>

                                        <div class="card-header-right">
                                            <div class="btn-group card-option">
                                                <button type="button" class="btn dropdown-toggle"
                                                        data-bs-toggle="dropdown" aria-haspopup="true"
                                                        aria-expanded="false">
                                                    <i class="ti ti-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end">
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show customer')): ?>
                                                        <a href="<?php echo e(route('customer.show',\Crypt::encrypt($customer['id']))); ?>" class="dropdown-item">
                                                            <i class="ti ti-eye"></i>
                                                            <span><?php echo e(__('View')); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit customer')): ?>
                                                        <a href="#" data-url="<?php echo e(route('customer.edit', $customer->id)); ?>" data-ajax-popup="true" class="dropdown-item">
                                                            <i class="ti ti-pencil"></i>
                                                            <span><?php echo e(__('Edit')); ?></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete customer')): ?>
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['customer.destroy', $customer->id], 'id' => 'delete-form-' . $customer->id]); ?>

                                                        <a href="#" class="dropdown-item bs-pass-para">
                                                            <i class="ti ti-trash"></i>
                                                            <span><?php echo e(__('Delete')); ?></span>
                                                        </a>
                                                        <?php echo Form::close(); ?>

                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <p><strong><?php echo e(__('Contact:')); ?></strong> <?php echo e($customer->contact); ?></p>
                                        <p><strong><?php echo e(__('Email:')); ?></strong> <?php echo e($customer->email); ?></p>
                                        <p><strong><?php echo e(__('Balance:')); ?></strong> <?php echo e(\Auth::user()->priceFormat($customer->balance)); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/customer/index.blade.php ENDPATH**/ ?>