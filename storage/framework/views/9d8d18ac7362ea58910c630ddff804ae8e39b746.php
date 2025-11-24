<div style="background-color: #ececec;width: 100%;font-family: 'Fira Sans', Helvetica, Arial, sans-serif;">
    <table style="background-color: #fff; width: 550px;margin: 0 auto;">
        <thead>
            <tr>
                <th style="text-align: center;">
                    <div style="text-align: center;">
                        <a href="<?php echo e(url('/')); ?>" class="bravo-logo">
                            <?php
                            $logo_id = setting_item("logo_id");
                            if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                            }
                            ?>
                            <?php if($logo_id): ?>
                            <?php $logo = get_file_url($logo_id, 'full'); ?>
                            <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item('site_title')); ?>">
                            <?php endif; ?>
                        </a>
                    </div>
                </th>
            </tr>

            <tr>
                <th style="border-bottom: 10px solid #ececec;">
                    <div style="margin: 30px 0 20px;">
                        <span style="font-size: 20px;font-weight: 400;color: #ffaa34;">
                            <?php echo e(__('Olá! tudo bem?')); ?>

                        </span>
                    </div>

                    <div style="padding: 0 30px;">
                        <p style="font-size: 16px;color:#666;">
                            <?php echo e(__('Sua conta foi criada com sucesso em nossa plataforma.')); ?>

                        </p>
                    </div>
                </th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">

                    <div style="text-align: center;">
                        <?php if(!empty($avatar)): ?>
                        <img src="<?php echo e($avatar); ?>" alt="Avatar" style="width:100px;height:100px;border-radius:50%;object-fit:cover;margin-bottom:15px;">
                        <?php endif; ?>

                        <p style="font-size: 15px; color:#555; line-height: 1.5;">
                            <?php echo e(__('Agora você faz parte da nossa comunidade. Estamos muito felizes em ter você com a gente!')); ?>

                        </p>
                    </div>

                    <div style="text-align: center;margin: 30px 0 20px;">
                        <a style="background: #50a6fb;color: #fff;text-decoration: none;padding: 16px 34px;border-radius: 10px;display: inline-block;"
                            href="<?php echo e(url('/')); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo e(__('Ver cadastro do usuário →')); ?>

                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;border-bottom: 10px solid #ececec;">
                    <div>
                        <h1 style="text-align: center;font-weight: 800;"><?php echo e(__('Acompanhe o RedeTBC')); ?></h1>
                    </div>

                    <div style="margin: 21px 0;">
                        <p style="color: gray;font-size: 1.1rem;line-height: 1.5; text-align:center;">
                            <?php echo e(__('Siga nossas redes sociais para novidades, dicas e conteúdos exclusivos!')); ?> <br><br>
                            <a href="https://instagram.com/sua_conta" target="_blank">Instagram</a> •
                            <a href="https://facebook.com/sua_conta" target="_blank">Facebook</a>
                        </p>
                    </div>
                </td>
            </tr>
        </tbody>

        <tfoot>
            <tr>
                <td style="padding: 30px 0;border-bottom: 10px solid #ececec;">
                    <div style="text-align: center;">
                        <a href="<?php echo e(url('/')); ?>" class="bravo-logo">
                            <?php
                            $logo_id = setting_item("logo_id");
                            if(!empty($row->custom_logo)){
                            $logo_id = $row->custom_logo;
                            }
                            ?>
                            <?php if($logo_id): ?>
                            <?php $logo = get_file_url($logo_id, 'full'); ?>
                            <img src="<?php echo e($logo); ?>" alt="<?php echo e(setting_item('site_title')); ?>">
                            <?php endif; ?>
                        </a>
                    </div>

                    <div style="text-align: center;margin-top: 40px;border-top: 4px solid #ececec;padding-top: 35px;">
                        <a style="color: #0076ff;margin: 0 15px;" href="<?php echo e(url('/user/dashboard')); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo e(__('Acessar minha conta')); ?>

                        </a>
                        <a style="color: #0076ff;margin: 0 15px;" href="<?php echo e(url('page/noticias')); ?>" target="_blank" rel="noopener noreferrer">
                            <?php echo e(__('Novidades e dicas')); ?>

                        </a>
                    </div>
                </td>
            </tr>

            <tr>
                <td style="padding: 30px;text-align: center;color: gray;">
                    <p style="margin: 10px 0 5px;"><?php echo e(__('O maior portal nacional de aluguel de temporada do Brasil.')); ?></p>
                    <span><?php echo e(__('Servindo milhões de viajantes e anunciantes desde 2025.')); ?></span>
                </td>
            </tr>
        </tfoot>
    </table>
</div><?php /**PATH D:\wamp64\www\CompanyMarket\PROGRESSO\redetbc\modules/User/Views/emails/registered.blade.php ENDPATH**/ ?>