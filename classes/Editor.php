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
use Plib\Response;
use Plib\View;

class Editor
{
    private string $baseFolder;
    private string $pluginFolder;
    private View $view;
    private bool $included = false;

    public function __construct(string $baseFolder, string $pluginFolder, View $view)
    {
        $this->baseFolder = $baseFolder;
        $this->pluginFolder = $pluginFolder;
        $this->view = $view;
    }

    public function include(Request $request): Response
    {
        if ($this->included) {
            return Response::create();
        }
        $this->included = true;
        $hjs = $this->view->render("head", [
            "css" => $this->pluginFolder . "markdown/tiny-mde/tiny-mde.min.css",
            "script" => $this->pluginFolder . "markdown/tiny-mde/tiny-mde.min.js",
        ]);
        $bjs = $this->view->render("editor", [
            "script" => $this->pluginFolder . "markdown/markdown.js",
            "jsConf" => $this->jsConf($request),
        ]);
        return Response::create()->withHjs($hjs)->withBjs($bjs);
    }

    /** @return array<string,mixed> */
    private function jsConf(Request $request): array
    {
        return [
            "url" => $request->url()->path($this->baseFolder)->with("filebrowser", "editorbrowser")
                ->with("editor", "markdown")->with("prefix", $this->baseFolder)->with("type", "TYPE")->relative(),
            "insert_image" => $this->view->plain("label_insert_image"),
            "insert_link" => $this->view->plain("label_insert_link"),
        ];
    }

    /** @param list<string> $classes */
    public function init(array $classes, string $config, Request $request): Response
    {
        if (empty($classes)) {
            $classes = ["xh-editor"];
        }
        $json = json_encode($classes);
        $response = $this->include($request);
        return $response->withBjs($response->bjs() . "<script>markdown.initByClasses($json)</script>\n");
    }

    public function replace(string $id, string $config): string
    {
        $json = json_encode($id);
        return "markdown.initById($json)";
    }
}
