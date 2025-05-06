<?php echo e(Form::model($deal, array('route' => array('deals.basicinfo.update', $deal->id), 'method' => 'PUT','class' => 'modalForm'))); ?>

<div class="modal-body">
    
    <?php
        $settings = \App\Models\Utility::settings();
    ?>
    <?php if($settings['ai_chatgpt_enable'] == 'on'): ?>
        <div class="text-end">
            <a href="#" data-size="md" class="btn btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['deal'])); ?>"
               data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
                <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
            </a>
        </div>
    <?php endif; ?>
    

    <fieldset>
        <legend><?php echo e(__('Deal Basic Info')); ?></legend>
        <div class="row">
            <!-- Lead Owner -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('lead_owner', __('Deal Owner'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::select('lead_owner', $users, null, array('class' => 'form-control select', 'required' => 'required'))); ?>

            </div>

            <!-- Company Website -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_website', __('Company Website'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('company_website', null, array('class' => 'form-control', 'placeholder' => __('www.domain.com')))); ?>

            </div>

            <!-- Company/Entity Name -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_entity_name', __('Company / Entity Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('company_entity_name', null, array('class' => 'form-control', 'placeholder' => __('Enter Company / Entity Name')))); ?>

            </div>

            <!-- Company/Entity Logo with Preview -->
            <div class="col-12 form-group">
                <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="<?php echo e(__('Recommended size 32x32')); ?>"></i>
                <?php echo e(Form::label('company_entity_logo', __('Company / Entity Logo'), ['class' => 'form-label'])); ?>


                <?php if($deal->company_entity_logo ): ?>
                    <div class="my-2">
                        <img src="<?php echo e(asset('storage/app/public/' . $deal->company_entity_logo)); ?>" alt="<?php echo e(__('Company Logo')); ?>" class="img-thumbnail" style="width: 32px; height: 32px;">
                    </div>
                <?php endif; ?>

                <?php echo e(Form::file('company_entity_logo', ['class' => 'form-control', 'placeholder' => __('Enter Company / Entity Logo')])); ?>

            </div>

            <!-- Company Phone LL1 -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_phone_ll1', __('Company Phone LL1'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('company_phone_ll1', null, array('class' => 'form-control', 'placeholder' => __('+966-11-1234567')))); ?>

            </div>

            <!-- Company Phone LL2 -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_phone_ll2', __('Company Phone LL2'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('company_phone_ll2', null, array('class' => 'form-control', 'placeholder' => __('+966-11-1234567')))); ?>

            </div>

            <!-- Company Email -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_email', __('Company Email'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::email('company_email', null, array('class' => 'form-control', 'placeholder' => __('name@domain.com')))); ?>

            </div>

            <!-- Address1 -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('address1', __('Address1'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('address1', null, array('class' => 'form-control', 'placeholder' => __('Enter Address1')))); ?>

            </div>

            <!-- Address2 -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('address2', __('Address2'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('address2', null, array('class' => 'form-control', 'placeholder' => __('Enter Address2')))); ?>

            </div>

            <!-- City -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('city', __('City'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('city', null, array('class' => 'form-control', 'placeholder' => __('Enter City')))); ?>

            </div>

            <!-- Region/State -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('region', __('Region/State'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('region', null, array('class' => 'form-control', 'placeholder' => __('Enter Region/State')))); ?>

            </div>

            <!-- Country -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('country', __('Country'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('country', null, array('class' => 'form-control', 'placeholder' => __('Enter Country')))); ?>

            </div>

            <!-- Zip Code -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('zip_code', __('Zip Code'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('zip_code', null, array('class' => 'form-control', 'placeholder' => __('Enter Zip Code')))); ?>

            </div>

            <!-- Company LinkedIn -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_linkedin', __('Company LinkedIn'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::url('company_linkedin', null, array('class' => 'form-control', 'placeholder' => __('Enter LinkedIn URL')))); ?>

            </div>

            <!-- Company Location -->
            <div class="col-12 form-group">
                <?php echo e(Form::label('company_location', __('Company Location'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('company_location', null, array('class' => 'form-control', 'placeholder' => __('Enter Location URL')))); ?>

            </div>
        </div>
    </fieldset>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn btn-primary">
</div>

<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/deals/basicinfo-edit.blade.php ENDPATH**/ ?>