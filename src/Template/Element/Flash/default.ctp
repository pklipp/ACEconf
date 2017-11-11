<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div class="alert alert-default <?= h($class) ?>">
  <button
      type="button"
      class="close"
      data-dismiss="alert"
      aria-hidden="true"
      onclick="this.classList.add('hidden');">×
  </button>
    <?= $message ?>
</div>