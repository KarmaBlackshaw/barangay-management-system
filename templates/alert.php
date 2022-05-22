<?php if (isset($_SESSION['message']) && isset($_SESSION['status'])) :?>

<div class="alert alert-<?= $_SESSION['status']; ?>
  <?= $_SESSION['status'] == 'danger' ? 'bg-danger text-light' : null ?>" role="alert">
  <?= $_SESSION['message']; ?>
</div>

<?php
  unset($_SESSION['message']);
  unset($_SESSION['status']);
endif;
?>
