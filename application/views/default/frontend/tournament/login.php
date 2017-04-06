<div class="content row">
    <div class="row text-center">
        <?php echo img(['src' => base_url('assets/Garena_slice/REGISTER/LOGIN/login_title.png')]); ?>
    </div>

    <?php echo form_open('', ['class' => 'form-horizontal', 'style' => 'padding: 10px;']); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('username').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('username', set_value('username'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, length',
                        'data-validation-length' => '6-15',
                        'placeholder' => lang('username'),
                    ]); ?>
                    <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('password').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_password('password', set_value('password'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, length',
                        'data-validation-length' => '8-16',
                        'placeholder' => lang('password'),
                    ]); ?>
                    <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-9">
                    *
                    <?php echo lang('not_have_account').' '.lang('please_register'); ?>.
                    <?php echo anchor('tournament/register', lang('here')); ?>
                </div>
                <div class="col-md-3">
                    <?php echo form_submit('login', lang('login'), ['class' => 'btn btn-block btn-danger']); ?>
                    <?php
                     // echo form_button(
                    //     'login',
                    //     img([
                    //         'class' => 'pull-right',
                    //         'src' => base_url('assets/Garena_slice/REGISTER/LOGIN/login_button_normal.png'),
                    //     ]),
                    //     ['type' => 'submit']
                    // );
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>

<script>
$(document).ready(function() {
    $.validate();
});
</script>