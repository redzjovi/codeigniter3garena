<div class="content" style="background-image: url('../assets/Garena_slice/REGISTER/REGISTRASI_BERHASIL/bg.png');">
    <div class="text-right">
        <?php echo lang('hi').', '.$user_detail->full_name.' [ '.
            anchor('tournament/logout', lang('logout'))
            .' ]'; ?>
    </div>

    <div class="row text-center">
        <?php echo img(['src' => base_url('assets/Garena_slice/REGISTER/REGISTRASI_BERHASIL/registrasi_berhasil_title.png')]); ?>
    </div>

    <div class="row">
        <br />
        <p class="text-center">Terima kasih telah mendaftar di Turnamen Garena 3 vs 3!</p>
        <p class="text-center">
            Untuk info lebih lanjut, kunjungi Forum Garena Indonesian
            <?php echo anchor('https://www.garena.co.id/', lang('here')); ?>.
        </p>
        <p class="text-center">Garena, Connecting World Gamers!</p>
    </div>
</div>

<div class="row text-center">
    <?php echo anchor('tournament/logout', img([
        'src' => base_url('assets/Garena_slice/REGISTER/REGISTRASI_BERHASIL/registrasi_button_normal.png')
    ])); ?>
</div>