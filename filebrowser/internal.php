<?php

/**
 * Editorhook for internal filebrowser -> Markdown_XH
 */

$script = <<<EOS
<script>
function setLink(url) {
    window.parent.setLink(url);
}
</script>
EOS;
