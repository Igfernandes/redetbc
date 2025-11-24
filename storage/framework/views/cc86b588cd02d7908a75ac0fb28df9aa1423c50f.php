<?php

$user = Auth::user();

[$notifications, $countUnread] = getNotify();



$languages = \Modules\Language\Models\Language::getActive();

$locale = App::getLocale();

$theme = \Modules\Theme\ThemeManager::currentProvider();

?>



<div class="header-logo flex-shrink-0">

    <h3 class="logo-text">

        <img border="0" src="https://www.agencianaweb.com.br/www.agencianaweb.com.br-painel-white.png" width="50%">

    </h3>

</div>

<div class="header-widgets d-flex flex-grow-1">

    <div class="widgets-left d-flex flex-grow-1 align-items-center">

        <div class="header-widget">

            <span class="btn-toggle-admin-menu btn btn-sm btn-link"><i class="icon ion-ios-menu"></i></span>

        </div>

        <div class="header-widget search-widget">

            

            <a href="<?php echo e(url('/')); ?>" class="btn btn-link" target="_blank"><i class="fa fa-eye"></i> <span translate="no"><?php echo e(__('Home')); ?> </span>

            </a>

        </div>

    </div>

    <div class="widgets-right flex-shrink-0 d-flex">

        <div class="dropdown header-widget widget-user pt-2 dropdown-notifications flex-shrink-0" style="min-width: 0">

            <div data-toggle="dropdown" class="user-dropdown d-flex align-items-center" aria-haspopup="true" aria-expanded="false">

                <i class="fa fa-lg fa-bell m-1 p-1"></i>

                <span class="badge badge-danger notification-icon"><?php echo e($countUnread > 10 ? "+9" : $countUnread); ?></span>

            </div>

            <div class="dropdown-menu overflow-auto notify-items dropdown-container dropdown-menu-right dropdown-large" aria-labelledby="dropdownMenuButton">

                <div class="dropdown-toolbar">

                    <div class="dropdown-toolbar-actions">

                        <a href="#" class="markAllAsRead"><?php echo e(__('Marcar todos como lido')); ?></a>

                    </div>

                    <h3 class="dropdown-toolbar-title"><?php echo e(__('Notificações')); ?> (<span class="notif-count"><?php echo e($countUnread); ?></span>)</h3>

                </div>

                <ul class="dropdown-list-items p-0 m-0">

                    <?php if(count($notifications)> 0): ?>

                    <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $oneNotification): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <?php

                    $active = $class = '';

                    $data = json_decode($oneNotification['data']);



                    $idNotification = @$data->id;

                    $forAdmin = @$data->for_admin;

                    $usingData = @$data->notification;



                    $services = @$usingData->type;

                    $idServices = @$usingData->id;

                    $title = @$usingData->message;

                    $name = @$usingData->name;

                    $avatar = @$usingData->avatar;

                    $link = @$usingData->link;



                    if(empty($oneNotification->read_at)){

                    $class = 'markAsRead';

                    $active = 'active';

                    }



                    ?>

                    <li class="notification <?php echo e($active); ?>">

                        <a class="<?php echo e($class); ?>" data-id="<?php echo e($idNotification); ?>" href="<?php echo e($link); ?>">

                            <div class="media">

                                <div class="media-left">

                                    <div class="media-object">

                                        <?php if($avatar): ?>

                                        <img class="image-responsive" src="<?php echo e($avatar); ?>" alt="<?php echo e($name); ?>">

                                        <?php else: ?>

                                        <span class="avatar-text"><?php echo e(ucfirst($name[0])); ?></span>

                                        <?php endif; ?>

                                    </div>

                                </div>

                                <div class="media-body">

                                    <?php echo $title; ?>


                                    <div class="notification-meta">

                                        <small class="timestamp"><?php echo e(format_interval($oneNotification->created_at)); ?></small>

                                    </div>

                                </div>

                            </div>

                        </a>

                    </li>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php endif; ?>

                </ul>

                <div class="dropdown-footer text-center">

                    <a href="<?php echo e(route('core.admin.notification.loadNotify')); ?>"><?php echo e(__('Ver Mais')); ?></a>

                </div>

            </div>

        </div>

        <div class="dropdown header-widget widget-user flex-shrink-0">

            <div data-toggle="dropdown" class="user-dropdown d-flex align-items-center" aria-haspopup="true" aria-expanded="false">

                <span class="user-avatar flex-shrink-0">

                    <?php if($avatar_url = $user->getAvatarUrl()): ?>

                    <div class="avatar avatar-cover" style="background-image: url('<?php echo e($user->getAvatarUrl()); ?>')"></div>

                    <?php else: ?>

                    <span class="avatar-text"><?php echo e(ucfirst($user->getDisplayName()[0])); ?></span>

                    <?php endif; ?>

                </span>

                <div class="user-info flex-grow-1">

                    <div class="user-name"><?php echo e($user->getDisplayName()); ?></div>

                    <div class="user-role"><?php echo e(ucfirst($user->role->name ?? '')); ?></div>

                </div>

                <i class="fa fa-angle-down"></i>

            </div>

            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                <a class="dropdown-item" href="<?php echo e(route('user.admin.detail',['id'=>$user->id])); ?>"><?php echo e(__('Editar Profile')); ?></a>

                <a class="dropdown-item" href="<?php echo e(route('user.admin.password',['id'=>$user->id])); ?>"><?php echo e(__('Alterar Senha')); ?></a>

                <div class="dropdown-divider"></div>

                <h6 class="dropdown-header"><?php echo e(__("Fornecedor Dashboard")); ?></h6>

                <a href="<?php echo e(route('vendor.dashboard')); ?>" class="dropdown-item"><?php echo e(__("Dashboard")); ?></a>

                <div class="dropdown-divider"></div>

                <a href="<?php echo e(url('/')); ?>" class="dropdown-item"><i class="fa fa-home"></i> <?php echo e(__("Homepage")); ?></a>

                <div class="dropdown-divider"></div>

                <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-sign-out"></i> <?php echo e(__('Sair')); ?>


                </a>

            </div>

            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">

                <?php echo e(csrf_field()); ?>


            </form>

        </div>

    </div>

</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/Layout/admin/parts/header.blade.php ENDPATH**/ ?>