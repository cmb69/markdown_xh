<?php

use Plib\View;

if (!defined("CMSIMPLE_XH_VERSION")) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $script
 */
?>

<script src="<?=$this->esc($script)?>"></script>
<dialog class="markdown_modal">
  <p class="markdown_buttons">
    <button type="button" onclick='this.parentElement.parentElement.close()'>close</button>
  </p>
  <div>
    <iframe src="about:blank"></iframe>
  <div>
</dialog>
