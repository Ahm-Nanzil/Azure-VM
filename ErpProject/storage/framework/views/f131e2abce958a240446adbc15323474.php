<?php $__env->startSection('page-title'); ?>
    <?php echo e($deal->name); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dropzone.min.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/dropzone-amd-module.min.js')); ?>"></script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#deal-sidenav',
            offset: 300
        })
        Dropzone.autoDiscover = false;
        Dropzone.autoDiscover = false;
        myDropzone = new Dropzone("#dropzonewidget", {
            maxFiles: 20,
            // maxFilesize: 20,
            parallelUploads: 1,
            filename: false,
            // acceptedFiles: ".jpeg,.jpg,.png,.pdf,.doc,.txt",
            url: "<?php echo e(route('deals.file.upload',$deal->id)); ?>",
            success: function (file, response) {
                if (response.is_success) {
                    if(response.status==1){
                        show_toastr('success', response.success_msg, 'success');
                    }
                    dropzoneBtn(file, response);
                } else {
                    myDropzone.removeFile(file);
                    show_toastr('error', response.error, 'error');
                }
            },
            error: function (file, response) {
                myDropzone.removeFile(file);
                if (response.error) {
                    show_toastr('error', response.error, 'error');
                } else {
                    show_toastr('error', response.error, 'error');
                }
            }
        });
        myDropzone.on("sending", function (file, xhr, formData) {
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            formData.append("deal_id", <?php echo e($deal->id); ?>);
        });

        function dropzoneBtn(file, response) {
            var download = document.createElement('a');
            download.setAttribute('href', response.download);
            download.setAttribute('class', "badge bg-info mx-1");
            download.setAttribute('data-toggle', "tooltip");
            download.setAttribute('data-original-title', "<?php echo e(__('Download')); ?>");
            download.innerHTML = "<i class='ti ti-download'></i>";

            var del = document.createElement('a');
            del.setAttribute('href', response.delete);
            del.setAttribute('class', "badge bg-danger mx-1");
            del.setAttribute('data-toggle', "tooltip");
            del.setAttribute('data-original-title', "<?php echo e(__('Delete')); ?>");
            del.innerHTML = "<i class='ti ti-trash'></i>";

            del.addEventListener("click", function (e) {
                e.preventDefault();
                e.stopPropagation();
                if (confirm("Are you sure ?")) {
                    var btn = $(this);
                    $.ajax({
                        url: btn.attr('href'),
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        type: 'DELETE',
                        success: function (response) {
                            if (response.is_success) {
                                btn.closest('.dz-image-preview').remove();
                            } else {
                                show_toastr('error', response.error, 'error');
                            }
                        },
                        error: function (response) {
                            response = response.responseJSON;
                            if (response.is_success) {
                                show_toastr('error', response.error, 'error');
                            } else {
                                show_toastr('error', response, 'error');
                            }
                        }
                    })
                }
            });

            var html = document.createElement('div');
            html.appendChild(download);
            <?php if(Auth::user()->type != 'client'): ?>
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
            html.appendChild(del);
            <?php endif; ?>
            <?php endif; ?>

            file.previewTemplate.appendChild(html);
        }

        <?php $__currentLoopData = $deal->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(file_exists(storage_path('deal_files/'.$file->file_path))): ?>
        // Create the mock file:
        var mockFile = {name: "<?php echo e($file->file_name); ?>", size: <?php echo e(\File::size(storage_path('deal_files/'.$file->file_path))); ?>};
        // Call the default addedfile event handler
        myDropzone.emit("addedfile", mockFile);
        // And optionally show the thumbnail of the file:
        myDropzone.emit("thumbnail", mockFile, "<?php echo e(asset(Storage::url('deal_files/'.$file->file_path))); ?>");
        myDropzone.emit("complete", mockFile);

        dropzoneBtn(mockFile, {download: "<?php echo e(route('deals.file.download',[$deal->id,$file->id])); ?>", delete: "<?php echo e(route('deals.file.delete',[$deal->id,$file->id])); ?>"});
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
        $('.summernote-simple').on('summernote.blur', function () {

            $.ajax({
                url: "<?php echo e(route('deals.note.store',$deal->id)); ?>",
                data: {_token: $('meta[name="csrf-token"]').attr('content'), notes: $(this).val()},
                type: 'POST',
                success: function (response) {
                    if (response.is_success) {
                        // show_toastr('Success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response, 'error');
                    }
                }
            })
        });
        <?php else: ?>
        $('.summernote-simple').summernote('disable');
        <?php endif; ?>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit task')): ?>
        $(document).on("click", ".task-checkbox", function () {
            var chbox = $(this);
            var lbl = chbox.parent().parent().find('label');

            $.ajax({
                url: chbox.attr('data-url'),
                data: {_token: $('meta[name="csrf-token"]').attr('content'), status: chbox.val()},
                type: 'PUT',
                success: function (response) {
                    if (response.is_success) {
                        chbox.val(response.status);
                        if (response.status) {
                            lbl.addClass('strike');
                            lbl.find('.badge').removeClass('badge-warning').addClass('badge-success');
                        } else {
                            lbl.removeClass('strike');
                            lbl.find('.badge').removeClass('badge-success').addClass('badge-warning');
                        }
                        lbl.find('.badge').html(response.status_label);

                        show_toastr('success', response.success);
                    } else {
                        show_toastr('error', response.error);
                    }
                },
                error: function (response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('success', response.success);
                    } else {
                        show_toastr('error', response.error);
                    }
                }
            })
        });
        <?php endif; ?>
    </script>
    <script>
        $(document).on('submit', '.modalForm', function (e) {
        e.preventDefault();

        var form = $(this);
        var url = form.attr('action');
        var showLeadUrl = "<?php echo e(route('deals.show', $deal->id)); ?>";

        $.ajax({
            url: url,
            type: 'POST',
            data: form.serialize(),
            success: function (response) {
                // Close the modal
                $('#commonModal').modal('hide');
                show_toastr('success', 'Successfully Done');

                // Fetch and update the full lead details on show.blade.php
                $.ajax({
                    url: showLeadUrl,  // This uses the dynamically set URL from Laravel
                    type: 'GET',
                    success: function (response) {
                        $('#main-content').html(response); // response now contains just the inner HTML, no nested div
                        reinitializeDropzone();


                    },
                    error: function (xhr) {
                        console.error(xhr.responseText);
                        alert("There was an error loading the lead details.");
                    }
                });
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                show_toastr('errror', 'There was an error!');
            }
        });
    });

    function reinitializeDropzone() {
    // Reinitialize Dropzone after content is loaded
    Dropzone.autoDiscover = false; // Disable auto discovery
    myDropzone = new Dropzone("#dropzonewidget", {
        maxFiles: 20,
        parallelUploads: 1,
        filename: false,
        url: "<?php echo e(route('deals.file.upload', $deal->id)); ?>",
        success: function (file, response) {
            if (response.is_success) {
                if(response.status == 1){
                    show_toastr('success', response.success_msg, 'success');
                }
                dropzoneBtn(file, response);
            } else {
                myDropzone.removeFile(file);
                show_toastr('error', response.error, 'error');
            }
        },
        error: function (file, response) {
            myDropzone.removeFile(file);
            if (response.error) {
                show_toastr('error', response.error, 'error');
            } else {
                show_toastr('error', response.error, 'error');
            }
        }
    });

    myDropzone.on("sending", function (file, xhr, formData) {
        formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
        formData.append("deal_id", <?php echo e($deal->id); ?>);
    });

    // Re-create the files from the backend if any
    <?php $__currentLoopData = $deal->files; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if(file_exists(storage_path('deal_files/'.$file->file_path))): ?>
    // Create the mock file:
    var mockFile = {name: "<?php echo e($file->file_name); ?>", size: <?php echo e(\File::size(storage_path('deal_files/'.$file->file_path))); ?>};
    // Call the default addedfile event handler
    myDropzone.emit("addedfile", mockFile);
    // And optionally show the thumbnail of the file:
    myDropzone.emit("thumbnail", mockFile, "<?php echo e(asset(Storage::url('deal_files/'.$file->file_path))); ?>");
    myDropzone.emit("complete", mockFile);

    dropzoneBtn(mockFile, {download: "<?php echo e(route('deals.file.download',[$deal->id,$file->id])); ?>", delete: "<?php echo e(route('deals.file.delete',[$deal->id,$file->id])); ?>"});
    <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
}

    </script>
    
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    

    <div class="d-flex align-items-center mt-2">
        <a href="<?php echo e(route('deals.index')); ?>" class="text-black me-3">
            <i class="fas fa-arrow-left"></i> <!-- Font Awesome Left Arrow Icon -->
        </a>

        <?php if($deal->company_entity_logo): ?>
        <img src="<?php echo e(asset('storage/app/public/' . $deal->company_entity_logo)); ?>" alt="Company Logo" style="width: 32px; height: 32px; object-fit: cover; border-radius: 4px;">
        <?php else: ?>
            <i class="fas fa-building fa-2x me-2"></i>
        <?php endif; ?>

        <div>
            <h3 class="d-inline"><?php echo e($deal->company_entity_name); ?></h3>
            <p class="d-inline ms-2">
                <a href="<?php echo e($deal->company_website); ?>" target="_blank"><?php echo e($deal->company_website); ?></a>
            </p>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('convert deal to deal')): ?>
            <?php if(!empty($deal)): ?>
                <a href="<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('View Deal')): ?> <?php if($deal->is_active): ?> <?php echo e(route('deals.show',$deal->id)); ?> <?php else: ?> # <?php endif; ?> <?php else: ?> # <?php endif; ?>" data-size="lg" data-bs-toggle="tooltip" title=" <?php echo e(__('Already Converted To Deal')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-exchange"></i>
                </a>
            <?php else: ?>
                <a href="#" data-size="lg" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/show_convert')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Convert ['.$deal->subject.'] To Deal')); ?>" class="btn btn-sm btn-primary">
                    <i class="ti ti-exchange"></i>
                </a>
            <?php endif; ?>
        <?php endif; ?>
        <a href="#" data-url="<?php echo e(URL::to('deals/'.$deal->id.'/labels')); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Label')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-bookmark"></i>
        </a>
        <a href="#" data-size="lg" data-url="<?php echo e(route('deals.edit',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-pencil"></i>
        </a>
        <?php if($previousDeal): ?>
        <a href="<?php echo e(route('deals.show', $previousDeal->id)); ?>" class="btn btn-sm btn-primary" title="<?php echo e(__('Previous Lead')); ?>">
            <i class="fas fa-arrow-left"></i>
        </a>
    <?php endif; ?>

    <?php if($nextDeal): ?>
        <a href="<?php echo e(route('deals.show', $nextDeal->id)); ?>" class="btn btn-sm btn-primary" title="<?php echo e(__('Next Lead')); ?>">
            <i class="fas fa-arrow-right"></i>
        </a>
    <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div id="main-content">

        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xl-3">
                        <div class="card sticky-top" style="top:30px">
                            <div class="list-group list-group-flush" id="lead-sidenav">
                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#general" class="list-group-item list-group-item-action border-0"><?php echo e(__('General')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#basicInfoHeader" class="list-group-item list-group-item-action border-0"><?php echo e(__('Basic Info')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#sources" class="list-group-item list-group-item-action border-0"><?php echo e(__('Sources')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>
                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#primaryContactInfo" class="list-group-item list-group-item-action border-0"><?php echo e(__('Primary Contact')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>
                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#additionalcontacts" class="list-group-item list-group-item-action border-0"><?php echo e(__('Additional Contact')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>
                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#users" class="list-group-item list-group-item-action border-0"><?php echo e(__('Users')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#emails" class="list-group-item list-group-item-action border-0"><?php echo e(__('Emails')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>
                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#openActivities" class="list-group-item list-group-item-action border-0"><?php echo e(__('Open Activities')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#products" class="list-group-item list-group-item-action border-0"><?php echo e(__('Products')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#discussion_note" class="list-group-item list-group-item-action border-0"><?php echo e(__('Discussion').' | '.__('Notes')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>
                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#files" class="list-group-item list-group-item-action border-0"><?php echo e(__('Files')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                                <?php if(Auth::user()->type != 'client'): ?>
                                    <a href="#timeline" class="list-group-item list-group-item-action border-0"><?php echo e(__('Timeline')); ?>

                                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                    </a>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-xl-9">
                        <?php
                        $tasks = $deal->tasks;
                        $products = $deal->products();
                        $sources = $deal->sources();
                        $calls = $deal->calls;
                        $emails = $deal->emails;
                        ?>
                        <div id="general" class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3 col-sm-6">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-test-pipe"></i>
                                            </div>
                                            <div class="ms-2">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Pipeline')); ?></p>
                                                <h5 class="mb-0 text-success"><?php echo e($deal->pipeline->name); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6 my-3 my-sm-0">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-primary">
                                                <i class="ti ti-server"></i>
                                            </div>
                                            <div class="ms-2">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Stage')); ?></p>
                                                <h5 class="mb-0 text-primary"><?php echo e($deal->stage->name); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 my-sm-0 my-3 col-sm-6">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-warning">
                                                <i class="ti ti-calendar"></i>
                                            </div>
                                            <div class="ms-2">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Created')); ?></p>
                                                <h5 class="mb-0 text-warning"><?php echo e(\Auth::user()->dateFormat($deal->created_at)); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <div class="d-flex align-items-start">
                                            <div class="theme-avtar bg-info">
                                                <i class="ti ti-report-money"></i>
                                            </div>
                                            <div class="ms-2">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Price')); ?></p>
                                                <h5 class="mb-0 text-info"><?php echo e(\Auth::user()->priceFormat($deal->price)); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <small class="text-muted"><?php echo e(__('Task')); ?></small>
                                                <h3 class="m-0"><?php echo e(count($tasks)); ?></h3>
                                            </div>
                                            <div class="col-auto">
                                                <div class="theme-avtar bg-danger">
                                                    <i class="ti ti-subtask"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <small class="text-muted"><?php echo e(__('Product')); ?></small>
                                                <h3 class="m-0"><?php echo e(count($products)); ?></h3>
                                            </div>
                                            <div class="col-auto">
                                                <div class="theme-avtar bg-info">
                                                    <i class="ti ti-shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <small class="text-muted"><?php echo e(__('Source')); ?></small>
                                                <h3 class="m-0"><?php echo e(count($sources)); ?></h3>
                                            </div>
                                            <div class="col-auto">
                                                <div class="theme-avtar bg-primary">
                                                    <i class="ti ti-social"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row align-items-center justify-content-between">
                                            <div class="col-auto mb-3 mb-sm-0">
                                                <small class="text-muted"><?php echo e(__('Files')); ?></small>
                                                <h3 class="m-0"><?php echo e(count($deal->files)); ?></h3>
                                            </div>
                                            <div class="col-auto">
                                                <div class="theme-avtar bg-warning">
                                                    <i class="ti ti-file"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card">
                            <div class="card-header" id="basicInfoHeader">
                                <h5 class="mb-0 d-flex justify-content-between align-items-center">
                                    <?php echo e(__('Deal Basic Info')); ?>

                                    <div class="float-end">
                                    <a data-size="md" data-url="<?php echo e(route('deals.basicinfo.edit',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit Basic Info')); ?>" data-title="<?php echo e(__('Edit Basic Info')); ?>" class="btn btn-sm btn-primary">
                                        <i class="fas fa-edit text-white"></i>
                                    </a>

                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#basicInfoContent" aria-expanded="false" aria-controls="basicInfoContent" onclick="toggleIcon(this)">
                                        <i class="fas fa-chevron-right"></i> <!-- Starts with the right arrow -->
                                    </button>
                                    <script>
                                        function toggleIcon(button) {
                                            const icon = button.querySelector('i');
                                            icon.classList.toggle('fa-chevron-down');
                                            icon.classList.toggle('fa-chevron-right');
                                        }
                                    </script>
                                    </div>

                                </h5>
                            </div>
                            <div id="basicInfoContent" class="collapse" aria-labelledby="basicInfoHeader">
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Lead Owner -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Lead Owner')); ?></p>
                                            <h5><?php echo e($deal->lead_owner ?? ''); ?></h5>
                                        </div>

                                        <!-- Company Website -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company Website')); ?></p>
                                            <h5><a href="<?php echo e($deal->company_website); ?>" target="_blank"><?php echo e($deal->company_website ?? ''); ?></a></h5>
                                        </div>

                                        <!-- Company/Entity Name -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company / Entity Name')); ?></p>
                                            <h5><?php echo e($deal->company_entity_name ?? ''); ?></h5>
                                        </div>

                                        <!-- Company/Entity Logo -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company / Entity Logo')); ?></p>
                                            <img src="<?php echo e(asset('storage/' . $deal->company_entity_logo)); ?>" alt="Company Logo" style="max-width: 100px;">
                                        </div>

                                        <!-- Company Phone LL1 -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company Phone LL1')); ?></p>
                                            <h5><?php echo e($deal->company_phone_ll1 ?? ''); ?></h5>
                                        </div>

                                        <!-- Company Phone LL2 -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company Phone LL2')); ?></p>
                                            <h5><?php echo e($deal->company_phone_ll2 ?? ''); ?></h5>
                                        </div>

                                        <!-- Company Email -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company Email')); ?></p>
                                            <h5><?php echo e($deal->company_email ?? ''); ?></h5>
                                        </div>

                                        <!-- Address1 -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Address1')); ?></p>
                                            <h5><?php echo e($deal->address1 ?? ''); ?></h5>
                                        </div>

                                        <!-- Address2 -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Address2')); ?></p>
                                            <h5><?php echo e($deal->address2 ?? ''); ?></h5>
                                        </div>

                                        <!-- City -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('City')); ?></p>
                                            <h5><?php echo e($deal->city ?? ''); ?></h5>
                                        </div>

                                        <!-- Region/State -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Region/State')); ?></p>
                                            <h5><?php echo e($deal->region ?? ''); ?></h5>
                                        </div>

                                        <!-- Country -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Country')); ?></p>
                                            <h5><?php echo e($deal->country ?? ''); ?></h5>
                                        </div>

                                        <!-- Zip Code -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Zip Code')); ?></p>
                                            <h5><?php echo e($deal->zip_code ?? ''); ?></h5>
                                        </div>

                                        <!-- Company LinkedIn -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company LinkedIn')); ?></p>
                                            <h5><a href="<?php echo e($deal->company_linkedin); ?>" target="_blank"><?php echo e($deal->company_linkedin ?? ''); ?></a></h5>
                                        </div>

                                        <!-- Company Location -->
                                        <div class="col-md-6 mt-3">
                                            <p class="text-muted mb-0"><?php echo e(__('Company Location')); ?></p>
                                            <h5><a href="<?php echo e($deal->company_location); ?>" target="_blank"><?php echo e($deal->company_location ?? ''); ?></a></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="sources">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5><?php echo e(__('Sources')); ?></h5>
                                                <div class="float-end">
                                                    <a data-size="md" data-url="<?php echo e(route('deals.sources.edit',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Source')); ?>" data-title="<?php echo e(__('Add Source')); ?>" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#leadSources" aria-expanded="false" aria-controls="leadSources" onclick="toggleleadSourcesIcon(this)">
                                                        <i class="fas fa-chevron-right"></i> <!-- Starts with the right arrow -->
                                                    </button>
                                                    <script>
                                                        function toggleleadSourcesIcon(button) {
                                                            const icon = button.querySelector('i');
                                                            icon.classList.toggle('fa-chevron-down');
                                                            icon.classList.toggle('fa-chevron-right');
                                                        }
                                                    </script>
                                                </div>
                                            </div>

                                        </div>
                                        <div id="leadSources" class="collapse" aria-labelledby="">

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo e(__('Name')); ?></th>
                                                            <th><?php echo e(__('Action')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $sources; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td><?php echo e($source->name); ?> </td>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                                    <td>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.sources.destroy', $deal->id,$source->id], 'class' => 'modalForm','id'=>'delete-form-'.$deal->id]); ?>

                                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
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
                        </div>

                        <div id="primaryContactInfo" class="card mt-4">
                            <div class="card-header">
                                <h5 class="card-title d-inline"><?php echo e(__('Primary Contact Info')); ?></h5>
                                <div class="float-end">
                                <a data-size="md" data-url="<?php echo e(route('deals.primarycontact.edit',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit Primary Contact Info')); ?>" data-title="<?php echo e(__('Edit Primary Contact Info')); ?>" class="btn btn-sm btn-primary">
                                    <i class="fas fa-edit text-white"></i>
                                </a>
                                <button class="btn btn-link float-end" type="button" data-bs-toggle="collapse" data-bs-target="#primaryContactContent" aria-expanded="false" aria-controls="primaryContactContent" onclick="togglePrimaryContactIcon(this)">
                                    <i class="fas fa-chevron-right"></i> <!-- Start with right arrow -->
                                </button>
                                </div>
                                <script>
                                    function togglePrimaryContactIcon(button) {
                                        const icon = button.querySelector('i');
                                        icon.classList.toggle('fa-chevron-down');
                                        icon.classList.toggle('fa-chevron-right');
                                    }
                                </script>

                            </div>

                            <div id="primaryContactContent" class="collapse">
                                <div class="card-body">
                                    <div class="row">
                                        

                                        <div class="row">
                                            <!-- Salutation -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Salutation')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->salutation) ? $deal->salutation : ''); ?></h5>
                                            </div>

                                            <!-- First Name -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('First Name')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->first_name) ? $deal->first_name : ''); ?></h5>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Last Name')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->last_name) ? $deal->last_name : ''); ?></h5>
                                            </div>

                                            <!-- Mobile Primary -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Mobile Primary')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->mobile_primary) ? $deal->mobile_primary : ''); ?></h5>
                                            </div>

                                            <!-- Mobile Secondary -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Mobile Secondary')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->mobile_secondary) ? $deal->mobile_secondary : ''); ?></h5>
                                            </div>

                                            <!-- Email Work -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Email Work')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->email_work) ? $deal->email_work : ''); ?></h5>
                                            </div>

                                            <!-- Email Personal -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Email Personal')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->email_personal) ? $deal->email_personal : ''); ?></h5>
                                            </div>

                                            <!-- Phone LL -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Phone LL')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->phone_ll) ? $deal->phone_ll : ''); ?></h5>
                                            </div>

                                            <!-- Company Phone LL -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Company Phone LL')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->company_phone_ll) ? $deal->company_phone_ll : ''); ?></h5>
                                            </div>

                                            <!-- Extension # -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('Extension #')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->extension) ? $deal->extension : ''); ?></h5>
                                            </div>

                                            <!-- LinkedIn Profile -->
                                            <div class="col-md-6 col-sm-6 mt-3">
                                                <p class="text-muted text-sm mb-0"><?php echo e(__('LinkedIn Profile')); ?></p>
                                                <h5 class="mb-0"><?php echo e(!empty($deal->linkedin_profile) ? $deal->linkedin_profile : ''); ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="additionalcontacts" class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5><?php echo e(__('Additional Contacts')); ?></h5>
                                    
                                        <div class="float-end">
                                            <a data-size="md" data-bs-target="#contactModal" data-url="<?php echo e(route('deals.additional-contact.create',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create Additional Contact')); ?>" data-title="<?php echo e(__('Edit Additional Contact ')); ?>" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>
                                            <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#additional-contact" aria-expanded="false" aria-controls="basicInfoContent" onclick="additionalcontactIcon(this)">
                                                <i class="fas fa-chevron-right"></i> <!-- Starts with the right arrow -->
                                            </button>
                                        </div>

                                        <script>
                                            function additionalcontactIcon(button) {
                                                const icon = button.querySelector('i');
                                                icon.classList.toggle('fa-chevron-down');
                                                icon.classList.toggle('fa-chevron-right');
                                            }
                                        </script>
                                    
                                </div>

                            </div>
                            <div id="additional-contact" class="collapse" aria-labelledby="">

                                <div class="card-body">
                                    <div class="row" id="additional-contacts-list">
                                        <?php $__currentLoopData = json_decode($deal->additional_contacts, true) ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-md-12 mt-4">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        <h5 class="mb-0 text-primary"><?php echo e($contact['name'] ?? ''); ?>

                                                            <button class="btn btn-link p-0 toggle-details" data-target="#contact-details-<?php echo e($index); ?>">
                                                                <i class="ti ti-plus"></i>
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div class="float-end">
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                            <div class="col-md-12 mt-2">
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.additional_contacts.destroy', $deal->id, $index], 'class' => 'modalForm', 'id' => 'delete-form-' . $index]); ?>

                                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <div id="contact-details-<?php echo e($index); ?>" class="contact-details mt-2" style="display: none;">
                                                    <div class="row">
                                                        <div class="col-md-3 mt-2">
                                                            <div class="d-flex align-items-start">
                                                                <div class="theme-avtar bg-warning">
                                                                    <i class="ti ti-mail"></i>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Email')); ?></p>
                                                                    <h5 class="mb-0 text-warning"><?php echo e($contact['email'] ?? ''); ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-2">
                                                            <div class="d-flex align-items-start">
                                                                <div class="theme-avtar bg-info">
                                                                    <i class="ti ti-briefcase"></i>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Title')); ?></p>
                                                                    <h5 class="mb-0 text-info"><?php echo e($contact['title'] ?? ''); ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-2">
                                                            <div class="d-flex align-items-start">
                                                                <div class="theme-avtar bg-primary">
                                                                    <i class="ti ti-sitemap"></i>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Department')); ?></p>
                                                                    <h5 class="mb-0 text-primary"><?php echo e($contact['department'] ?? ''); ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 mt-2">
                                                            <div class="d-flex align-items-start">
                                                                <div class="theme-avtar bg-warning">
                                                                    <i class="ti ti-phone"></i>
                                                                </div>
                                                                <div class="ms-2">
                                                                    <p class="text-muted text-sm mb-0"><?php echo e(__('Phone Mobile')); ?></p>
                                                                    <h5 class="mb-0 text-warning"><?php echo e($contact['phone_mobile'] ?? ''); ?></h5>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <script>
                            document.querySelectorAll('.toggle-details').forEach(button => {
                                button.addEventListener('click', function () {
                                    const target = document.querySelector(this.dataset.target);
                                    if (target.style.display === 'none') {
                                        target.style.display = 'block';
                                        this.innerHTML = '<i class="ti ti-minus"></i>';
                                    } else {
                                        target.style.display = 'none';
                                        this.innerHTML = '<i class="ti ti-plus"></i>';
                                    }
                                });
                            });
                        </script>



                        <div id="users">
                            <div class="row">
                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5><?php echo e(__('Users')); ?></h5>
                                                <div class="float-end">
                                                    <a  data-size="md" data-url="<?php echo e(route('deals.users.edit',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add User')); ?>" data-title="<?php echo e(__('Add User')); ?>" class="btn btn-sm btn-primary ">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#leadUser" aria-expanded="false" aria-controls="leadUser" onclick="toggleleadUserIcon(this)">
                                                        <i class="fas fa-chevron-right"></i> <!-- Starts with the right arrow -->
                                                    </button>
                                                    <script>
                                                        function toggleleadUserIcon(button) {
                                                            const icon = button.querySelector('i');
                                                            icon.classList.toggle('fa-chevron-down');
                                                            icon.classList.toggle('fa-chevron-right');
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="leadUser" class="collapse" aria-labelledby="">

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo e(__('Name')); ?></th>
                                                            <th><?php echo e(__('Action')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $deal->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td>
                                                                    <div class="d-flex align-items-center">
                                                                        <div>
                                                                            <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> class="wid-30 rounded-circle me-3" alt="avatar image">
                                                                        </div>
                                                                        <p class="mb-0"><?php echo e($user->name); ?></p>
                                                                    </div>
                                                                </td>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                                    <td>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.users.destroy', $deal->id,$user->id],'class' => 'modalForm','id'=>'delete-form-'.$deal->id]); ?>

                                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
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
                        </div>

                        <div id="emails">
                            <div class="row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5><?php echo e(__('Emails')); ?></h5>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create lead email')): ?>
                                                    <div class="float-end">
                                                        <a data-size="md" data-url="<?php echo e(route('deals.emails.create',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create Email')); ?>" data-title="<?php echo e(__('Create Email')); ?>" class="btn btn-sm btn-primary">
                                                            <i class="ti ti-plus text-white"></i>
                                                        </a>
                                                        <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#leadEmail" aria-expanded="false" aria-controls="leadEmail" onclick="toggleLeadEmailIcon(this)">
                                                            <i class="fas fa-chevron-right"></i> <!-- Starts with the right arrow -->
                                                        </button>
                                                        <script>
                                                            function toggleLeadEmailIcon(button) {
                                                                const icon = button.querySelector('i');
                                                                icon.classList.toggle('fa-chevron-down');
                                                                icon.classList.toggle('fa-chevron-right');
                                                            }
                                                        </script>
                                                    </div>
                                                <?php endif; ?>
                                            </div>

                                        </div>
                                        <div id="leadEmail" class="collapse" aria-labelledby="">

                                            <div class="card-body">
                                                <div class="list-group list-group-flush mt-2">
                                                    <?php if(!$emails->isEmpty()): ?>
                                                        <?php $__currentLoopData = $emails; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $email): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <li class="list-group-item px-0">
                                                                <div class="d-block d-sm-flex align-items-start">
                                                                    <img src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>"
                                                                        class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                                    <div class="w-100">
                                                                        <div class="d-flex align-items-center justify-content-between">
                                                                            <div class="mb-3 mb-sm-0">
                                                                                <h6 class="mb-0"><?php echo e($email->subject); ?></h6>
                                                                                <span class="text-muted text-sm"><?php echo e($email->to); ?></span>
                                                                            </div>
                                                                            <div class="form-check form-switch form-switch-right mb-2">
                                                                                <?php echo e($email->created_at->diffForHumans()); ?>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                    <?php else: ?>
                                                        <li class="text-center">
                                                            <?php echo e(__(' No Emails Available.!')); ?>

                                                        </li>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="openActivities" class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5><?php echo e(__('Open Activities')); ?></h5>

                                    <?php
                                        $tasks = $deal->tasks;

                                        // dd($tasks);
                                    ?>
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="activityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-plus text-white"></i> <?php echo e(__('Add Activity')); ?>

                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="activityDropdown">
                                                <li>

                                                    <a class="dropdown-item" data-size="md" data-url="<?php echo e(route('deals.calls.create', $deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Call')); ?>" data-title="<?php echo e(__('Add Call')); ?>" >
                                                        <?php echo e(__('Add Call')); ?>

                                                    </a>

                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-size="md" data-url="<?php echo e(route('deals.tasks.create', $deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Task')); ?>" data-title="<?php echo e(__('Add Task')); ?>" >
                                                        <?php echo e(__('Add Task')); ?>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-size="md" data-url="<?php echo e(route('deals.meeting.create', $deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Meeting')); ?>" data-title="<?php echo e(__('Add Meeting')); ?>" >
                                                        <?php echo e(__('Add Meeting')); ?>

                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" data-size="md" data-url="<?php echo e(route('deals.visit.create', $deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Visit')); ?>" data-title="<?php echo e(__('Add Visit')); ?>" >
                                                        <?php echo e(__('Add Visit')); ?>

                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>



                                </div>
                                <!-- Tab Navigation -->
                                <div>
                                    <button onclick="showTab('calls')" class="btn btn-link" id="tab-calls">Calls</button>
                                    <button onclick="showTab('tasks')" class="btn btn-link" id="tab-tasks">Tasks</button>
                                    <button onclick="showTab('meeting')" class="btn btn-link" id="tab-meeting">Meeting</button>
                                    <button onclick="showTab('files')" class="btn btn-link" id="tab-files">Visits</button>

                                </div>
                            </div>

                            <!-- Tab Content -->

                            <div class="card-body">
                                <!-- Calls Section -->
                                <div id="content-calls" class="tab-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead>
                                                <tr>
                                                    <th><?php echo e(__('Subject')); ?></th>
                                                    <th><?php echo e(__('Call Type')); ?></th>
                                                    <th><?php echo e(__('Duration')); ?></th>
                                                    <th><?php echo e(__('User')); ?></th>
                                                    <th><?php echo e(__('Action')); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php $__currentLoopData = $calls; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $call): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr>
                                                        <td><?php echo e($call->subject); ?></td>
                                                        <td><?php echo e(ucfirst($call->call_type)); ?></td>
                                                        <td><?php echo e($call->duration); ?></td>
                                                        <td><?php echo e(isset($call->getLeadCallUser) ? $call->getLeadCallUser->name : '-'); ?></td>
                                                        <td>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit lead call')): ?>
                                                                <div class="action-btn bg-info ms-2">
                                                                    <a href="#" class="mx-3 btn btn-sm d-inline-flex align-items-center" data-url="<?php echo e(URL::to('leads/' . $deal->id . '/call/' . $call->id . '/edit')); ?>" data-ajax-popup="true" data-size="xl" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Call')); ?>">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete lead call')): ?>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['leads.calls.destroy', $deal->id, $call->id], 'class' => 'modalForm', 'id' => 'delete-form-' . $deal->id]); ?>

                                                                        <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tasks Section -->
                                <div id="content-tasks" class="tab-content" style="display: none;">
                                    <?php if(!$tasks->isEmpty()): ?>
                                        <ul class="list-group list-group-flush mt-2">
                                            <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $task): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                            // dd($task->id);
                                            ?>
                                                <li class="list-group-item px-0">
                                                    <div class="d-block d-sm-flex align-items-start">
                                                        
                                                        <div class="w-100">
                                                            <div class="d-flex align-items-center justify-content-between">
                                                                <div class="mb-3 mb-sm-0">
                                                                    <h5 class="mb-0">
                                                                        <?php echo e($task->name); ?>

                                                                        <?php if($task->status): ?>
                                                                            <div class="badge bg-primary mb-1"><?php echo e(__(\App\Models\DealTask::$status[$task->status])); ?></div>
                                                                        <?php else: ?>
                                                                            <div class="badge bg-warning mb-1"><?php echo e(__(\App\Models\DealTask::$status[$task->status])); ?></div>
                                                                        <?php endif; ?>
                                                                    </h5>
                                                                    <small class="text-sm"><?php echo e(__(\App\Models\DealTask::$priorities[$task->priority])); ?> - <?php echo e(Auth::user()->dateFormat($task->date)); ?> <?php echo e(Auth::user()->timeFormat($task->time)); ?></small>
                                                                    <span class="text-muted text-sm">
                                                                        <?php if($task->status): ?>
                                                                            <div class="badge badge-pill badge-success mb-1"><?php echo e(__(\App\Models\DealTask::$status[$task->status])); ?></div>
                                                                        <?php else: ?>
                                                                            <div class="badge badge-pill badge-warning mb-1"><?php echo e(__(\App\Models\DealTask::$status[$task->status])); ?></div>
                                                                        <?php endif; ?>
                                                                    </span>
                                                                </div>
                                                                <span>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit task')): ?>
                                                                        <div class="action-btn bg-info ms-2">
                                                                        <a href="#" class="" data-title="<?php echo e(__('Edit Task')); ?>" data-url="<?php echo e(route('deals.tasks.edit',[$deal->id,$task->id])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Task')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                                    </div>
                                                                    <?php endif; ?>
                                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete task')): ?>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.tasks.destroy',$deal->id,$task->id], 'class' => 'modalForm']); ?>

                                                                        <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                                        <?php echo Form::close(); ?>

                                                                        </div>
                                                                    <?php endif; ?>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    <?php else: ?>
                                        <div class="text-center">
                                            No Tasks Available.!
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <!-- Meeting Section -->
                                <div id="content-meeting" class="tab-content" style="display: none;">
                                    <?php if(!$meetings->isEmpty()): ?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body table-border-style">
                                                    <div class="table-responsive">
                                                        <table class="table datatable">
                                                            <thead>
                                                            <tr>
                                                                <th><?php echo e(__('Meeting title')); ?></th>
                                                                <th><?php echo e(__('Meeting Date')); ?></th>
                                                                <th><?php echo e(__('Meeting Time')); ?></th>
                                                                <?php if(Gate::check('edit meeting') || Gate::check('delete meeting')): ?>
                                                                    <th width="200px"><?php echo e(__('Action')); ?></th>
                                                                <?php endif; ?>
                                                            </tr>
                                                            </thead>
                                                            <tbody class="font-style">
                                                            <?php $__currentLoopData = $meetings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $meeting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <tr>
                                                                    <td><?php echo e($meeting->title); ?></td>
                                                                    <td><?php echo e(\Auth::user()->dateFormat($meeting->date)); ?></td>
                                                                    <td><?php echo e(\Auth::user()->timeFormat($meeting->time)); ?></td>
                                                                    <?php if(Gate::check('edit meeting') || Gate::check('delete meeting')): ?>
                                                                        <td>
                                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit meeting')): ?>
                                                                                <div class="action-btn bg-primary ms-2">
                                                                                    <a href="#" data-url="<?php echo e(route('deals.meeting.edit',[$deal->id,$meeting->id])); ?>" data-size="lg" data-ajax-popup="true" data-title="<?php echo e(__('Edit Meeting')); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                                                </div>
                                                                            <?php endif; ?>
                                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete meeting')): ?>
                                                                            <div class="action-btn bg-danger ms-2">
                                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.meeting.destroy',$deal->id,$meeting->id], 'class' => 'modalForm']); ?>

                                                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                                                <?php echo Form::close(); ?>

                                                                                </div>
                                                                            <?php endif; ?>
                                                                        </td>
                                                                    <?php endif; ?>
                                                                </tr>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <div class="text-center">
                                        No Meetings Available.!
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div id="content-files" class="tab-content" style="display: none;">
                                    <div class="lead-view-section">
                                        <?php $__currentLoopData = $visits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $view): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="lead-view-item" style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 20px; border: 1px solid #ddd; padding: 15px;">
                                                <div style="flex: 1; padding-right: 15px;">
                                                    <h4><?php echo e($view->title); ?></h4>
                                                    <p><strong>Description:</strong> <?php echo $view->description; ?></p>
                                                    <p><strong>Assigned Users:</strong>
                                                        <?php
                                                            // Decode the assigned_users JSON
                                                            $assignedUsers = json_decode($view->assigned_users, true);
                                                            $userNames = \App\Models\User::whereIn('id', $assignedUsers)->pluck('name')->toArray();
                                                        ?>
                                                        <?php echo e(implode(', ', $userNames)); ?>

                                                    </p>
                                                    <p><strong>Date:</strong> <?php echo e($view->date); ?></p>
                                                    <p><strong>Time:</strong> <?php echo e($view->time); ?></p>
                                                    <p><strong>Location:</strong> <?php echo e($view->location); ?></p>
                                                    <p><strong>Status:</strong> <?php echo e($view->status); ?></p>
                                                    <p><strong>Recurrence:</strong> <?php echo e(\App\Models\LeadView::$recurrances[$view->recurrence] ?? 'None'); ?></p>
                                                    <p><strong>Repeat Interval:</strong> <?php echo e($view->repeat_interval); ?></p>
                                                    <p><strong>End Recurrence:</strong> <?php echo e($view->end_recurrence); ?></p>
                                                    <p><strong>Reminder:</strong> <?php echo e($view->reminder); ?></p>

                                                    <!-- File Display Section -->
                                                    

                                                    <style>
                                                        .file-horizontal-list {
                                                            display: flex;
                                                            list-style-type: none;
                                                            padding: 0;
                                                        }

                                                        .file-horizontal-list li {
                                                            margin-right: 15px;
                                                            display: flex;
                                                            align-items: center;
                                                        }

                                                        .file-image img {
                                                            max-width: 150px;
                                                            height: auto;
                                                            border: 1px solid #ddd;
                                                            border-radius: 4px;
                                                            padding: 5px;
                                                        }
                                                    </style>

                                                </div>

                                                <span>
                                                    
                                                            <div class="action-btn bg-info ms-2">
                                                            <a href="#" class="" data-title="<?php echo e(__('Edit Visit')); ?>" data-url="<?php echo e(route('deals.visit.edit',[$deal->id,$view->id])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit')); ?>"><i class="ti ti-pencil text-white"></i></a>
                                                        </div>
                                                        
                                                        
                                                            <div class="action-btn bg-danger ms-2">
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.visit.destroy',$deal->id,$view->id], 'class' => 'modalForm']); ?>

                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                            <?php echo Form::close(); ?>

                                                            </div>
                                                        
                                                    </span>
                                            </div>
                                            <hr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>



                                </div>

                            </div>
                        </div>

                         <!-- JavaScript for Toggling Tabs -->
                         <script>
                            function showTab(tabName) {
                                // Hide all tab content
                                document.querySelectorAll('.tab-content').forEach(function(content) {
                                    content.style.display = 'none';
                                });

                                // Remove active class from all buttons
                                document.querySelectorAll('.btn-link').forEach(function(button) {
                                    button.classList.remove('active');
                                });

                                // Show the selected tab and set the button as active
                                document.getElementById('content-' + tabName).style.display = 'block';
                                document.getElementById('tab-' + tabName).classList.add('active');
                            }

                            // Set default tab
                            document.addEventListener("DOMContentLoaded", function() {
                                showTab('calls'); // Default tab
                            });
                        </script>

                        <!-- CSS for active tab button -->
                        <style>
                            .btn-link.active {
                                font-weight: bold;
                                text-decoration: underline;
                            }
                        </style>


                        <div id="products">
                            <div class="row">

                                <div class="col-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5><?php echo e(__('Products')); ?></h5>
                                                <div class="float-end">
                                                    <a data-size="md" data-url="<?php echo e(route('deals.products.edit',$deal->id)); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Product')); ?>" data-title="<?php echo e(__('Add Product')); ?>" class="btn btn-sm btn-primary">
                                                        <i class="ti ti-plus text-white"></i>
                                                    </a>
                                                    <button class="btn btn-link" type="button" data-bs-toggle="collapse" data-bs-target="#leadProducts" aria-expanded="false" aria-controls="leadProducts" onclick="toggleleadProductsIcon(this)">
                                                        <i class="fas fa-chevron-right"></i> <!-- Starts with the right arrow -->
                                                    </button>
                                                    <script>
                                                        function toggleleadProductsIcon(button) {
                                                            const icon = button.querySelector('i');
                                                            icon.classList.toggle('fa-chevron-down');
                                                            icon.classList.toggle('fa-chevron-right');
                                                        }
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="leadProducts" class="collapse" aria-labelledby="">

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table class="table table-hover mb-0">
                                                        <thead>
                                                        <tr>
                                                            <th><?php echo e(__('Name')); ?></th>
                                                            <th><?php echo e(__('Price')); ?></th>
                                                            <th><?php echo e(__('Action')); ?></th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $__currentLoopData = $deal->products(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo e($product->name); ?>

                                                                </td>
                                                                <td>
                                                                    <?php echo e(\Auth::user()->priceFormat($product->sale_price)); ?>

                                                                </td>
                                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit deal')): ?>
                                                                    <td>
                                                                        <div class="action-btn bg-danger ms-2">
                                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['deals.products.destroy', $deal->id,$product->id], 'class' => 'modalForm']); ?>

                                                                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>

                                                                            <?php echo Form::close(); ?>

                                                                        </div>
                                                                    </td>
                                                                <?php endif; ?>
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
                        </div>

                        <div id="discussion_note">
                            <div class="row">
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5><?php echo e(__('Discussion')); ?></h5>

                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <ul class="list-group list-group-flush mt-2">
                                                <?php if(!$deal->discussions->isEmpty()): ?>
                                                    <?php $__currentLoopData = $deal->discussions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $discussion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <li class="list-group-item px-0">
                                                            <div class="d-block d-sm-flex align-items-start">
                                                                <img src="<?php if($discussion->user->avatar): ?> <?php echo e(asset('/storage/uploads/avatar/'.$discussion->user->avatar)); ?> <?php else: ?> <?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?> <?php endif; ?>"
                                                                    class="img-fluid wid-40 me-3 mb-2 mb-sm-0" alt="image">
                                                                <div class="w-100">
                                                                    <div class="d-flex align-items-center justify-content-between">
                                                                        <div class="mb-3 mb-sm-0">
                                                                            <h6 class="mb-0"> <?php echo e($discussion->comment); ?></h6>
                                                                        </div>
                                                                        <div class="form-check form-switch form-switch-right mb-2">
                                                                            <?php echo e($discussion->created_at->diffForHumans()); ?> by
                                                                            <span class="text-muted text-sm"><?php echo e($discussion->user->name); ?></span>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <li class="text-center">
                                                        <?php echo e(__(' No Data Available.!')); ?>

                                                    </li>
                                                <?php endif; ?>
                                            </ul>
                                            <?php echo e(Form::model($deal, array('route' => array('deals.discussion.store', $deal->id), 'method' => 'POST', 'class' => 'modalForm'))); ?>

                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12 form-group">
                                                        <?php echo e(Form::label('comment', __('Message'),['class'=>'form-label'])); ?>

                                                        <?php echo e(Form::textarea('comment', null, array('class' => 'form-control'))); ?>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
                                                <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
                                            </div>
                                            <?php echo e(Form::close()); ?>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <h5><?php echo e(__('Notes')); ?></h5>
                                                <?php
                                                    $settings = \App\Models\Utility::settings();
                                                ?>
                                                <?php if($settings['ai_chatgpt_enable'] == 'on'): ?>
                                                    <div class="float-end">
                                                        <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm" data-ajax-popup-over="true" id="grammarCheck" data-url="<?php echo e(route('grammar',['grammar'])); ?>"
                                                        data-bs-placement="top" data-title="<?php echo e(__('Grammar check with AI')); ?>">
                                                            <i class="ti ti-rotate"></i> <span><?php echo e(__('Grammar check with AI')); ?></span>
                                                        </a>
                                                        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['lead'])); ?>"
                                                        data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                                            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <textarea class="summernote-simple" name="note"><?php echo $deal->notes; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div id="salesAndFinance" class="card">
                            <div class="card-header">
                                <div class="d-flex align-items-center justify-content-between">
                                    <h5><?php echo e(__('Sales and Finance')); ?></h5>
                                    <div class="float-end">
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" id="activityDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="ti ti-plus text-white"></i> <?php echo e(__('Add Activity')); ?>

                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="activityDropdown">
                                                <li><a class="dropdown-item"><?php echo e(__('Add Sales')); ?></a></li>
                                                <li><a class="dropdown-item"><?php echo e(__('Add Finance')); ?></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <!-- Tab Navigation -->
                                <div>
                                    <button onclick="showTab('sales-finance')" class="btn btn-link" id="tab-sales-finance">Sales & Finance</button>
                                    <button onclick="showTab('estimates')" class="btn btn-link" id="tab-estimates">Estimates</button>
                                    <button onclick="showTab('quotation')" class="btn btn-link" id="tab-quotation">Quotation</button>
                                    <button onclick="showTab('invoices')" class="btn btn-link" id="tab-invoices">Invoices</button>
                                    <button onclick="showTab('sales-orders')" class="btn btn-link" id="tab-sales-orders">Sales Orders</button>
                                    <button onclick="showTab('performa-invoice')" class="btn btn-link" id="tab-performa-invoice">Performa Invoice</button>
                                    <button onclick="showTab('proposal')" class="btn btn-link" id="tab-proposal">Proposal</button>
                                </div>
                            </div>

                            <!-- Tab Content -->
                            <div class="card-body">
                                <!-- Sales & Finance -->
                                <div id="content-sales-finance" class="tab-content">
                                    <p>Static content for Sales & Finance.</p>
                                </div>

                                <!-- Estimates -->
                                <div id="content-estimates" class="tab-content" style="display: none;">
                                    <p>Static content for Estimates.</p>
                                </div>

                                <!-- Quotation -->
                                <div id="content-quotation" class="tab-content" style="display: none;">
                                    <p>Static content for Quotation.</p>
                                </div>

                                <!-- Invoices -->
                                <div id="content-invoices" class="tab-content" style="display: none;">
                                    <p>Static content for Invoices.</p>
                                </div>

                                <!-- Sales Orders -->
                                <div id="content-sales-orders" class="tab-content" style="display: none;">
                                    <p>Static content for Sales Orders.</p>
                                </div>

                                <!-- Performa Invoice -->
                                <div id="content-performa-invoice" class="tab-content" style="display: none;">
                                    <p>Static content for Performa Invoice.</p>
                                </div>

                                <!-- Proposal -->
                                <div id="content-proposal" class="tab-content" style="display: none;">
                                    <p>Static content for Proposal.</p>
                                </div>
                            </div>
                        </div>

                        <!-- JavaScript for Toggling Tabs -->
                        <script>
                            function showTab(tabName) {
                                // Hide all tab content
                                document.querySelectorAll('.tab-content').forEach(function(content) {
                                    content.style.display = 'none';
                                });

                                // Remove active class from all buttons
                                document.querySelectorAll('.btn-link').forEach(function(button) {
                                    button.classList.remove('active');
                                });

                                // Show the selected tab and set the button as active
                                document.getElementById('content-' + tabName).style.display = 'block';
                                document.getElementById('tab-' + tabName).classList.add('active');
                            }

                            // Set default tab
                            document.addEventListener("DOMContentLoaded", function() {
                                showTab('sales-finance'); // Default tab
                            });
                        </script>

                        <!-- CSS for active tab button -->
                        <style>
                            .btn-link.active {
                                font-weight: bold;
                                text-decoration: underline;
                            }
                        </style>

                        <div id="files" class="card">
                            <div class="card-header ">
                                <h5><?php echo e(__('Files')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div class="col-md-12 dropzone top-5-scroll browse-file" id="dropzonewidget"></div>
                            </div>
                        </div>

                        <div id="timeline" class="card">
                            <div class="card-header">
                                <h5><?php echo e(__('Timeline')); ?></h5>
                            </div>
                            <div class="card-body ">
                                <div class="row leads-scroll" >
                                    <ul class="event-cards list-group list-group-flush mt-3 w-100">
                                        <?php if(!$deal->activities->isEmpty()): ?>
                                            <?php $__currentLoopData = $deal->activities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $activity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li class="list-group-item card mb-3">
                                                    <div class="row align-items-center justify-content-between">
                                                        <div class="col-auto mb-3 mb-sm-0">
                                                            <div class="d-flex align-items-center">
                                                                <div class="theme-avtar bg-primary">
                                                                    <i class="ti ti-<?php echo e($activity->logIcon()); ?>"></i>
                                                                </div>
                                                                <div class="ms-3">
                                                                    <span class="text-dark text-sm"><?php echo e(__($activity->log_type)); ?></span>
                                                                    <h6 class="m-0"><?php echo $activity->getRemark(); ?></h6>
                                                                    <small class="text-muted"><?php echo e($activity->created_at->diffForHumans()); ?></small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-auto">

                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php else: ?>
                                            No activity found yet.
                                        <?php endif; ?>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/deals/show.blade.php ENDPATH**/ ?>