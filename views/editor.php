<?php

use Plib\View;

if (!defined("CMSIMPLE_XH_VERSION")) {http_response_code(403); exit;}

/**
 * @var View $this
 * @var string $script
 * @var array<string,mixed> $jsConf
 */
?>

<dialog class="markdown_modal" data-conf='<?=$this->json($jsConf)?>'>
  <p class="markdown_buttons">
    <span class="markdown_caption"></span>
    <button type="button"><?=$this->text("label_close")?></button>
  </p>
  <div>
    <iframe src="about:blank"></iframe>
  <div>
</dialog>
<script src="<?=$this->esc($script)?>"></script>
