<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <?php if ( ! empty ($message)) : ?>
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>

            <div class="account-wall">
                <h1 class="text-center login-title"><?php echo lang('sign_in'); ?></h1>
                <?php echo form_open('', ['class' => 'form-signin']); ?>

                <?php echo form_input('email', set_value('email', 'superadmin@superadmin.com'), ['autofocus' => '', 'class' => 'form-control', 'placeholder' => lang('email')]); ?>
                <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>

                <?php echo form_password('password', set_value('password', 'password'), ['class' => 'form-control', 'placeholder' => lang('password')]); ?>
                <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>

                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo lang('sign_in'); ?></button>
                <label class="checkbox pull-left">
                    <?php echo form_checkbox('remember_me', '1', set_checkbox('remember_me', '1', TRUE)); ?>
                    <?php echo lang('remember_me'); ?>
                </label>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>