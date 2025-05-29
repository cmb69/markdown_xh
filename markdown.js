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

var markdown = {};

markdown.current = {
    editor: null,
    selection1: null,
    selection2: null,
    type: null,
};

markdown.dialog = document.querySelector("dialog.markdown_modal");
markdown.dialog.querySelector("button").onclick = () => {
    markdown.dialog.close();
};

markdown.initByClasses = function (classnames) {
    for (classname of classnames) {
        document.querySelectorAll("." + classname).forEach(markdown.init);
    }
};

markdown.initById = function (id) {
    markdown.init(document.getElementById(id));
}

markdown.init = function (textarea) {
    const button = document.createElement('button');
    button.textContent = "Save";
    textarea.form.appendChild(button);
    const toolbar = document.createElement("div");
    textarea.before(toolbar);
    const element = document.createElement("div");
    element.style.height = textarea.style.height;
    element.style["overflow-y"] = "scroll";
    element.style.border = "1px solid #ccc";
    textarea.before(element);
    const tinyMDE = new TinyMDE.Editor({
        textarea: textarea,
        element: element
    });
    var commandBar = new TinyMDE.CommandBar({
        element: toolbar,
        editor: tinyMDE,
        commands: [
            'bold',
            'italic',
            'strikethrough',
            '|',
            'code',
            '|',
            'h1', 'h2',
            '|',
            'ul', 'ol',
            '|',
            'blockquote',
            'hr',
            '|',
            {
                name: 'insertLink', 
                action: editor => {
                    markdown.current.editor = editor;
                    markdown.current.selection1 = editor.getSelection(true);
                    markdown.current.selection2 = editor.getSelection();
                    markdown.current.type = "link";
                    markdown.browse("downloads");
                }
            },
            {
                name: 'insertImage', 
                action: editor => {
                    markdown.current.editor = editor;
                    markdown.current.selection1 = editor.getSelection(true);
                    markdown.current.selection2 = editor.getSelection();
                    markdown.current.type = "image";
                    markdown.browse("images");
                }
            },
        ],
    });
};

markdown.browse = function (type) {
    const iframe = markdown.dialog.querySelector("iframe");
    const url = markdown.dialog.dataset.url;
    iframe.src = url.replace(/TYPE$/, type);
    markdown.dialog.showModal();
    const buttons = markdown.dialog.querySelector(".markdown_buttons");
    iframe.width = markdown.dialog.clientWidth - 10;
    iframe.height = markdown.dialog.clientHeight - buttons.clientHeight - 10;
};

markdown.setLink = function (url) {
    if (markdown.current.selection1 && markdown.current.selection2) {
        markdown.current.editor.setSelection(markdown.current.selection2, markdown.current.selection1);
        markdown.current.selection1 = markdown.current.selection2 = undefined;
    }
    if (markdown.current.type === "link") {
        markdown.current.editor.wrapSelection('[', `](${url})`);
    } else if (markdown.current.type === "image") {
        markdown.current.editor.wrapSelection('![', `](${url})`);
    }
    markdown.current.editor.fireChange();
    markdown.dialog.close();
    markdown.dialog.querySelector("iframe").src = "about:blank";
};
