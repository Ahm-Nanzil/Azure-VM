<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Forgot Password')); ?>

<?php $__env->stopSection(); ?>

<?php
    $settings = Utility::settings();
?>

<?php $__env->startPush('custom-scripts'); ?>
<?php if($settings['recaptcha_module'] == 'on'): ?>
        <?php echo NoCaptcha::renderJs(); ?>

    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php if($settings['cust_darklayout'] == 'on'): ?>
    <style>
        .g-recaptcha {
            filter: invert(1) hue-rotate(180deg) !important;
        }
    </style>
<?php endif; ?>

<?php
    $languages = App\Models\Utility::languages();
?>


<?php $__env->startSection('content'); ?>
<div class="card-body">
    <div class="">
        <h2 class="mb-3 f-w-600"><?php echo e(__('Forgot Password')); ?></h2>
        <?php if(session('status')): ?>
        <div class="alert alert-primary">
            <?php echo e(session('status')); ?>

        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
    <div class="alert alert-danger">
        <?php echo e(session('error')); ?>

    </div>
<?php endif; ?>
    </div>

    <form method="POST" action="<?php echo e(route('password.email')); ?>">
        <?php echo csrf_field(); ?>
        <div class="">
            <div class="form-group mb-3">
                <label for="email" class="form-label"><?php echo e(__('E-Mail')); ?></label>
                <input id="email" type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="email" value="<?php echo e(old('email')); ?>" required autocomplete="email" autofocus placeholder="<?php echo e(__('Enter Email')); ?>">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="invalid-feedback" role="alert">
                    <small><?php echo e($message); ?></small>
                </span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <?php if($settings['recaptcha_module'] == 'on'): ?>
                <div class="form-group mb-3">
                    <?php echo NoCaptcha::display(); ?>

                    <?php $__errorArgs = ['g-recaptcha-response'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="small text-danger" role="alert">
                            <strong><?php echo e($message); ?></strong>
                        </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            <?php endif; ?>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary btn-block mt-2"><?php echo e(__('Send Password Reset Link')); ?></button>
            </div>
            <p class="my-4 text-center"><?php echo e(__("Back to")); ?> <a href="<?php echo e(route('login' , $lang)); ?>" class="text-primary"><?php echo e(__('Login')); ?></a></p>

        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Test Case\Aws-CI-CD-DevOps\ERP\resources\views/auth/forgot-password.blade.php ENDPATH**/ ?>