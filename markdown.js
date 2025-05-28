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

markdown.currentEditor = null;
markdown.selection1 = null;
markdown.selection2 = null;
markdown.type = null;

markdown.dialog = document.querySelector("dialog.markdown_modal");
markdown.dialog.querySelector("button").onclick = event => {
    event.currentTarget.parentElement.parentElement.close();
};

markdown.init_tinyMDE = function () {
    const textarea = document.querySelector('.xh-editor');
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
                    markdown.currentEditor = editor;
                    markdown.selection1 = editor.getSelection(true);
                    markdown.selection2 = editor.getSelection();
                    markdown.type = "link";
                    markdown.browse("downloads");
                }
            },
            {
                name: 'insertImage', 
                action: editor => {
                    markdown.currentEditor = editor;
                    markdown.selection1 = editor.getSelection(true);
                    markdown.selection2 = editor.getSelection();
                    markdown.type = "image";
                    markdown.browse("images");
                }
            },
        ],
    });
};

markdown.browse = function (type) {
    const dialog = document.querySelector("dialog.markdown_modal");
    const iframe = dialog.querySelector("iframe");
    const url = dialog.dataset.url;
    iframe.src = url.replace(/TYPE$/, type);
    dialog.showModal();
    const buttons = dialog.querySelector(".markdown_buttons");
    iframe.width = dialog.clientWidth - 10;
    iframe.height = dialog.clientHeight - buttons.clientHeight - 10;
};

markdown.setLink = function (url) {
    if (markdown.selection1 && markdown.selection2) {
        markdown.currentEditor.setSelection(markdown.selection2, markdown.selection1);
        markdown.selection1 = markdown.selection2 = undefined;
    }
    if (markdown.type === "link") {
        markdown.currentEditor.wrapSelection('[', `](${url})`);
    } else if (markdown.type === "image") {
        markdown.currentEditor.wrapSelection('![', `](${url})`);
    }
    markdown.currentEditor.fireChange();
    markdown.dialog.close();
    markdown.dialog.querySelector("iframe").src = "about:blank";
};
