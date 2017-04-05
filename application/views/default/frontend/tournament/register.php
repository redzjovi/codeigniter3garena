<div class="content">
    <h4 class="text-center"><?php echo $page_title; ?></h4>

    <?php echo form_open('', ['class' => 'form-horizontal', 'style' => 'padding: 10px;']); ?>

    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('username').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_input('username', set_value('username'), ['autofocus' => '', 'class' => 'form-control', 'placeholder' => lang('username')]); ?>
                    <?php echo form_error('username', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('password').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_password('password', set_value('password'), ['class' => 'form-control', 'placeholder' => lang('password')]); ?>
                    <?php echo form_error('password', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('full_name').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_input('full_name', set_value('full_name'), ['autofocus' => '', 'class' => 'form-control', 'placeholder' => lang('full_name')]); ?>
                    <?php echo form_error('full_name', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('email').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_input('email', set_value('email'), ['class' => 'form-control', 'placeholder' => lang('email')]); ?>
                    <?php echo form_error('email', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('phone_number').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_input('phone_number', set_value('phone_number'), ['class' => 'form-control', 'placeholder' => lang('phone_number')]); ?>
                    <?php echo form_error('phone_number', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('gender').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_dropdown(
                        'gender',
                        $this->User_Detail_Model->getGender(),
                        set_value('gender', '1'),
                        ['class' => 'form-control', 'placeholder' => lang('gender')]
                    ); ?>
                    <?php echo form_error('gender', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('address').' *'); ?>
                </div>
                <div class="col-md-9">
                    <?php echo form_textarea('address', set_value('address'), ['class' => 'form-control', 'placeholder' => lang('address')]); ?>
                    <?php echo form_error('address', '<p class="text-danger">', '</p>'); ?>
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-3"></div>
                <div class="col-md-9">
                    <?php echo form_checkbox('agree'); ?>
                    Saya telah membaca dan menerima Syarat dan Peraturan dari turnamen ini.
                </div>
            </div>
        </div>

        <div class="col-md-4"></div>
    </div>

    <div class="row">
        <div class="col-md-8"></div>
        <div class="col-md-4">
            <button class="btn btn-block btn-danger" type="submit"><?php echo lang('register'); ?></button>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>