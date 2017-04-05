<div class="content">
    <h4 class="text-center"><?php echo $page_title; ?></h4>

    <?php echo form_open('', ['class' => 'form-horizontal', 'style' => 'padding: 10px;']); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('username').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('username', set_value('username'), ['autofocus' => '', 'class' => 'form-control', 'placeholder' => lang('username')]); ?>
                    <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('password').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_password('password', set_value('password'), ['class' => 'form-control', 'placeholder' => lang('password')]); ?>
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
                </div>
            </div>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>