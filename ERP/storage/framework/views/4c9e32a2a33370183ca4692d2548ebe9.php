<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php
    use App\Models\WebhookSetting;
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $logo_light = \App\Models\Utility::getValByName('company_logo_light');
    $logo_dark = \App\Models\Utility::getValByName('company_logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $lang = App\Models\Utility::getValByName('default_language');
    $setting = \App\Models\Utility::colorset();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';

    $SITE_RTL = $setting['SITE_RTL'];
    if (!empty($setting['SITE_RTL'])) {
        $SITE_RTL == 'off';
    }
    $currantLang = Utility::languages();

    $meta_image = \App\Models\Utility::get_file('uploads/meta/');
    $webhookSetting = WebhookSetting::where('created_by', '=', \Auth::user()->creatorId())->get();

?>


<?php
    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);

    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);

    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);

?>


<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        $('.summernote-simple0').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('offerlatter.update', $offerlang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple1').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('joiningletter.update', $joininglang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple2').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('experiencecertificate.update', $explang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });
        $('.summernote-simple3').on('summernote.blur', function() {
            $.ajax({
                url: "<?php echo e(route('noc.update', $noclang)); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    content: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    console.log(response)
                    if (response.is_success) {
                        show_toastr('success', response.success, 'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {

                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                }
            })
        });

        //footer notes
        $('.summernote-simple4').on('summernote.blur', function() {

            $.ajax({
                url: "<?php echo e(route('system.settings.footernote')); ?>",
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                    notes: $(this).val()
                },
                type: 'POST',
                success: function(response) {
                    if (response.is_success) {
                        // show_toastr('Success', response.success,'success');
                    } else {
                        show_toastr('error', response.error, 'error');
                    }
                },
                error: function(response) {
                    response = response.responseJSON;
                    if (response.is_success) {
                        show_toastr('error', response.error, 'error');
                    } else {
                        show_toastr('error', response, 'error');
                    }
                }
            })
        });
    </script>

    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>

    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function() {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function() {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '<?php echo e(url('/proposal/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='bill_template'], input[name='bill_color']", function() {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '<?php echo e(url('/bill/preview')); ?>/' + template + '/' + color);
        });
    </script>

    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })

        $('.colorPicker').on('click', function(e) {
            $('body').removeClass('custom-color');
            if (/^theme-\d+$/) {
                $('body').removeClassRegex(/^theme-\d+$/);
            }
            $('body').addClass('custom-color');
            $('.themes-color-change').removeClass('active_color');
            $(this).addClass('active_color');

            const input = document.getElementById("color-picker");
            setColor();
            input.addEventListener("input", setColor);

            function setColor() {
                $(':root').css('--color-customColor', input.value);
            }

            $(`input[name='color_flag`).val('true');
        });


        $('.themes-color-change').on('click', function() {

            $(`input[name='color_flag`).val('false');

            var color_val = $(this).data('value');
            $('body').removeClass('custom-color');
            if (/^theme-\d+$/) {
                $('body').removeClassRegex(/^theme-\d+$/);
            }
            $('body').addClass(color_val);
            $('.theme-color').prop('checked', false);
            $('.themes-color-change').removeClass('active_color');
            $('.colorPicker').removeClass('active_color');
            $(this).addClass('active_color');
            $(`input[value=${color_val}]`).prop('checked', true);
        });

        $.fn.removeClassRegex = function(regex) {
            return $(this).removeClass(function(index, classes) {
                return classes.split(/\s+/).filter(function(c) {
                    return regex.test(c);
                }).join(' ');
            });
        };


        // storage setting
        $(document).on('change', '[name=storage_setting]', function() {
            if ($(this).val() == 's3') {
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            } else if ($(this).val() == 'wasabi') {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            } else {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>

    <script>
        document.getElementById('company_logo_dark').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image').src = src
        }
        document.getElementById('company_logo_light').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image1').src = src
        }
        document.getElementById('company_favicon').onchange = function() {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('image2').src = src
        }
    </script>

    <script type="text/javascript">
        $(document).on("click", '.send_email', function(e) {

            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');

            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');


                $.post(url, {
                    _token: '<?php echo e(csrf_token()); ?>',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),

                }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            // $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {
                    // console.log(data)
                    if (data.success) {
                        show_toastr('success', data.message, 'success');
                    } else {
                        show_toastr('error', data.message, 'error');
                    }
                    // $("#email_sending").hide();
                    $('#commonModal').modal('hide');


                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>

    <script>
        $(document).on('change', '#vat_gst_number_switch', function() {
            if ($(this).is(':checked')) {
                $('.tax_type_div').removeClass('d-none');
            } else {
                $('.tax_type_div').addClass('d-none');
            }
        });
    </script>

    
    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element == true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>

    <script>
        if ($('#cust-darklayout').length > 0) {
            var custthemedark = document.querySelector("#cust-darklayout");
            custthemedark.addEventListener("click", function() {
                if (custthemedark.checked) {
                    $('#main-style-link').attr('href', '<?php echo e(env('APP_URL')); ?>' +
                        '/public/assets/css/style-dark.css');

                    document.body.style.background = 'linear-gradient(141.55deg, #22242C 3.46%, #22242C 99.86%)';
                    $('.dash-sidebar .main-logo a img').attr('src', '<?php echo e($logo . '/logo-light.png'); ?>');

                } else {
                    document.body.style.setProperty('background',
                        'linear-gradient(141.55deg, rgba(240, 244, 243, 0) 3.46%, #f0f4f3 99.86%)', 'important');

                    $('#main-style-link').attr('href', '<?php echo e(env('APP_URL')); ?>' + '/public/assets/css/style.css');
                    $('.dash-sidebar .main-logo a img').attr('src', '<?php echo e($logo . '/logo-dark.png'); ?>');

                }
            });
        }
        if ($('#cust-theme-bg').length > 0) {
            var custthemebg = document.querySelector("#cust-theme-bg");
            custthemebg.addEventListener("click", function() {
                if (custthemebg.checked) {
                    document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.add("transprent-bg");
                } else {
                    document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.remove("transprent-bg");
                }
            });
        }
    </script>

    <script>

        $(document).on('keyup change', '.currency_preview', function() {
                    var data = $('#currency_setting').serialize();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo e(route('currency.preview')); ?>',
                        data: data,
                        success: function(price) {
                            $('.preview').text(price);
                        }
                    });
            });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Settings')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">

                <div class="col-xl-12">
                    <!--Brand Settings-->
                    <div id="brand-settings" class="card">
                        <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="card-header">
                            <h5><?php echo e(__('Brand Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your brand details')); ?></small>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Logo dark')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image"
                                                        src="<?php echo e($logo . '/' . (isset($logo_dark) && !empty($logo_dark) ? $logo_dark : 'logo-dark.png') . '?timestamp=' . time()); ?>"
                                                        class="big-logo">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_logo_dark">
                                                        <div class=" bg-primary dark_logo_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" name="company_logo_dark"
                                                            id="company_logo_dark" class="form-control file"
                                                            data-filename="dark_logo_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['company_logo_dark'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Logo Light')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image1"
                                                        src="<?php echo e($logo . '/' . (isset($logo_light) && !empty($logo_light) ? $logo_light : 'logo-light.png') . '?timestamp=' . time()); ?>"
                                                        class="big-logo img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_logo_light">
                                                        <div class=" bg-primary light_logo_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" class="form-control file"
                                                            name="company_logo_light" id="company_logo_light"
                                                            data-filename="light_logo_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['company_logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card logo_card">
                                        <div class="card-header">
                                            <h5><?php echo e(__('Favicon')); ?></h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="logo-content mt-4">
                                                    <img id="image2"
                                                        src="<?php echo e($logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '?timestamp=' . time()); ?>"
                                                        width="50px" class="img_setting">
                                                </div>
                                                <div class="choose-files mt-5">
                                                    <label for="company_favicon">
                                                        <div class="bg-primary company_favicon_update"> <i
                                                                class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                        </div>
                                                        <input type="file" class="form-control file"
                                                            id="company_favicon" name="company_favicon"
                                                            data-filename="company_favicon_update">
                                                    </label>
                                                </div>
                                                <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                                        </span>
                                                    </div>
                                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                            <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-title_text" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'form-label'])); ?>

                                            <?php echo e(Form::text('footer_text', Utility::getValByName('footer_text'), ['class' => 'form-control', 'placeholder' => __('Enter Footer Text')])); ?>

                                            <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-footer_text" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">

                                            
                                        </div>
                                    </div>
                                </div>
                                <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-2 ">
                                                <i data-feather="credit-card"
                                                    class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                            </h6>

                                            <hr class="my-2 " />
                                            <div class="color-wrp">
                                                <div class="theme-color themes-color">
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                        data-value="theme-1"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-1"<?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                        data-value="theme-2"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-2"<?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                        data-value="theme-3"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-3"<?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                        data-value="theme-4"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-4"<?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-5' ? 'active_color' : ''); ?>"
                                                        data-value="theme-5"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-5"<?php echo e($color == 'theme-5' ? 'checked' : ''); ?>>
                                                    <br>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-6' ? 'active_color' : ''); ?>"
                                                        data-value="theme-6"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-6"<?php echo e($color == 'theme-6' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-7' ? 'active_color' : ''); ?>"
                                                        data-value="theme-7"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-7"<?php echo e($color == 'theme-7' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-8' ? 'active_color' : ''); ?>"
                                                        data-value="theme-8"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-8"<?php echo e($color == 'theme-8' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-9' ? 'active_color' : ''); ?>"
                                                        data-value="theme-9"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-9"<?php echo e($color == 'theme-9' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-10' ? 'active_color' : ''); ?>"
                                                        data-value="theme-10"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-10"<?php echo e($color == 'theme-10' ? 'checked' : ''); ?>>
                                                </div>
                                                <div class="color-picker-wrp ">
                                                    <input type="color" value="<?php echo e($color ? $color : ''); ?>"
                                                        class="colorPicker <?php echo e(isset($settings['color_flag']) && $setting['color_flag'] == 'true' ? 'active_color' : ''); ?>"
                                                        name="custom_color" id="color-picker">
                                                    <input type='hidden' name="color_flag"
                                                        value=<?php echo e(isset($settings['color_flag']) && $settings['color_flag'] == 'true' ? 'true' : 'false'); ?>>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-2 ">
                                                <i data-feather="layout" class="me-2"></i><?php echo e(__('Sidebar settings')); ?>

                                            </h6>
                                            <hr class="my-2 " />
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="cust-theme-bg"
                                                    name="cust_theme_bg"
                                                    <?php echo e(!empty($settings['cust_theme_bg']) && $settings['cust_theme_bg'] == 'on' ? 'checked' : ''); ?> />
                                                <label class="form-check-label f-w-600 pl-1"
                                                    for="cust-theme-bg"><?php echo e(__('Transparent layout')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-xl-4 col-md-4">
                                            <h6 class="mt-2 ">
                                                <i data-feather="sun" class="me-2"></i><?php echo e(__('Layout settings')); ?>

                                            </h6>
                                            <hr class="my-2 " />
                                            <div class="form-check form-switch mt-2">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                    name="cust_darklayout"<?php echo e(!empty($settings['cust_darklayout']) && $settings['cust_darklayout'] == 'on' ? 'checked' : ''); ?> />
                                                <label class="form-check-label f-w-600 pl-1"
                                                    for="cust-darklayout"><?php echo e(__('Dark Layout')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--System Settings-->
                    <div id="system-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('System Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your system details')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'system.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                

                                <div class="form-group col-md-6">
                                    <label for="site_date_format" class="form-label"><?php echo e(__('Date Format')); ?></label>
                                    <select type="text" name="site_date_format" class="form-control selectric"
                                        id="site_date_format">
                                        <option value="M j, Y"
                                            <?php if(@$settings['site_date_format'] == 'M j, Y'): ?> selected="selected" <?php endif; ?>>Jan 1,2015</option>
                                        <option value="d-m-Y"
                                            <?php if(@$settings['site_date_format'] == 'd-m-Y'): ?> selected="selected" <?php endif; ?>>dd-mm-yyyy</option>
                                        <option value="m-d-Y"
                                            <?php if(@$settings['site_date_format'] == 'm-d-Y'): ?> selected="selected" <?php endif; ?>>mm-dd-yyyy</option>
                                        <option value="Y-m-d"
                                            <?php if(@$settings['site_date_format'] == 'Y-m-d'): ?> selected="selected" <?php endif; ?>>yyyy-mm-dd</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="site_time_format" class="form-label"><?php echo e(__('Time Format')); ?></label>
                                    <select type="text" name="site_time_format" class="form-control selectric"
                                        id="site_time_format">
                                        <option value="g:i A"
                                            <?php if(@$settings['site_time_format'] == 'g:i A'): ?> selected="selected" <?php endif; ?>>10:30 PM</option>
                                        <option value="g:i a"
                                            <?php if(@$settings['site_time_format'] == 'g:i a'): ?> selected="selected" <?php endif; ?>>10:30 pm</option>
                                        <option value="H:i"
                                            <?php if(@$settings['site_time_format'] == 'H:i'): ?> selected="selected" <?php endif; ?>>22:30</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('customer_prefix', __('Customer Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('customer_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['customer_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-customer_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('vender_prefix', __('Vendor Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('vender_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['vender_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-vender_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('proposal_prefix', __('Proposal Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('proposal_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['proposal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-proposal_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('invoice_prefix', __('Invoice Prefix'), ['class' => 'form-label'])); ?>


                                    <?php echo e(Form::text('invoice_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['invoice_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-invoice_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('bill_prefix', __('Bill Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('bill_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['bill_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-bill_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('quotation_prefix', __('Quotation Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('quotation_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['quotation_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-quotation_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('purchase_prefix', __('Purchase Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('purchase_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['purchase_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-purchase_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('pos_prefix', __('Pos Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('pos_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['pos_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-pos_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('journal_prefix', __('Journal Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('journal_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['journal_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-journal_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('expense_prefix', __('Expense Prefix'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('expense_prefix', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['expense_prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-expense_prefix" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('shipping_display', __('Display Shipping in Proposal / Invoice / Bill'), ['class' => 'form-label'])); ?>

                                    <div class=" form-switch form-switch-left">
                                        <input type="checkbox" class="form-check-input mt-3" name="shipping_display"
                                            id="email_tempalte_13"
                                            <?php echo e($settings['shipping_display'] == 'on' ? 'checked' : ''); ?>>
                                        <label class="form-check-label" for="email_tempalte_13"></label>
                                    </div>
                                    <?php $__errorArgs = ['shipping_display'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-shipping_display" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('footer_title', __('Proposal/Invoice/Bill/Purchase/POS Footer Title'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('footer_title', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['footer_title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-footer_title" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('footer_notes', __('Proposal/Invoice/Bill/Purchase/POS Footer Note'), ['class' => 'form-label'])); ?>

                                    <textarea class="summernote-simple4 summernote-simple"><?php echo $settings['footer_notes']; ?></textarea>
                                </div>

                                
                                
                                
                                
                                
                                
                                
                                
                                

                                
                                
                                
                                
                                
                                
                                
                                
                                


                                
                                
                                
                                
                                
                                
                                
                                
                                



                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>


                    </div>

                    <!--Company Settings-->
                    <div id="company-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Company Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your company details')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'company.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_name *', __('Company Name *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_name', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_name" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_address', __('Address'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_address', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_address" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_city', __('City'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_city', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_city'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_city" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_state', __('State'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_state', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_state" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_zipcode', __('Zip/Post Code'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_zipcode', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_zipcode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_zipcode" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group  col-md-6">
                                    <?php echo e(Form::label('company_country', __('Country'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_country', null, ['class' => 'form-control font-style'])); ?>

                                    <?php $__errorArgs = ['company_country'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_country" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('company_telephone', __('Telephone'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('company_telephone', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_telephone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_telephone" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('registration_number', __('Company Registration Number *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('registration_number', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['registration_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-registration_number" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>


                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_start_time', __('Company Start Time *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::time('company_start_time', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_start_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_start_time" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('company_end_time', __('Company End Time *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::time('company_end_time', null, ['class' => 'form-control'])); ?>

                                    <?php $__errorArgs = ['company_end_time'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-company_end_time" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="form-group col-md-4">
                                    <label class="" for="ip_restrict"><?php echo e(__('Ip Restrict')); ?></label>
                                    <div class="custom-control custom-switch mt-2">
                                        <input type="checkbox" class=" form-check-input" data-toggle="switchbutton"
                                            data-onstyle="primary" name="ip_restrict" id="ip_restrict"
                                            <?php echo e($settings['ip_restrict'] == 'on' ? 'checked' : ''); ?>>
                                    </div>
                                </div>

                                <div class="form-group col-md-12 mt-2">
                                    <?php echo e(Form::label('timezone', __('Timezone'), ['class' => 'form-label'])); ?>

                                    <select type="text" name="timezone" class="form-control custom-select"
                                        id="timezone">
                                        <option value=""><?php echo e(__('Select Timezone')); ?></option>
                                        <?php $__currentLoopData = $timezones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $timezone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($k); ?>"
                                                <?php echo e($settings['timezone'] == $k ? 'selected' : ''); ?>><?php echo e($timezone); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <div class="row mt-4">
                                        <div class="col-md-6">
                                            <label for="vat_gst_number_switch"><?php echo e(__('Tax Number')); ?></label>
                                            <div class="form-check form-switch custom-switch-v1 float-end">
                                                <input type="checkbox" name="vat_gst_number_switch"
                                                    class="form-check-input input-primary pointer" value="on"
                                                    id="vat_gst_number_switch"
                                                    <?php echo e($settings['vat_gst_number_switch'] == 'on' ? ' checked ' : ''); ?>>
                                                <label class="form-check-label" for="vat_gst_number_switch"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div
                                    class="form-group col-md-6 tax_type_div <?php echo e($settings['vat_gst_number_switch'] != 'on' ? ' d-none ' : ''); ?>">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline form-group mb-3">
                                                <input type="radio" id="customRadio8" name="tax_type" value="VAT"
                                                    class="form-check-input"
                                                    <?php echo e($settings['tax_type'] == 'VAT' ? 'checked' : ''); ?>>
                                                <label class="form-check-label"
                                                    for="customRadio8"><?php echo e(__('VAT Number')); ?></label>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-check form-check-inline form-group mb-3">
                                                <input type="radio" id="customRadio7" name="tax_type" value="GST"
                                                    class="form-check-input"
                                                    <?php echo e($settings['tax_type'] == 'GST' ? 'checked' : ''); ?>>
                                                <label class="form-check-label"
                                                    for="customRadio7"><?php echo e(__('GST Number')); ?></label>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo e(Form::text('vat_number', null, ['class' => 'form-control', 'placeholder' => __('Enter VAT / GST Number')])); ?>

                                </div>




                            </div>

                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>


                    </div>


                    <!--Currency Settings-->
                    <div id="currency-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Currency Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your currency details')); ?></small>
                        </div>
                        <?php echo e(Form::model($setting, ['route' => 'currency.settings', 'method' => 'post' , 'id'=>'currency_setting'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('site_currency', __('Currency *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('site_currency', $setting['site_currency'], ['class' => 'form-control font-style currency_preview', 'required', 'placeholder' => __('Enter Currency')])); ?>

                                    <small> <?php echo e(__('Note: Add currency code as per three-letter ISO code.')); ?><br>
                                        <a href="https://stripe.com/docs/currencies"
                                            target="_blank"><?php echo e(__('You can find out how to do that here.')); ?></a></small>
                                    <br>
                                    <?php $__errorArgs = ['site_currency'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-site_currency" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::text('site_currency_symbol', null, ['class' => 'form-control currency_preview'])); ?>

                                    <?php $__errorArgs = ['site_currency_symbol'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-site_currency_symbol" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <?php echo e(Form::label('decimal_number', __('Decimal Number Format'), ['class' => 'form-label'])); ?>

                                    <?php echo e(Form::number('decimal_number', null, ['class' => 'form-control currency_preview'])); ?>

                                    <?php $__errorArgs = ['decimal_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-decimal_number" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="decimal_separator" class="form-label"><?php echo e(__('Decimal Separator')); ?></label>
                                    <select type="text" name="decimal_separator" class="form-control selectric currency_preview"
                                        id="decimal_separator">
                                        <option value="dot" <?php if(@$setting['decimal_separator'] == 'dot'): ?> selected="selected" <?php endif; ?>><?php echo e(__('Dot')); ?></option>
                                        <option value="comma" <?php if(@$setting['decimal_separator'] == 'comma'): ?> selected="selected" <?php endif; ?>><?php echo e(__('Comma')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="thousand_separator" class="form-label"><?php echo e(__('Thousands Separator')); ?></label>
                                    <select type="text" name="thousand_separator" class="form-control selectric currency_preview"
                                        id="thousand_separator">
                                        <option value="dot" <?php if(@$setting['thousand_separator'] == 'dot'): ?> selected="selected" <?php endif; ?>><?php echo e(__('Dot')); ?></option>
                                        <option value="comma" <?php if(@$setting['thousand_separator'] == 'comma'): ?> selected="selected" <?php endif; ?>><?php echo e(__('Comma')); ?></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label"
                                        for="example3cols3Input"><?php echo e(__('Currency Symbol Position')); ?></label>
                                    <div class="row ms-1">
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input currency_preview" type="radio"
                                                name="site_currency_symbol_position" value="pre"
                                                <?php if(@$setting['site_currency_symbol_position'] == 'pre'): ?> checked <?php endif; ?> id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                <?php echo e(__('Pre')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input currency_preview" type="radio"
                                                name="site_currency_symbol_position" value="post"
                                                <?php if(@$setting['site_currency_symbol_position'] == 'post'): ?> checked <?php endif; ?> id="flexCheckChecked">
                                            <label class="form-check-label" for="flexCheckChecked">
                                                <?php echo e(__('Post')); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('currency_space', __('Currency Symbol Space'), ['class' => 'form-label'])); ?>

                                    <div class="row ms-1">
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input currency_preview" type="radio"
                                                name="currency_space" value="withspace"
                                                <?php if(@$setting['currency_space'] == 'withspace'): ?> checked <?php endif; ?> id="withspace">
                                            <label class="form-check-label" for="withspace">
                                                <?php echo e(__('With space')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input currency_preview" type="radio"
                                                name="currency_space" value="withoutspace"
                                                <?php if(@$setting['currency_space'] == 'withoutspace'): ?> checked <?php endif; ?> id="withoutspace">
                                            <label class="form-check-label" for="withoutspace">
                                                <?php echo e(__('Without space')); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('currency_symbol', __('Currency Symbol & Name'), ['class' => 'form-label'])); ?>

                                    <div class="row ms-1">
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input currency_preview" type="radio"
                                                name="currency_symbol" value="withcurrencysymbol"
                                                <?php if(@$setting['currency_symbol'] == 'withcurrencysymbol'): ?> checked <?php endif; ?> id="withcurrencysymbol">
                                            <label class="form-check-label" for="withcurrencysymbol">
                                                <?php echo e(__('With Currency Symbol')); ?>

                                            </label>
                                        </div>
                                        <div class="form-check col-md-6">
                                            <input class="form-check-input currency_preview" type="radio"
                                                name="currency_symbol" value="withcurrencyname"
                                                <?php if(@$setting['currency_symbol'] == 'withcurrencyname'): ?> checked <?php endif; ?> id="withcurrencyname">
                                            <label class="form-check-label" for="withcurrencyname">
                                                <?php echo e(__('With Currency Name')); ?>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-6">
                                    <?php echo e(Form::label('preview', __('Preview : '), ['class' => 'form-label'])); ?>

                                    <div class="row">
                                        <div class="col-md-6 preview">
                                                <?php echo e(__('$ 10.000,00')); ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Time-Tracker Settings-->
                    <div id="tracker-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Time Tracker Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Time Tracker settings')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'tracker.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Application URL')); ?></label> <br>
                                    <small><?php echo e(__('Application URL to log into the app.')); ?></small>
                                    <?php echo e(Form::text('apps_url', URL::to('/'), ['class' => 'form-control', 'placeholder' => __('Application URL'), 'readonly' => 'true'])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Tracking Interval')); ?></label> <br>
                                    <small><?php echo e(__('Image Screenshot Take Interval time ( 1 = 1 min)')); ?></small>
                                    <?php echo e(Form::number('interval_time', isset($settings['interval_time']) ? $settings['interval_time'] : '10', ['class' => 'form-control', 'placeholder' => __('Enter Tracking Interval Time')])); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>



                    <!--Email Settings-->
                    <div id="email-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Email Settings')); ?></h5>
                        </div>
                        <div class="card-body">
                            <?php echo e(Form::open(['route' => 'email.settings', 'method' => 'post'])); ?>

                            <?php echo csrf_field(); ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_driver', isset($settings['mail_driver']) ? $settings['mail_driver'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_host', isset($settings['mail_host']) ? $settings['mail_host'] : '', ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')])); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_port', isset($settings['mail_port']) ? $settings['mail_port'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_username', isset($settings['mail_username']) ? $settings['mail_username'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_password', isset($settings['mail_password']) ? $settings['mail_password'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                        <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_encryption', isset($settings['mail_encryption']) ? $settings['mail_encryption'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                        <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_from_address', isset($settings['mail_from_address']) ? $settings['mail_from_address'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                        <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('mail_from_name', isset($settings['mail_from_name']) ? $settings['mail_from_name'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                        <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="card-footer d-flex justify-content-end">
                                    <div class="form-group me-2">
                                        <a href="#" data-url="<?php echo e(route('test.mail')); ?>" data-ajax-popup="true"
                                            data-title="<?php echo e(__('Send Test Mail')); ?>"
                                            class="btn btn-primary send_email ">
                                            <?php echo e(__('Send Test Mail')); ?>

                                        </a>
                                    </div>


                                    <div class="form-group">
                                        <input class="btn btn-primary" type="submit"
                                            value="<?php echo e(__('Save Changes')); ?>">
                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <!--Pusher Settings-->
                    <div id="pusher-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Pusher Settings')); ?></h5>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'pusher.setting', 'method' => 'post'])); ?>

                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('pusher_app_id', __('Pusher App Id'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_id', null, ['class' => 'form-control font-style'])); ?>

                                        <?php $__errorArgs = ['pusher_app_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_id" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('pusher_app_key', __('Pusher App Key'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_key', null, ['class' => 'form-control font-style'])); ?>

                                        <?php $__errorArgs = ['pusher_app_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_key" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('pusher_app_secret', __('Pusher App Secret'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_secret', null, ['class' => 'form-control font-style'])); ?>

                                        <?php $__errorArgs = ['pusher_app_secret'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_secret" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('pusher_app_cluster', __('Pusher App Cluster'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('pusher_app_cluster', null, ['class' => 'form-control font-style'])); ?>

                                        <?php $__errorArgs = ['pusher_app_cluster'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-pusher_app_cluster" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <!--Zoom - Metting Settings-->
                    <div id="zoom-settings" class="card">
                        <div class="card-header">
                            <h5><?php echo e(__('Zoom Settings')); ?></h5>
                            <small class="text-muted"><?php echo e(__('Edit your Zoom settings')); ?></small>
                        </div>
                        <?php echo e(Form::model($settings, ['route' => 'zoom.settings', 'method' => 'post'])); ?>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom Account ID')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_account_id', isset($settings['zoom_account_id']) ? $settings['zoom_account_id'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Accound Id')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom Client ID')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_client_id', isset($settings['zoom_client_id']) ? $settings['zoom_client_id'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Client Id')])); ?>

                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-control-label"><?php echo e(__('Zoom Client Secret Key')); ?></label> <br>
                                    <?php echo e(Form::text('zoom_client_secret', isset($settings['zoom_client_secret']) ? $settings['zoom_client_secret'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Zoom Client Secret Key')])); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <div class="form-group">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Save Changes')); ?>">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>



                    <!--ReCaptcha Settings-->
                    <div id="recaptcha-settings" class="card">
                        <form method="POST" action="<?php echo e(route('recaptcha.settings.store')); ?>"
                            accept-charset="UTF-8">
                            <?php echo csrf_field(); ?>
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('ReCaptcha Settings')); ?></h5>
                                        <a href="https://phppot.com/php/how-to-get-google-recaptcha-site-and-secret-key/"
                                            target="_blank" class="text-dark">
                                            <small>(<?php echo e(__('How to Get Google reCaptcha Site and Secret key')); ?>)</small>
                                        </a>
                                    </div>
                                    <div class="col switch-width text-end">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton"
                                                    data-onstyle="primary" class="" name="recaptcha_module"
                                                    id="recaptcha_module"
                                                    <?php echo e(!empty($setting['recaptcha_module']) && $setting['recaptcha_module'] == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="custom-control-label" for="recaptcha_module"></label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="google_recaptcha_key"
                                                class="form-label"><?php echo e(__('Google Recaptcha Key')); ?></label>
                                            <input class="form-control"
                                                placeholder="<?php echo e(__('Enter Google Recaptcha Key')); ?>"
                                                name="google_recaptcha_key" type="text"
                                                value="<?php echo e(!empty($setting['google_recaptcha_key']) ? $setting['google_recaptcha_key'] : ''); ?>"
                                                id="google_recaptcha_key" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="google_recaptcha_secret"
                                                class="form-label"><?php echo e(__('Google Recaptcha Secret')); ?></label>
                                            <input class="form-control"
                                                placeholder="<?php echo e(__('Enter Google Recaptcha Secret')); ?>"
                                                name="google_recaptcha_secret" type="text"
                                                value="<?php echo e(!empty($setting['google_recaptcha_secret']) ? $setting['google_recaptcha_secret'] : ''); ?>"
                                                id="google_recaptcha_secret" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <div class="form-group">
                                    <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                        value="<?php echo e(__('Save Changes')); ?>">
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                    </div>

                    <!--Email Notification Settings-->
                    <div id="email-notification-settings" class="card">
                        <?php echo e(Form::model($settings, ['route' => ['status.email.language'], 'method' => 'post'])); ?>

                        <?php echo csrf_field(); ?>
                        <div class="col-md-12">
                            <div class="card-header">
                                <h5><?php echo e(__('Email Notification Settings')); ?></h5>
                                <small class="text-muted"><?php echo e(__('Edit email notification settings')); ?></small>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <?php $__currentLoopData = $EmailTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $EmailTemplate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-4 col-md-6 col-sm-6 form-group">
                                            <div class="list-group">
                                                <div class="list-group-item form-switch form-switch-right">
                                                    <label class="form-label"
                                                        style="margin-left:5%;"><?php echo e($EmailTemplate->name); ?></label>
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    
                                                    

                                                    <input class="form-check-input" name='<?php echo e($EmailTemplate->id); ?>'
                                                        id="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"
                                                        type="checkbox"
                                                        <?php if($EmailTemplate->template->is_active == 1): ?> checked="checked" <?php endif; ?>
                                                        type="checkbox" value="1"
                                                        data-url="<?php echo e(route('status.email.language', [$EmailTemplate->template->id])); ?>" />
                                                    <label class="form-check-label"
                                                        for="email_tempalte_<?php echo e($EmailTemplate->template->id); ?>"></label>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="card-footer p-0">
                                    <div class="col-sm-12 mt-3 px-2">
                                        <div class="text-end">
                                            <input class="btn btn-print-invoice  btn-primary " type="submit"
                                                value="<?php echo e(__('Save Changes')); ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>


                    </div>

                    <!-- Storage Settings -->
                    <div id="storage-settings" class="card mb-3">
                        <?php echo e(Form::open(['route' => 'storage.setting.store', 'enctype' => 'multipart/form-data'])); ?>

                        <div class="card-header">
                            <div class="row">
                                <div class="col-lg-10 col-md-10 col-sm-10">
                                    <h5 class=""><?php echo e(__('Storage Settings')); ?></h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting"
                                        id="local-outlined" autocomplete="off"
                                        <?php echo e($setting['storage_setting'] == 'local' ? 'checked' : ''); ?> value="local"
                                        checked>
                                    <label class="btn btn-outline-primary"
                                        for="local-outlined"><?php echo e(__('Local')); ?></label>
                                </div>
                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting" id="s3-outlined"
                                        autocomplete="off" <?php echo e($setting['storage_setting'] == 's3' ? 'checked' : ''); ?>

                                        value="s3">
                                    <label class="btn btn-outline-primary" for="s3-outlined">
                                        <?php echo e(__('AWS S3')); ?></label>
                                </div>

                                <div class="pe-2">
                                    <input type="radio" class="btn-check" name="storage_setting"
                                        id="wasabi-outlined" autocomplete="off"
                                        <?php echo e($setting['storage_setting'] == 'wasabi' ? 'checked' : ''); ?> value="wasabi">
                                    <label class="btn btn-outline-primary"
                                        for="wasabi-outlined"><?php echo e(__('Wasabi')); ?></label>
                                </div>
                            </div>
                            <div class="mt-2">
                                <div class="local-setting row <?php echo e($setting['storage_setting'] == 'local' ? ' ' : 'd-none'); ?>">
                                    
                                    <div class="form-group col-8 switch-width">
                                        <?php echo e(Form::label('local_storage_validation', __('Only Upload Files'), ['class' => ' form-label'])); ?>

                                        <select name="local_storage_validation[]" class="select2"
                                            id="local_storage_validation" multiple>
                                            <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php if(in_array($f, $local_storage_validations)): ?> selected <?php endif; ?>>
                                                    <?php echo e($f); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label class="form-label"
                                                for="local_storage_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                            <input type="number" name="local_storage_max_upload_size"
                                                class="form-control"
                                                value="<?php echo e(!isset($setting['local_storage_max_upload_size']) || is_null($setting['local_storage_max_upload_size']) ? '' : $setting['local_storage_max_upload_size']); ?>"
                                                placeholder="<?php echo e(__('Max upload size')); ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="s3-setting row <?php echo e($setting['storage_setting'] == 's3' ? ' ' : 'd-none'); ?>">

                                    <div class=" row ">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_key"><?php echo e(__('S3 Key')); ?></label>
                                                <input type="text" name="s3_key" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_key']) || is_null($setting['s3_key']) ? '' : $setting['s3_key']); ?>"
                                                    placeholder="<?php echo e(__('S3 Key')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_secret"><?php echo e(__('S3 Secret')); ?></label>
                                                <input type="text" name="s3_secret" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_secret']) || is_null($setting['s3_secret']) ? '' : $setting['s3_secret']); ?>"
                                                    placeholder="<?php echo e(__('S3 Secret')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_region"><?php echo e(__('S3 Region')); ?></label>
                                                <input type="text" name="s3_region" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_region']) || is_null($setting['s3_region']) ? '' : $setting['s3_region']); ?>"
                                                    placeholder="<?php echo e(__('S3 Region')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_bucket"><?php echo e(__('S3 Bucket')); ?></label>
                                                <input type="text" name="s3_bucket" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_bucket']) || is_null($setting['s3_bucket']) ? '' : $setting['s3_bucket']); ?>"
                                                    placeholder="<?php echo e(__('S3 Bucket')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label" for="s3_url"><?php echo e(__('S3 URL')); ?></label>
                                                <input type="text" name="s3_url" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_url']) || is_null($setting['s3_url']) ? '' : $setting['s3_url']); ?>"
                                                    placeholder="<?php echo e(__('S3 URL')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_endpoint"><?php echo e(__('S3 Endpoint')); ?></label>
                                                <input type="text" name="s3_endpoint" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_endpoint']) || is_null($setting['s3_endpoint']) ? '' : $setting['s3_endpoint']); ?>"
                                                    placeholder="<?php echo e(__('S3 Endpoint')); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-8 switch-width">
                                            <?php echo e(Form::label('s3_storage_validation', __('Only Upload Files'), ['class' => ' form-label'])); ?>

                                            <select name="s3_storage_validation[]" class="select2"
                                                id="s3_storage_validation" multiple>
                                                <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(in_array($f, $s3_storage_validations)): ?> selected <?php endif; ?>>
                                                        <?php echo e($f); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_max_upload_size"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                                <input type="number" name="s3_max_upload_size" class="form-control"
                                                    value="<?php echo e(!isset($setting['s3_max_upload_size']) || is_null($setting['s3_max_upload_size']) ? '' : $setting['s3_max_upload_size']); ?>"
                                                    placeholder="<?php echo e(__('Max upload size')); ?>">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div
                                    class="wasabi-setting row <?php echo e($setting['storage_setting'] == 'wasabi' ? ' ' : 'd-none'); ?>">
                                    <div class=" row ">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_key"><?php echo e(__('Wasabi Key')); ?></label>
                                                <input type="text" name="wasabi_key" class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_key']) || is_null($setting['wasabi_key']) ? '' : $setting['wasabi_key']); ?>"
                                                    placeholder="<?php echo e(__('Wasabi Key')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_secret"><?php echo e(__('Wasabi Secret')); ?></label>
                                                <input type="text" name="wasabi_secret" class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_secret']) || is_null($setting['wasabi_secret']) ? '' : $setting['wasabi_secret']); ?>"
                                                    placeholder="<?php echo e(__('Wasabi Secret')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="s3_region"><?php echo e(__('Wasabi Region')); ?></label>
                                                <input type="text" name="wasabi_region" class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_region']) || is_null($setting['wasabi_region']) ? '' : $setting['wasabi_region']); ?>"
                                                    placeholder="<?php echo e(__('Wasabi Region')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_bucket"><?php echo e(__('Wasabi Bucket')); ?></label>
                                                <input type="text" name="wasabi_bucket" class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_bucket']) || is_null($setting['wasabi_bucket']) ? '' : $setting['wasabi_bucket']); ?>"
                                                    placeholder="<?php echo e(__('Wasabi Bucket')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_url"><?php echo e(__('Wasabi URL')); ?></label>
                                                <input type="text" name="wasabi_url" class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_url']) || is_null($setting['wasabi_url']) ? '' : $setting['wasabi_url']); ?>"
                                                    placeholder="<?php echo e(__('Wasabi URL')); ?>">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_root"><?php echo e(__('Wasabi Root')); ?></label>
                                                <input type="text" name="wasabi_root" class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_root']) || is_null($setting['wasabi_root']) ? '' : $setting['wasabi_root']); ?>"
                                                    placeholder="<?php echo e(__('Wasabi Root')); ?>">
                                            </div>
                                        </div>
                                        <div class="form-group col-8 switch-width">
                                            <?php echo e(Form::label('wasabi_storage_validation', __('Only Upload Files'), ['class' => 'form-label'])); ?>


                                            <select name="wasabi_storage_validation[]" class="select2"
                                                id="wasabi_storage_validation" multiple>
                                                <?php $__currentLoopData = $file_type; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $f): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if(in_array($f, $wasabi_storage_validations)): ?> selected <?php endif; ?>>
                                                        <?php echo e($f); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label class="form-label"
                                                    for="wasabi_root"><?php echo e(__('Max upload size ( In KB)')); ?></label>
                                                <input type="number" name="wasabi_max_upload_size"
                                                    class="form-control"
                                                    value="<?php echo e(!isset($setting['wasabi_max_upload_size']) || is_null($setting['wasabi_max_upload_size']) ? '' : $setting['wasabi_max_upload_size']); ?>"
                                                    placeholder="<?php echo e(__('Max upload size')); ?>">
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice  btn-primary m-r-10" type="submit"
                                value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <div id="offer-letter-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Offer Letter Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($offerlangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $offerlangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.offerlatter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $code, 'joininglangs' => $joininglang])); ?>"
                                                        class="dropdown-item ms-1 <?php echo e($offerlangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($offerlangs)); ?>

                                                    </a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span
                                                            class="pull-end text-primary">{applicant_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Job title')); ?> : <span
                                                            class="pull-right text-primary">{job_title}</span></p>
                                                    <p class="col-4"><?php echo e(__('Job type')); ?> : <span
                                                            class="pull-right text-primary">{job_type}</span></p>
                                                    <p class="col-4"><?php echo e(__('Proposed Start Date')); ?> : <span
                                                            class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Working Location')); ?> : <span
                                                            class="pull-right text-primary">{workplace_location}</span>
                                                    </p>
                                                    <p class="col-4"><?php echo e(__('Days Of Week')); ?> : <span
                                                            class="pull-right text-primary">{days_of_week}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary')); ?> : <span
                                                            class="pull-right text-primary">{salary}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary Type')); ?> : <span
                                                            class="pull-right text-primary">{salary_type}</span></p>
                                                    <p class="col-4"><?php echo e(__('Salary Duration')); ?> : <span
                                                            class="pull-end text-primary">{salary_duration}</span></p>
                                                    <p class="col-4"><?php echo e(__('Offer Expiration Date')); ?> : <span
                                                            class="pull-right text-primary">{offer_expiration_date}</span>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">
                                <?php echo e(Form::open(['route' => ['offerlatter.update', $offerlang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple0 summernote-simple"><?php echo isset($currOfferletterLang->content) ? $currOfferletterLang->content : ''; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="joining-letter-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Joining Letter Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($joininglangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $joininglangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.joiningletter.language', ['noclangs' => $noclang, 'explangs' => $explang, 'offerlangs' => $offerlang, 'joininglangs' => $code])); ?>"
                                                        class="dropdown-item <?php echo e($joininglangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($joininglangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Applicant Name')); ?> : <span
                                                            class="pull-end text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                                            class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Address')); ?> : <span
                                                            class="pull-right text-primary">{address}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                                            class="pull-right text-primary">{designation}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span
                                                            class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span
                                                            class="pull-right text-primary">{branch}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span
                                                            class="pull-end text-primary">{start_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span
                                                            class="pull-right text-primary">{end_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span
                                                            class="pull-right text-primary">{total_hours}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['joiningletter.update', $joininglang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple1 summernote-simple"><?php echo isset($currjoiningletterLang->content) ? $currjoiningletterLang->content : ''; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>

                    </div>

                    <div id="experience-certificate-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('Experience Certificate Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($explangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $explangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.experiencecertificate.language', ['noclangs' => $noclang, 'explangs' => $code, 'offerlangs' => $offerlang, 'joininglangs' => $joininglang])); ?>"
                                                        class="dropdown-item <?php echo e($explangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucFirst($explangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>

                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>

                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                                            class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Date of Issuance')); ?> : <span
                                                            class="pull-right text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                                            class="pull-right text-primary">{designation}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Date')); ?> : <span
                                                            class="pull-right text-primary">{start_date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Branch')); ?> : <span
                                                            class="pull-right text-primary">{branch}</span></p>
                                                    <p class="col-4"><?php echo e(__('Start Time')); ?> : <span
                                                            class="pull-end text-primary">{start_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('End Time')); ?> : <span
                                                            class="pull-right text-primary">{end_time}</span></p>
                                                    <p class="col-4"><?php echo e(__('Number of Hours')); ?> : <span
                                                            class="pull-right text-primary">{total_hours}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">

                                <?php echo e(Form::open(['route' => ['experiencecertificate.update', $explang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple2 summernote-simple"><?php echo isset($curr_exp_cetificate_Lang->content) ? $curr_exp_cetificate_Lang->content : ''; ?></textarea>

                                </div>
                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>
                    </div>

                    <div id="noc-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header d-flex justify-content-between">
                                <h5><?php echo e(__('NOC Settings')); ?></h5>
                                <div class="d-flex justify-content-end drp-languages">
                                    <ul class="list-unstyled mb-0 m-2">
                                        <li class="dropdown dash-h-item drp-language" style="margin-top: -19px;">
                                            <a class="dash-head-link dropdown-toggle arrow-none me-0"
                                                data-bs-toggle="dropdown" href="#" role="button"
                                                aria-haspopup="false" aria-expanded="false" id="dropdownLanguage1">
                                                <span class="drp-text hide-mob text-primary me-2">
                                                    <?php echo e(ucfirst($noclangName->full_name)); ?>

                                                </span>
                                                <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                                            </a>
                                            <div class="dropdown-menu dash-h-dropdown dropdown-menu-end"
                                                aria-labelledby="dropdownLanguage1">
                                                <?php $__currentLoopData = $currantLang; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $noclangs): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <a href="<?php echo e(route('get.noc.language', ['noclangs' => $code, 'explangs' => $explang, 'offerlangs' => $offerlang, 'joininglangs' => $joininglang])); ?>"
                                                        class="dropdown-item <?php echo e($noclangs == $code ? 'text-primary' : ''); ?>"><?php echo e(ucfirst($noclangs)); ?></a>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </div>
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="card-body ">
                                <h5 class= "font-weight-bold pb-3"><?php echo e(__('Placeholders')); ?></h5>
                                <div class="col-lg-12 col-md-12 col-sm-12">
                                    <div class="card">
                                        <div class="card-header card-body">
                                            <div class="row text-xs">
                                                <div class="row">
                                                    <p class="col-4"><?php echo e(__('Date')); ?> : <span
                                                            class="pull-end text-primary">{date}</span></p>
                                                    <p class="col-4"><?php echo e(__('Company Name')); ?> : <span
                                                            class="pull-right text-primary">{app_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Employee Name')); ?> : <span
                                                            class="pull-right text-primary">{employee_name}</span></p>
                                                    <p class="col-4"><?php echo e(__('Designation')); ?> : <span
                                                            class="pull-right text-primary">{designation}</span></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body table-border-style ">
                                <?php echo e(Form::open(['route' => ['noc.update', $noclang], 'method' => 'post'])); ?>

                                <div class="form-group col-12">
                                    <?php echo e(Form::label('content', __(' Format'), ['class' => 'form-label text-dark'])); ?>

                                    <textarea name="content" class="summernote-simple3 summernote-simple"><?php echo isset($currnocLang->content) ? $currnocLang->content : ''; ?></textarea>

                                </div>

                                <?php echo e(Form::close()); ?>

                            </div>
                        </div>

                    </div>

                    <div class="" id="google-calender">
                        <div class="card">
                            <?php echo e(Form::open(['url' => route('google.calender.settings'), 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('Google Calendar Settings')); ?></h5>
                                    </div>
                                    <div class="col switch-width text-end">
                                        <div class="form-group mb-0">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" name="google_calendar_enable"
                                                    id="google_calendar_enable" data-toggle="switchbutton"
                                                    data-onstyle="primary"
                                                    <?php echo e($settings['google_calendar_enable'] == 'on' ? 'checked' : ''); ?>>
                                                <label class="custom-control-label"
                                                    for="google_calendar_enable"></label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar id', __('Google Calendar Id'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('google_clender_id', !empty($settings['google_clender_id']) ? $settings['google_clender_id'] : '', ['class' => 'form-control ', 'placeholder' => 'Google Calendar Id', 'required' => 'required'])); ?>

                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        <?php echo e(Form::label('Google calendar json file', __('Google Calendar json File'), ['class' => 'col-form-label'])); ?>

                                        <input type="file" class="form-control" name="google_calender_json_file"
                                            id="file">
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    <?php echo e(__('Save Changes')); ?>

                                </button>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    
                    <div id="seo-settings" class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h5><?php echo e(__('SEO Settings')); ?></h5>
                            <?php
                                $settings = \App\Models\Utility::settings();
                            ?>
                            <?php if(!empty($settings['chat_gpt_key'])): ?>
                                <div class="d-flex justify-content-end">
                                    <div class="mt-0">
                                        <a data-size="md" class="btn btn-primary text-white btn-sm"
                                            data-ajax-popup-over="true" data-url="<?php echo e(route('generate', ['seo'])); ?>"
                                            data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php echo e(Form::open(['url' => route('seo.settings.store'), 'method' => 'post', 'enctype' => 'multipart/form-data'])); ?>

                        <?php echo csrf_field(); ?>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <?php echo e(Form::label('Meta Keywords', __('Meta Keywords'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('meta_title', !empty($setting['meta_title']) ? $setting['meta_title'] : '', ['class' => 'form-control ', 'placeholder' => 'Meta Keywords'])); ?>

                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('Meta Description', __('Meta Description'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::textarea('meta_desc', !empty($setting['meta_desc']) ? $setting['meta_desc'] : '', ['class' => 'form-control ', 'placeholder' => 'Meta Description', 'rows' => 7])); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-0">
                                        <?php echo e(Form::label('Meta Image', __('Meta Image'), ['class' => 'col-form-label'])); ?>

                                    </div>
                                    <div class="setting-card">
                                        <div class="logo-content">
                                            <img id="image2"
                                                src="<?php echo e($meta_image . '/' . (isset($setting['meta_image']) && !empty($setting['meta_image']) ? $setting['meta_image'] : 'default.png')); ?>"
                                                class="img_setting seo_image">
                                        </div>
                                        <div class="choose-files mt-4">
                                            <label for="meta_image" class="col-form-label">
                                                <div class="bg-primary company_favicon_update"> <i
                                                        class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                </div>
                                                <input type="file" class="form-control file" id="meta_image"
                                                    name="meta_image" data-filename="meta_image">
                                            </label>
                                        </div>
                                        <?php $__errorArgs = ['meta_image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <div class="row">
                                                <span class="invalid-logo" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            </div>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    
                    <div id="webhook-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('Webhook Settings')); ?></h5>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create webhook')): ?>
                                        <div class="col-6 text-end">
                                            <a href="#" data-size="lg" data-url="<?php echo e(route('webhook.create')); ?>"
                                                data-ajax-popup="true" data-bs-toggle="tooltip"
                                                title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create New Webhook')); ?>"
                                                class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus"></i>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Module')); ?></th>
                                                <th><?php echo e(__('Url')); ?></th>
                                                <th><?php echo e(__('Method')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-style">
                                            <?php $__empty_1 = true; $__currentLoopData = $webhookSetting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $webhooksetting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e(ucwords($webhooksetting->module)); ?></td>
                                                    <td><?php echo e($webhooksetting->url); ?></td>
                                                    <td><?php echo e(ucwords($webhooksetting->method)); ?></td>
                                                    <td class="Action">
                                                        <span>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit webhook')): ?>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a href="#"
                                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-url="<?php echo e(URL::to('webhook-settings/' . $webhooksetting->id . '/edit')); ?>"
                                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Edit')); ?>"
                                                                        data-title="<?php echo e(__('Webhook Edit')); ?>">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete webhook')): ?>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open([
                                                                        'method' => 'DELETE',
                                                                        'route' => ['webhook.destroy', $webhooksetting->id],
                                                                        'id' => 'delete-form-' . $webhooksetting->id,
                                                                    ]); ?>

                                                                    <a href="#"
                                                                        class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                        data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Delete')); ?>">
                                                                        <i class="ti ti-trash text-white text-white"></i>
                                                                    </a>
                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr class="text-center">
                                                    <td colspan="4"><?php echo e(__('No Data Found.!')); ?></td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card" id="cookie-settings">
                        <?php echo e(Form::model($settings, ['route' => 'cookie.setting', 'method' => 'post'])); ?>

                        <div
                            class="card-header flex-column flex-lg-row d-flex align-items-lg-center gap-2 justify-content-between">
                            <h5><?php echo e(__('Cookie Settings')); ?></h5>
                            <div class="d-flex align-items-center">
                                <?php echo e(Form::label('enable_cookie', __('Enable cookie'), ['class' => 'col-form-label p-0 fw-bold me-3'])); ?>

                                <div class="custom-control custom-switch" onclick="enablecookie()">
                                    <input type="checkbox" data-toggle="switchbutton" data-onstyle="primary"
                                        name="enable_cookie" class="form-check-input input-primary "
                                        id="enable_cookie" <?php echo e($settings['enable_cookie'] == 'on' ? ' checked ' : ''); ?>>
                                    <label class="custom-control-label mb-1" for="enable_cookie"></label>
                                </div>

                            </div>
                        </div>
                        <div
                            class="card-body cookieDiv <?php echo e($settings['enable_cookie'] == 'off' ? 'disabledCookie ' : ''); ?>">
                            <?php
                                $settings = \App\Models\Utility::settings();
                            ?>
                            <div class="row text-end">
                                <?php if(!empty($settings['chat_gpt_key'])): ?>
                                    <div class="mt-0">
                                        <a data-size="md" class="btn btn-primary text-white btn-sm"
                                            data-ajax-popup-over="true" data-url="<?php echo e(route('generate', ['cookie'])); ?>"
                                            data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                                            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-check form-switch custom-switch-v1" id="cookie_log">
                                        <input type="checkbox" name="cookie_logging"
                                            class="form-check-input input-primary cookie_setting" id="cookie_logging"
                                            <?php echo e($settings['cookie_logging'] == 'on' ? ' checked ' : ''); ?>>
                                        <label class="form-check-label"
                                            for="cookie_logging"><?php echo e(__('Enable logging')); ?></label>
                                    </div>
                                    <div class="form-group">
                                        <?php echo e(Form::label('cookie_title', __('Cookie Title'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('cookie_title', null, ['class' => 'form-control cookie_setting'])); ?>

                                    </div>
                                    <div class="form-group ">
                                        <?php echo e(Form::label('cookie_description', __('Cookie Description'), ['class' => ' form-label'])); ?>

                                        <?php echo Form::textarea('cookie_description', null, ['class' => 'form-control cookie_setting', 'rows' => '3']); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-check form-switch custom-switch-v1 ">
                                        <input type="checkbox" name="necessary_cookies"
                                            class="form-check-input input-primary" id="necessary_cookies" checked
                                            onclick="return false">
                                        <label class="form-check-label"
                                            for="necessary_cookies"><?php echo e(__('Strictly necessary cookies')); ?></label>
                                    </div>
                                    <div class="form-group ">
                                        <?php echo e(Form::label('strictly_cookie_title', __(' Strictly Cookie Title'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('strictly_cookie_title', null, ['class' => 'form-control cookie_setting'])); ?>

                                    </div>
                                    <div class="form-group ">
                                        <?php echo e(Form::label('strictly_cookie_description', __('Strictly Cookie Description'), ['class' => ' form-label'])); ?>

                                        <?php echo Form::textarea('strictly_cookie_description', null, [
                                            'class' => 'form-control cookie_setting ',
                                            'rows' => '3',
                                        ]); ?>

                                    </div>
                                </div>

                                <div class="col-12">
                                    <h5><?php echo e(__('More Information')); ?></h5>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <?php echo e(Form::label('more_information_description', __('Contact Us Description'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('more_information_description', null, ['class' => 'form-control cookie_setting'])); ?>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group ">
                                        <?php echo e(Form::label('contactus_url', __('Contact Us URL'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('contactus_url', null, ['class' => 'form-control cookie_setting'])); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <?php if(isset($settings['cookie_logging']) && $settings['cookie_logging'] == 'on'): ?>
                                        <label for="file"
                                            class="form-label"><?php echo e(__('Download cookie accepted data')); ?></label>
                                        <a href="<?php echo e(asset(Storage::url('uploads/sample')) . '/data.csv'); ?>"
                                            class="btn btn-primary mr-3">
                                            <i class="ti ti-download"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                                <div class="col-6 text-end">
                                    <input class="btn btn-print-invoice  m-r-10 btn-primary cookie_btn" type="submit"
                                        value="<?php echo e(__('Save Changes')); ?>">

                                </div>
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    
                    <div class="card" id="cache-settings">
                        <div class="card-header">
                            <h5><?php echo e('Cache Settings'); ?></h5>
                            <small class="text-secondary font-weight-bold">
                                <?php echo e(__("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.")); ?>

                            </small>
                        </div>
                        <form method="POST" action="<?php echo e(route('cache.settings.store')); ?>" accept-charset="UTF-8">
                            <?php echo csrf_field(); ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 form-group">
                                        <?php echo e(Form::label('Current cache size', __('Current cache size'), ['class' => 'col-form-label'])); ?>

                                        <div class="input-group mb-5">
                                            <input type="text" class="form-control" value="<?php echo e($file_size); ?>"
                                                readonly>
                                            <div class="input-group-append">
                                                <span class="input-group-text"
                                                    id="basic-addon6"><?php echo e(__('MB')); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                    value="<?php echo e(__('Cache Clear')); ?>">
                            </div>
                            <?php echo e(Form::close()); ?>


                    </div>

                    
                    <div id="chat-gpt-settings" class="card">
                        <?php echo e(Form::model($settings, ['route' => 'chatgpt.settings', 'method' => 'post'])); ?>


                        <div class="card-header">
                            <div class="row">
                                <div class="col-6">
                                    <h5 class="mb-2"><?php echo e(__('Chat GPT Settings')); ?></h5>
                                </div>
                                <div class="col switch-width text-end">
                                    <div class="form-group mb-0">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="ai_chatgpt_enable" id="ai_chatgpt_enable"
                                                data-toggle="switchbutton" data-onstyle="primary"
                                                <?php echo e($settings['ai_chatgpt_enable'] == 'on' ? 'checked' : ''); ?> required>
                                            <label class="custom-control-label" for="ai_chatgpt_enable"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('chat_gpt_key', __('Chat GPT key'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('chat_gpt_key', isset($settings['chat_gpt_key']) ? $settings['chat_gpt_key'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Chat GPT API Key'), 'required' => 'required'])); ?>

                                </div>
                                <div class="form-group col-md-12">
                                    <?php echo e(Form::label('chat_gpt_model', __('Chat GPT Model Name'), ['class' => 'col-form-label'])); ?>

                                    <?php echo e(Form::text('chat_gpt_model', isset($settings['chat_gpt_model']) ? $settings['chat_gpt_model'] : '', ['class' => 'form-control', 'placeholder' => __('Enter Chat GPT Modal Name'), 'required' => 'required'])); ?>

                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                value="<?php echo e(__('Save Changes')); ?>">
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>

                    <div id="ip-restriction-settings" class="card">
                        <div class="col-md-12">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="mb-2"><?php echo e(__('IP Restriction Settings')); ?></h5>
                                    </div>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create webhook')): ?>
                                        <div class="col-6 text-end">
                                            <a data-size="md" data-url="<?php echo e(route('create.ip')); ?>" data-ajax-popup="true"
                                                data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>"
                                                data-title="<?php echo e(__('Create New IP')); ?>" class="btn btn-sm btn-primary">
                                                <i class="ti ti-plus text-white"></i>
                                            </a>

                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="w-75"><?php echo e(__('IP')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody class="font-style">
                                            <?php $__empty_1 = true; $__currentLoopData = $ips; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <tr>
                                                    <td><?php echo e($ip->ip); ?></td>

                                                    <td class="Action">
                                                        <span>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit webhook')): ?>
                                                                <div class="action-btn bg-primary ms-2">
                                                                    <a class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                                        data-url="<?php echo e(route('edit.ip', $ip->id)); ?>"
                                                                        data-ajax-popup="true" data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Edit')); ?>"
                                                                        data-title="<?php echo e(__('IP Edit')); ?>">
                                                                        <i class="ti ti-pencil text-white"></i>
                                                                    </a>
                                                                </div>
                                                            <?php endif; ?>
                                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete webhook')): ?>
                                                                <div class="action-btn bg-danger ms-2">
                                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['destroy.ip', $ip->id], 'id' => 'delete-form-' . $ip->id]); ?>

                                                                    <a class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                                        data-bs-toggle="tooltip"
                                                                        title="<?php echo e(__('Delete')); ?>">
                                                                        <i class="ti ti-trash text-white text-white"></i>
                                                                    </a>
                                                                    <?php echo Form::close(); ?>

                                                                </div>
                                                            <?php endif; ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <tr class="text-center">
                                                    <td colspan="4"><?php echo e(__('No Data Found.!')); ?></td>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Test Case\Aws-CI-CD-DevOps\ERP\resources\views/settings/company.blade.php ENDPATH**/ ?>