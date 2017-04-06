<div class="content">
    <div class="text-right">
        <?php echo lang('hi').', '.$user_detail->full_name.' [ '.
            anchor('tournament/logout', lang('logout'))
            .' ]'; ?>
    </div>

    <div class="row text-center">
        <?php echo img(['src' => base_url('assets/Garena_slice/REGISTER/FORM_REGISTRASI/form_registration_title.png')]); ?>
    </div>

    <?php echo form_open('', ['class' => 'form-horizontal', 'style' => 'padding: 10px;']); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('team_name').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('team_name', set_value('team_name'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, alpha_numeric_dash, length',
                        'data-validation-length' => '4-15',
                        'placeholder' => lang('team_name'),
                    ]); ?>
                    <?php echo form_error('team_name', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('full_name').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('full_name[0]', set_value('full_name[0]', $user_detail->full_name), [
                        'class' => 'form-control',
                        'data-validation' => 'required, alpha_space',
                        'placeholder' => lang('full_name'),
                    ]); ?>
                    <?php echo form_error('full_name[0]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('phone_number').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('phone_number[0]', set_value('phone_number[0]', $user_detail->phone_number), [
                        'class' => 'form-control',
                        'data-validation' => 'required, number, length',
                        'data-validation-length' => '7-14',
                        'placeholder' => lang('phone_number'),
                    ]); ?>
                    <?php echo form_error('phone_number[0]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('gender').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_dropdown(
                        'gender[0]',
                        $this->User_Detail_Model->getGender(),
                        set_value('gender[0]', '1'),
                        ['class' => 'form-control', 'placeholder' => lang('gender')]
                    ); ?>
                    <?php echo form_error('gender[0]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3 text-right"><?php echo lang('captain'); ?></div>
            </div>
        </div>

        <div class="col-md-12">
            <hr />
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('full_name').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('full_name[1]', set_value('full_name[1]'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, alpha_space',
                        'placeholder' => lang('full_name'),
                    ]); ?>
                    <?php echo form_error('full_name[1]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('phone_number').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('phone_number[1]', set_value('phone_number[1]'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, number, length',
                        'data-validation-length' => '7-14',
                        'placeholder' => lang('phone_number'),
                    ]); ?>
                    <?php echo form_error('phone_number[1]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('gender').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_dropdown(
                        'gender[1]',
                        $this->User_Detail_Model->getGender(),
                        set_value('gender[1]', '1'),
                        ['class' => 'form-control', 'placeholder' => lang('gender')]
                    ); ?>
                    <?php echo form_error('gender[1]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3 text-right"><?php echo lang('member'); ?> 1</div>
            </div>
        </div>

        <div class="col-md-12">
            <hr />
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('full_name').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('full_name[2]', set_value('full_name[2]'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, alpha_space',
                        'placeholder' => lang('full_name'),
                    ]); ?>
                    <?php echo form_error('full_name[2]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('phone_number').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_input('phone_number[2]', set_value('phone_number[2]'), [
                        'class' => 'form-control',
                        'data-validation' => 'required, number, length',
                        'data-validation-length' => '7-14',
                        'placeholder' => lang('phone_number'),
                    ]); ?>
                    <?php echo form_error('phone_number[2]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3"></div>
            </div>

            <div class="form-group">
                <div class="col-md-3">
                    <?php echo form_label(lang('gender').' *'); ?>
                </div>
                <div class="col-md-6">
                    <?php echo form_dropdown(
                        'gender[2]',
                        $this->User_Detail_Model->getGender(),
                        set_value('gender[2]', '1'),
                        ['class' => 'form-control', 'placeholder' => lang('gender')]
                    ); ?>
                    <?php echo form_error('gender[2]', '<p class="text-danger">', '</p>'); ?>
                </div>
                <div class="col-md-3 text-right"><?php echo lang('member'); ?> 2</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <?php echo form_checkbox('agreement', '1', set_value('agreement'), [
                'data-validation' => 'required',
            ]); ?>
            Saya telah membaca dan menerima
            <?php echo anchor('#', lang('terms_and_regulations'), ['data-target' => '#myModal', 'data-toggle' => 'modal', 'role' => 'button']); ?>
            dari Garena.
            <?php echo form_error('agreement', '<p class="text-danger">', '</p>'); ?>

            <div id="myModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title text-center"><?php echo lang('terms_and_regulations'); ?></h4>
                        </div>
                        <div class="modal-body">
                            What is Lorem Ipsum?
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.

                            Why do we use it?
                            It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).


                            Where does it come from?
                            Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                            The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.
                        </div>
                        <div class="modal-footer"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?php echo form_submit('register', lang('register'), ['class' => 'btn btn-block btn-danger']); ?>
        </div>
    </div>

    <?php echo form_close(); ?>
</div>

<script>
$(document).ready(function() {
    $.formUtils.addValidator({
        name : 'alpha_numeric_dash',
            validatorFunction : function(value, $el, config, language, $form) {
            return /^([-a-z0-9_])+$/i.test(value);
        },
        errorMessage : 'The input value may only contain alpha-numeric characters, and dashes',
    });
    $.formUtils.addValidator({
        name : 'alpha_space',
            validatorFunction : function(value, $el, config, language, $form) {
            return /^([-a-z ])+$/i.test(value);
        },
        errorMessage : 'The input value may only contain alpha characters, and spaces.',
    });

    $.validate();
});
</script>