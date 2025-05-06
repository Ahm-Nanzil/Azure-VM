<?php echo e(Form::open(['url' => 'vender', 'method' => 'post'])); ?>

<div class="modal-body">
    <ul class="nav nav-tabs" id="vendorTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="basic-info-tab" data-bs-toggle="tab" href="#basic-info" role="tab">Basic Info</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="billing-shipping-tab" data-bs-toggle="tab" href="#billing-shipping" role="tab">Billing & Shipping</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="return-policy-tab" data-bs-toggle="tab" href="#return-policy" role="tab">Return Policy</a>
        </li>
    </ul>

    <div class="tab-content" id="vendorTabsContent">
        <!-- Basic Info Tab -->
        <div class="tab-pane fade show active" id="basic-info" role="tabpanel">
            
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('name', __('Name'))); ?>

                        <?php echo e(Form::text('name', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Name')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('contact', __('Contact'))); ?>

                        <?php echo e(Form::number('contact', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Contact')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('email', __('Email'))); ?>

                        <?php echo e(Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Email')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('vendor_detail', __('Vendor Detail'))); ?>

                        <?php echo e(Form::text('vendor_detail', null, ['class' => 'form-control', 'placeholder' => __('Enter Vendor Detail')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('custom_fields', __('Custom Fields'))); ?>

                        <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('vendor_code', __('Vendor Code'))); ?>

                        <?php echo e(Form::text('vendor_code', null, ['class' => 'form-control', 'placeholder' => __('Enter Vendor Code')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('company', __('Company'))); ?>

                        <?php echo e(Form::text('company', null, ['class' => 'form-control', 'placeholder' => __('Enter Company')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('balance', __('Balance'))); ?>

                        <?php echo e(Form::text('balance', null, ['class' => 'form-control', 'placeholder' => __('Enter Balance')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('vat_number', __('VAT Number'))); ?>

                        <?php echo e(Form::text('vat_number', null, ['class' => 'form-control', 'placeholder' => __('Enter VAT Number')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('phone', __('Phone'))); ?>

                        <?php echo e(Form::text('phone', null, ['class' => 'form-control', 'placeholder' => __('Enter Phone')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('website', __('Website'))); ?>

                        <?php echo e(Form::text('website', null, ['class' => 'form-control', 'placeholder' => __('Enter Website')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('currency', __('Currency'))); ?>

                        <?php echo e(Form::text('currency', null, ['class' => 'form-control', 'placeholder' => __('Enter Currency')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('default_language', __('Default Language'))); ?>

                        <?php echo e(Form::text('default_language', null, ['class' => 'form-control', 'placeholder' => __('Enter Default Language')])); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('address', __('Address'))); ?>

                        <?php echo e(Form::textarea('address', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Enter Address')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('city', __('City'))); ?>

                        <?php echo e(Form::text('city', null, ['class' => 'form-control', 'placeholder' => __('Enter City')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('state', __('State'))); ?>

                        <?php echo e(Form::text('state', null, ['class' => 'form-control', 'placeholder' => __('Enter State')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('zip_code', __('Zip Code'))); ?>

                        <?php echo e(Form::text('zip_code', null, ['class' => 'form-control', 'placeholder' => __('Enter Zip Code')])); ?>

                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('country', __('Country'))); ?>

                        <?php echo e(Form::text('country', null, ['class' => 'form-control', 'placeholder' => __('Enter Country')])); ?>

                    </div>
                </div>
            </div>
        </div>


        <!-- Billing & Shipping Tab -->
        <div class="tab-pane fade" id="billing-shipping" role="tabpanel">
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_name',__('Name'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('billing_name',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Name')))); ?>


                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_phone',__('Phone'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('billing_phone',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Phone')))); ?>


                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_address',__('Address'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::textarea('billing_address',null,array('class'=>'form-control','rows'=>3 , 'placeholder'=>__('Enter Address')))); ?>

                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_city',__('City'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('billing_city',null,array('class'=>'form-control' , 'placeholder'=>__('Enter City')))); ?>

                    </div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_state',__('State'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('billing_state',null,array('class'=>'form-control' , 'placeholder'=>_('Enter State')))); ?>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_country',__('Country'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('billing_country',null,array('class'=>'form-control' , 'placeholder'=> __('Enter Country')))); ?>


                    </div>
                </div>


                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('billing_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

                        <?php echo e(Form::text('billing_zip',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Zip Code')))); ?>


                    </div>
                </div>

            </div>
            <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
        <div class="col-md-12 text-end">
            <input type="button" id="billing_data" value="<?php echo e(__('Shipping Same As Billing')); ?>" class="btn btn-primary">
        </div>
        <h6 class="sub-title"><?php echo e(__('Shipping Address')); ?></h6>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_name',__('Name'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_name',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Name')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_phone',__('Phone'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_phone',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Phone')))); ?>


                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_address',__('Address'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::textarea('shipping_address',null,array('class'=>'form-control','rows'=>3 , 'placeholder'=>__('Enter Address')))); ?>

                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_city',__('City'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_city',null,array('class'=>'form-control' , 'placeholder'=>__('Enter City')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_state',__('State'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_state',null,array('class'=>'form-control' , 'placeholder'=>__('Enter State')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_country',__('Country'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_country',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Country')))); ?>


                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_zip',__('Zip Code'),array('class'=>'form-label' ))); ?>

                    <?php echo e(Form::text('shipping_zip',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Zip Code')))); ?>

                </div>
            </div>

        </div>
    <?php endif; ?>
        </div>

        <!-- Return Policy Tab -->
        <div class="tab-pane fade" id="return-policy" role="tabpanel">
            
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('return_days', __('Return Request Must Be Placed Within X Days'))); ?>

                        <?php echo e(Form::number('return_days', null, ['class' => 'form-control', 'placeholder' => __('Enter Number of Days')])); ?>

                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="form-group">
                        <?php echo e(Form::label('return_fee', __('Fee for Return Order'))); ?>

                        <?php echo e(Form::text('return_fee', null, ['class' => 'form-control', 'placeholder' => __('Enter Return Fee')])); ?>

                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <?php echo e(Form::label('return_policy_info', __('Return Policies Information'))); ?>

                        <?php echo e(Form::textarea('return_policy_info', null, ['class' => 'form-control', 'rows' => 3, 'placeholder' => __('Enter Return Policies Information')])); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal"><?php echo e(__('Cancel')); ?></button>
    <button type="submit" class="btn btn-primary"><?php echo e(__('Create')); ?></button>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/vender/create.blade.php ENDPATH**/ ?>