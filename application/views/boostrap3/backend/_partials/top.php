<!-- Static navbar -->
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!-- <a class="navbar-brand" href="#"></a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <?php
            // $navbar = [
            //     [
            //         'class' => '', 'icon' => 'glyphicon glyphicon-home', 'privilege_code' => 'backend_dashboard', 'text' => lang('menu_dashboard'), 'url' => 'backend/dashboard', 'url_external' => '',
            //     ],
            //     [
            //         'class' => '', 'icon' => 'glyphicon glyphicon-cog', 'privilege_code' => 'backend_settings', 'text' => lang('menu_settings'), 'url' => '#', 'url_external' => '',
            //         'child' => [
            //             ['class' => '', 'icon' => 'glyphicon glyphicon-eye-open', 'privilege_code' => 'backend_privileges', 'text' => lang('menu_privileges'), 'url' => 'backend/privileges', 'url_external' => ''],
            //             ['class' => '', 'icon' => 'glyphicon glyphicon-th-large', 'privilege_code' => 'backend_groups', 'text' => lang('menu_groups'), 'url' => 'backend/groups', 'url_external' => ''],
            //             ['class' => '', 'icon' => 'glyphicon glyphicon-user', 'privilege_code' => 'backend_users', 'text' => lang('menu_users'), 'url' => 'backend/users', 'url_external' => ''],
            //             ['class' => '', 'icon' => 'glyphicon glyphicon-th-list', 'privilege_code' => '', 'text' => lang('menu_menus'), 'url' => 'backend/menus', 'url_external' => ''],
            //         ],
            //     ],
            // ];
            ?>
            <ul class="nav navbar-nav">
                <?php
                foreach ((array) $backend_top as $row)
                {
                    if ($row['status'] == 0)
                        continue;

                    if ($this->j_acl->has_privilege($row['privilege_code'], NULL, FALSE) === FALSE)
                        continue;

                    if (empty($row['child']))
                    {
                        echo '<li>';
                        echo    '<a href="'.( ($row['url_external']) ? $row['url_external'] : site_url($row['url']) ).'">';
                        echo        '<i class="'.$row['icon'].'"></i> ';
                        echo        (lang($row['text_language']) ? lang($row['text_language']) : $row['text']);
                        echo    '</a>';
                        echo '</li>';
                    }
                    else
                    {
                        echo '<li class="dropdown">';
                        echo    '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">';
                        echo        '<i class="'.$row['icon'].'"></i> ';
                        echo        (lang($row['text_language']) ? lang($row['text_language']) : $row['text']);
                        echo        '<i class="caret"></i>';
                        echo    '</a>';
                        echo    '<ul class="dropdown-menu">';
                        foreach ((array) $row['child'] as $child)
                        {
                            if ($child['status'] == 0)
                                continue;

                            if ($this->j_acl->has_privilege($child['privilege_code'], NULL, FALSE) === FALSE)
                                continue;

                            echo '<li>';
                            echo    '<a href="'.( ($child['url_external']) ? $child['url_external'] : site_url($child['url']) ).'">';
                            echo        '<i class="'.$child['icon'].'"></i> ';
                            echo        (lang($child['text_language']) ? lang($child['text_language']) : $child['text']);
                            echo    '</a>';
                            echo '</li>';
                        }
                        echo    '</ul>';
                        echo '</li>';
                    }
                }
                ?>
            </ul><!--/.nav navbar-nav -->

            <?php
            $navbar_right = [
                [
                    'class' => '', 'icon' => 'glyphicon glyphicon-globe',
                    'text' => ucwords($this->session->userdata('site_language') ? $this->session->userdata('site_language') : $this->config->item('language')),
                    'url' => '#', 'url_external' => '',
                    'child' => [
                        ['class' => '', 'icon' => '', 'text' => 'English', 'url' => 'language/switch_language/english', 'url_external' => ''],
                        ['class' => '', 'icon' => '', 'text' => 'Indonesian', 'url' => 'language/switch_language/indonesian', 'url_external' => ''],
                    ],
                ],
                [
                    'class' => '', 'icon' => 'glyphicon glyphicon-user', 'text' => ($ion_auth_user->first_name.' '.$ion_auth_user->last_name), 'url' => '#', 'url_external' => '',
                    'child' => [
                        // ['class' => '', 'icon' => '', 'text' => 'Profile', 'url' => '#', 'url_external' => ''],
                        // ['class' => 'divider', 'icon' => '', 'text' => '', 'url' => '#', 'url_external' => ''],
                        ['class' => '', 'icon' => 'glyphicon glyphicon-off', 'text' => lang('sign_out'), 'url' => 'backend/admin/logout', 'url_external' => ''],
                    ],
                ],
            ];
            ?>
            <ul class="nav navbar-nav navbar-right">
                <?php
                foreach ((array) $navbar_right as $row)
                {
                    if (empty($row['child']))
                    {
                        echo '<li class="'.$row['class'].'">';
                        echo    '<a href="'.( ($row['url_external']) ? $row['url_external'] : site_url($row['url']) ).'">';
                        echo        '<i class="'.$row['icon'].'"></i> ';
                        echo        $row['text'];
                        echo    '</a>';
                        echo '</li>';
                    }
                    else
                    {
                        echo '<li class="dropdown">';
                        echo    '<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button">';
                        echo        '<i class="'.$row['icon'].'"></i> ';
                        echo        $row['text'].' <i class="caret"></i>';
                        echo    '</a>';
                        echo    '<ul class="dropdown-menu">';
                        foreach ((array) $row['child'] as $child)
                        {
                            echo '<li class="'.$child['class'].'">';
                            echo    '<a href="'.( ($child['url_external']) ? $child['url_external'] : site_url($child['url']) ).'">';
                            echo        '<i class="'.$child['icon'].'"></i> ';
                            echo        $child['text'];
                            echo    '</a>';
                            echo '</li>';
                        }
                        echo    '</ul>';
                        echo '</li>';
                    }
                }
                ?>
            </ul><!--/.nav navbar-nav navbar-right -->
        </div><!--/.nav-collapse -->
    </div>
</nav>