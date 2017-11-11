<?php
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-success">
  <button
      type="button"
      class="close"
      data-dismiss="alert"
      aria-hidden="true"
      onclick="this.classList.add('hidden');">×
  </button>
    <?= $message ?>
</div>