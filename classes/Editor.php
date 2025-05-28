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

namespace Markdown;

use Plib\Request;
use Plib\View;

class Editor
{
    private View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    /** @param list<string> $classes */
    public function init(array $classes, bool $config, Request $request): void
    {
        global $hjs, $bjs, $pth;
        $hjs .= $this->view->render("head", []);
        $bjs .= $this->view->render("editor", [
            "script" => $pth["folder"]["plugins"] . "markdown/markdown.js",
            "url" => $request->url()->path($pth["folder"]["base"])->with("filebrowser", "editorbrowser")
                ->with("editor", "markdown")->with("prefix", $pth["folder"]["base"])->with("type", "TYPE")->relative(),
        ]);
    }
}
