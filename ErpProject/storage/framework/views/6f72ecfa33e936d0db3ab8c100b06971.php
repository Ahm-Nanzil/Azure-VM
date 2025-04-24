<?php if(isset($task)): ?>
    <?php echo e(Form::model($task, array('route' => array('deals.tasks.update', $deal->id, $task->id), 'method' => 'PUT','class' => 'modalForm'))); ?>

<?php else: ?>
    <?php echo e(Form::open(array('route' => ['deals.tasks.store',$deal->id],'class' => 'modalForm'))); ?>

<?php endif; ?>
<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?>

            <?php echo e(Form::text('name', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('date', __('Date'),['class'=>'form-label'])); ?>

            <?php echo e(Form::date('date', null, array('class' => 'form-control','required'=>'required','min' => \Carbon\Carbon::today()->toDateString()))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('time', __('Time'),['class'=>'form-label'])); ?>

            <?php echo e(Form::time('time', null, array('class' => 'form-control','required'=>'required'))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('priority', __('Priority'),['class'=>'form-label'])); ?>

            <select class="form-control select2" name="priority" required id="choices-multiple1">
                <?php $__currentLoopData = $priorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php if(isset($task) && $task->priority == $key): ?> selected <?php endif; ?>><?php echo e(__($priority)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

            <select class="form-control select2" name="status" id="choices-multiple2" required>
                <?php $__currentLoopData = $status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($key); ?>" <?php if(isset($task) && $task->status == $key): ?> selected <?php endif; ?>><?php echo e(__($st)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-6 form-group">
            <label for="recurrence-toggle" class="form-label">
                <input type="checkbox" id="recurrence-toggle"> <?php echo e(__('Enable Recurrence')); ?>

            </label>
        </div>
        <input type="hidden" id="recurrence-status-hidden" name="recurrence_status" value="0">

        <div id="recurrence-fields" style="display: none;">

            <div class="col-12 form-group">
                <?php echo e(Form::label('recurrence', __('Recurrence'), ['class'=>'form-label'])); ?>

                <select class="form-control select2" name="recurrence" id="recurrence-dropdown" required>
                    <?php $__currentLoopData = $recurrances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $recurrance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php if(isset($view) && $view->recurrance == $key): ?> selected <?php endif; ?>>
                            <?php echo e(__($recurrance)); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="col-12 form-group">
                <?php echo e(Form::label('repeat_interval', __('Repeat Interval'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::number('repeat_interval', null, ['class' => 'form-control', 'min' => 1])); ?>

            </div>

            <div class="col-12 form-group">
                <?php echo e(Form::label('end_recurrence', __('End Recurrence'), ['class'=>'form-label'])); ?>

                <?php echo e(Form::date('end_recurrence', null, ['class' => 'form-control','min' => \Carbon\Carbon::today()->toDateString()])); ?>

            </div>

            <div class="col-12 form-group">
                <?php echo e(Form::label('reminder', __('Reminder'),['class'=>'form-label'])); ?>

                <?php echo e(Form::time('reminder', null, array('class' => 'form-control'))); ?>

            </div>
        </div>
        <script>
            $(document).on('change', '#recurrence-toggle', function () {
                const recurrenceFields = $('#recurrence-fields');
                const hiddenInput = $('#recurrence-status-hidden');

                if ($(this).is(':checked')) {
                    recurrenceFields.show();
                    hiddenInput.val('1');
                } else {
                    recurrenceFields.hide();
                    hiddenInput.val('0');
                }
            });


        </script>
        <div class="col-6 form-group">
            <?php echo e(Form::label('assigned_users', __('Assigned Users'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('assigned_users[]', $assignedUsers, null, ['class' => 'form-control select2', 'multiple' => '', 'id' => 'assigned-users-select', 'required' => 'required'])); ?>


        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-light" data-bs-dismiss="modal">
    <?php if(isset($task)): ?>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
    <?php else: ?>
        <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
    <?php endif; ?>

</div>
<?php echo e(Form::close()); ?>



<script>
    $('#date').daterangepicker({
        locale: {format: 'YYYY-MM-DD'},
        singleDatePicker: true,
    });
    $("#time").timepicker({
        icons: {
            up: 'ti ti-chevron-up',
            down: 'ti ti-chevron-down'
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/deals/tasks.blade.php ENDPATH**/ ?>