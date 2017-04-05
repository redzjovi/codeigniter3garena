<div class="content">
    <div class="text-right">
        <?php echo lang('hi').', '.$user->first_name.' [ '.
            anchor('tournament/logout', lang('logout'))
            .' ]'; ?>
    </div>

    <h4 class="text-center"><?php echo $page_title; ?></h4>
    <p class="text-center">Terima kasih telah mendaftar di Turnamen Garena 3 vs 3!</p>
    <p class="text-center">
        Untuk info lebih lanjut, kunjungi Forum Garena Indonesian
        <?php echo anchor('https://www.garena.co.id/', lang('here')); ?>.
    </p>
    <p class="text-center">Garena, Connecting World Gamers!</p>
</div>