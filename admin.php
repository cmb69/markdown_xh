<?php

/**
 * Copyright (c) Christoph M. Becker
 *
 * This file is part of Markdown_XH.
 *
 * Markdown_XH is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Markdown_XH is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Markdown_XH.  If not, see <http://www.gnu.org/licenses/>.
 */

use Markdown\Plugin;

if (!defined("CMSIMPLE_XH_VERSION")) {
    http_response_code(403);
    exit;
}

/**
 * @var string $admin
 * @var string $o
 */

XH_registerStandardPluginMenuItems(false);
if (XH_wantsPluginAdministration("markdown")) {
    $o .= print_plugin_admin("off");
    switch ($admin) {
        case "":
            $o .= Plugin::infoCommand()()();
            break;
        default:
            $o .= plugin_admin_common();
    }
}
