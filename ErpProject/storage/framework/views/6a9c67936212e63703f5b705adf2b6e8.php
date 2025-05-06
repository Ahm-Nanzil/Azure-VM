<?php $__env->startSection('page-title'); ?>
            <?php echo e(__('Manage Activity')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Activity')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-12">
        <?php
            $sectionsTask = [
                'Tasks of Leads' => [
                    'data' => $leadTask,
                    'routes' => 'leads',
                    'title' => __('Tasks of Leads'),
                ],
                'Tasks of Deals' => [
                    'data' => $dealTask,
                    'routes' => 'deals',
                    'title' => __('Task of Deals'),
                ],
                'Tasks of Customers' => [
                    'data' => $customerTask,
                    'routes' => 'customer',
                    'title' => __('Tasks of Customers'),
                ],
            ];
            $sectionsEmail = [
                'Emails of Leads' => [
                    'data' => $leadEmail,
                    'routes' => 'leads',
                    'title' => __('Emails of Leads'),
                ],
                'Emails of Deals' => [
                    'data' => $dealEmail,
                    'routes' => 'deals',
                    'title' => __('Task of Deals'),
                ],
                'Emails of Customers' => [
                    'data' => $customerEmail,
                    'routes' => 'customer',
                    'title' => __('Emails of Customers'),
                ],
            ];

            $sectionsCall = [
                'Calls of Leads' => [
                    'data' => $leadCall,
                    'routes' => 'leads',
                    'title' => __('Calls of Leads'),
                ],
                'Calls of Deals' => [
                    'data' => $dealCall,
                    'routes' => 'deals',
                    'title' => __('Call of Deals'),
                ],
                'Calls of Customers' => [
                    'data' => $customerCall,
                    'routes' => 'customer',
                    'title' => __('Calls of Customers'),
                ],
            ];
            $sectionsVisit = [
                'Visits of Leads' => [
                    'data' => $leadVisit,
                    'routes' => 'leads',
                    'title' => __('Visits of Leads'),
                ],
                'Visits of Deals' => [
                    'data' => $dealVisit,
                    'routes' => 'deals',
                    'title' => __('Visit of Deals'),
                ],
                'Visits of Customers' => [
                    'data' => $customerVisit,
                    'routes' => 'customer',
                    'title' => __('Visits of Customers'),
                ],
            ];
            $sectionsMeeting = [
                'Meetings of Leads' => [
                    'data' => $leadMeeting,
                    'routes' => 'leads',
                    'title' => __('Meetings of Leads'),
                ],
                'Meetings of Deals' => [
                    'data' => $dealMeeting,
                    'routes' => 'deals',
                    'title' => __('Meeting of Deals'),
                ],
                'Meetings of Customers' => [
                    'data' => $customerMeeting,
                    'routes' => 'customer',
                    'title' => __('Meetings of Customers'),
                ],
            ];

            $sectionLeadDealCustomer = [
                'Leads' => [
                    'data' => $leads,
                    'routes' => 'leads',
                    'title' => __('Lead'),
                ],
                'Deals' => [
                    'data' => $deals,
                    'routes' => 'deals',
                    'title' => __('Deal'),
                ],
                'Customers' => [
                    'data' => $customers,
                    'routes' => 'customer',
                    'title' => __('Customer'),
                ],
            ];

        ?>

        <!-- Tabs for Task, Email, Call, Visit, Meeting -->
        <ul class="nav nav-tabs" id="tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="task-tab" data-bs-toggle="tab" href="#task" role="tab" aria-controls="task" aria-selected="true"><?php echo e(__('Task')); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="email-tab" data-bs-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false"><?php echo e(__('Email')); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="call-tab" data-bs-toggle="tab" href="#call" role="tab" aria-controls="call" aria-selected="false"><?php echo e(__('Call')); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="visit-tab" data-bs-toggle="tab" href="#visit" role="tab" aria-controls="visit" aria-selected="false"><?php echo e(__('Visit')); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="meeting-tab" data-bs-toggle="tab" href="#meeting" role="tab" aria-controls="meeting" aria-selected="false"><?php echo e(__('Meeting')); ?></a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="leaddealcustomer-tab" data-bs-toggle="tab" href="#leaddealcustomer" role="tab" aria-controls="leaddealcustomer" aria-selected="false"><?php echo e(__('Recent Lead/Deal/Customers')); ?></a>
            </li>
        </ul>

        <!-- Tab Content -->
        <div class="tab-content" id="tabContent">
            <!-- Task Tab: Show Leads, Deals, and Customers -->
            <div class="tab-pane fade show active" id="task" role="tabpanel" aria-labelledby="task-tab">
                <div class="row kanban-wrapper horizontal-scroll-cards">
                    <?php $__currentLoopData = $sectionsTask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionName => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        
                                        <span class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($section['data'])); ?>

                                        </span>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($sectionName); ?></h4>
                                </div>
                                <div class="card-body kanban-box">
                                    <?php $__currentLoopData = $section['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($item->id); ?>">
                                            <div class="card-header border-0 pb-0">
                                                <h5>
                                                    <a href="">
                                                        <?php echo e($item->name); ?>

                                                    </a>
                                                </h5>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="" class="dropdown-item">
                                                                <i class="ti ti-eye"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>
                                                            <a href="#"
                                                                data-url="<?php echo e(route(
                                                                        $section['routes'] . '.tasks.edit',
                                                                        [
                                                                            'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                            'tid' => $item->id
                                                                        ]
                                                                    )); ?>"
                                                                data-ajax-popup="true"
                                                                class="dropdown-item"
                                                                data-title="<?php echo e(__('Edit ' . $section['title'])); ?>">
                                                                <i class="ti ti-pencil"></i>
                                                                <span><?php echo e(__('Edit')); ?></span>
                                                                </a>

                                                            <?php echo Form::open(['method' => 'DELETE',

                                                            'route' => [
                                                                $section['routes'] . '.tasks.destroy',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'tid' => $item->id
                                                                    ]

                                                            ],


                                                            'id' => 'delete-form-' . $item->id]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-trash"></i>
                                                                <span><?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Email Tab: Show Email Data -->
            <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                <!-- Display Email Data Here -->

                <div class="row kanban-wrapper horizontal-scroll-cards">
                    <?php $__currentLoopData = $sectionsEmail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionName => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        
                                        <span class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($section['data'])); ?>

                                        </span>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($sectionName); ?></h4>
                                </div>
                                <div class="card-body kanban-box">
                                    <?php $__currentLoopData = $section['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($item->id); ?>">
                                            <div class="card-header border-0 pb-0">
                                                <h5>
                                                    <a href="">
                                                        <?php echo e($item->subject); ?>

                                                    </a>
                                                </h5>
                                                <div class="card-header-right">
                                                    
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Call Tab: Show Call Data -->
            <div class="tab-pane fade" id="call" role="tabpanel" aria-labelledby="call-tab">
                <!-- Display Call Data Here -->

                <div class="row kanban-wrapper horizontal-scroll-cards">
                    <?php $__currentLoopData = $sectionsCall; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionName => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        
                                        <span class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($section['data'])); ?>

                                        </span>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($sectionName); ?></h4>
                                </div>
                                <div class="card-body kanban-box">
                                    <?php $__currentLoopData = $section['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($item->id); ?>">
                                            <div class="card-header border-0 pb-0">
                                                <h5>
                                                    <a href="">
                                                        <?php echo e($item->subject); ?>

                                                    </a>
                                                </h5>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="" class="dropdown-item">
                                                                <i class="ti ti-eye"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>
                                                            <a href="#"
                                                            data-url="<?php echo e(route(
                                                                    $section['routes'] . '.calls.edit',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'cid' => $item->id
                                                                    ]
                                                                )); ?>"
                                                            data-ajax-popup="true"
                                                            class="dropdown-item"
                                                            data-title="<?php echo e(__('Edit ' . $section['title'])); ?>">
                                                            <i class="ti ti-pencil"></i>
                                                            <span><?php echo e(__('Edit')); ?></span>
                                                            </a>

                                                            <?php echo Form::open(['method' => 'DELETE',
                                                            'route' => [
                                                                $section['routes'] . '.calls.destroy',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'cid' => $item->id
                                                                    ]
                                                            ],

                                                            'id' => 'delete-form-' . $item->id]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-trash"></i>
                                                                <span><?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Visit Tab: Show Visit Data -->
            <div class="tab-pane fade" id="visit" role="tabpanel" aria-labelledby="visit-tab">
                <!-- Display Visit Data Here -->

                <div class="row kanban-wrapper horizontal-scroll-cards">
                    <?php $__currentLoopData = $sectionsVisit; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionName => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        
                                        <span class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($section['data'])); ?>

                                        </span>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($sectionName); ?></h4>
                                </div>
                                <div class="card-body kanban-box">
                                    <?php $__currentLoopData = $section['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($item->id); ?>">
                                            <div class="card-header border-0 pb-0">
                                                <h5>
                                                    <a href="">
                                                        <?php echo e($item->title); ?>

                                                    </a>
                                                </h5>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="" class="dropdown-item">
                                                                <i class="ti ti-eye"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>
                                                            <a href="#"
                                                            data-url="<?php echo e(route(
                                                                    $section['routes'] . '.visit.edit',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'vid' => $item->id
                                                                    ]
                                                                )); ?>"
                                                            data-ajax-popup="true"
                                                            class="dropdown-item"
                                                            data-title="<?php echo e(__('Edit ' . $section['title'])); ?>">
                                                            <i class="ti ti-pencil"></i>
                                                            <span><?php echo e(__('Edit')); ?></span>
                                                            </a>

                                                            <?php echo Form::open(['method' => 'DELETE',
                                                            'route' => [
                                                                $section['routes'] . '.visit.destroy',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'vid' => $item->id
                                                                    ]
                                                            ],

                                                            'id' => 'delete-form-' . $item->id]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-trash"></i>
                                                                <span><?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Meeting Tab: Show Meeting Data -->
            <div class="tab-pane fade" id="meeting" role="tabpanel" aria-labelledby="meeting-tab">
                <!-- Display Meeting Data Here -->

                <div class="row kanban-wrapper horizontal-scroll-cards">
                    <?php $__currentLoopData = $sectionsMeeting; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionName => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        
                                        <span class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($section['data'])); ?>

                                        </span>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($sectionName); ?></h4>
                                </div>
                                <div class="card-body kanban-box">
                                    <?php $__currentLoopData = $section['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($item->id); ?>">
                                            <div class="card-header border-0 pb-0">
                                                <h5>
                                                    <a href="">
                                                        <?php echo e($item->title); ?>

                                                    </a>
                                                </h5>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="" class="dropdown-item">
                                                                <i class="ti ti-eye"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>
                                                            <a href="#"
                                                            data-url="<?php echo e(route(
                                                                    $section['routes'] . '.meeting.edit',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'mid' => $item->id
                                                                    ]
                                                                )); ?>"
                                                            data-ajax-popup="true"
                                                            class="dropdown-item"
                                                            data-title="<?php echo e(__('Edit ' . $section['title'])); ?>">
                                                            <i class="ti ti-pencil"></i>
                                                            <span><?php echo e(__('Edit')); ?></span>
                                                            </a>

                                                            <?php echo Form::open(['method' => 'DELETE',
                                                            'route' => [
                                                                $section['routes'] . '.meeting.destroy',
                                                                    [
                                                                        'id' => $item->{$section['routes'] === 'leads' ? 'lead_id' : ($section['routes'] === 'deals' ? 'deal_id' : 'customer_id')},
                                                                        'mid' => $item->id
                                                                    ]
                                                            ],

                                                            'id' => 'delete-form-' . $item->id]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-trash"></i>
                                                                <span><?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <div class="tab-pane fade" id="leaddealcustomer" role="tabpanel" aria-labelledby="leaddealcustomer-tab">

                <div class="row kanban-wrapper horizontal-scroll-cards">
                    <?php $__currentLoopData = $sectionLeadDealCustomer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sectionName => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col">
                            <div class="card">
                                <div class="card-header">
                                    <div class="float-end">
                                        <a href="#" data-size="lg" data-url="<?php echo e(route($section['routes'] . '.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-title="<?php echo e(__('Create ' . $section['title'])); ?>" class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                        <span class="btn btn-sm btn-primary btn-icon count">
                                            <?php echo e(count($section['data'])); ?>

                                        </span>
                                    </div>
                                    <h4 class="mb-0"><?php echo e($sectionName); ?></h4>
                                </div>
                                <div class="card-body kanban-box">
                                    <?php $__currentLoopData = $section['data']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="card" data-id="<?php echo e($item->id); ?>">
                                            <div class="card-header border-0 pb-0">
                                                <h5>
                                                    <a href="">
                                                        <?php echo e($item->name); ?>

                                                    </a>
                                                </h5>
                                                <div class="card-header-right">
                                                    <div class="btn-group card-option">
                                                        <button type="button" class="btn dropdown-toggle"
                                                                data-bs-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="false">
                                                            <i class="ti ti-dots-vertical"></i>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a href="<?php echo e(route($section['routes'] . '.show', $section['routes'] === 'customer' ? \Crypt::encrypt($item->id) : $item->id)); ?>" class="dropdown-item">
                                                                <i class="ti ti-eye"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>

                                                            <a href="#" data-url="<?php echo e(route($section['routes'] . '.edit', $item->id)); ?>" data-ajax-popup="true" class="dropdown-item" data-title="<?php echo e(__('Edit ' . $section['title'])); ?>">
                                                                <i class="ti ti-pencil"></i>
                                                                <span><?php echo e(__('Edit')); ?></span>
                                                            </a>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => [$section['routes'] . '.destroy', $item->id], 'id' => 'delete-form-' . $item->id]); ?>

                                                            <a href="#" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-trash"></i>
                                                                <span><?php echo e(__('Delete')); ?></span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <p><strong><?php echo e(__('Email:')); ?></strong> <?php echo e($item->emails()->count()); ?></p>
                                                <p><strong><?php echo e(__('Task:')); ?></strong> <?php echo e($item->tasks()->count()); ?></p>
                                                <p><strong><?php echo e(__('Call:')); ?></strong> <?php echo e($item->calls()->count()); ?></p>
                                                <p><strong><?php echo e(__('Meeting:')); ?></strong> <?php echo e($item->meetings()->count()); ?></p>
                                                <p><strong><?php echo e(__('Visit:')); ?></strong> <?php echo e($item->visits()->count()); ?></p>
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
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Soudi\ERPNBS\erpnbs\resources\views/activities/index.blade.php ENDPATH**/ ?>