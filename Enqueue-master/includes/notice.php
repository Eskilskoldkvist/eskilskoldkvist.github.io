<?php
  if ($_SESSION["notice"]) {
    ?>
      <div class="top-notice">
        <p class="<?php if (isset($_SESSION["notice_type"])) {echo $_SESSION["notice_type"];} ?>"><b>Notis:</b> <?php echo $_SESSION["notice"]; ?></p>
        <span id="close-notice" class="close">stäng</span>
      </div>
    <?php
  }
  unset ($_SESSION["notice"]);
  unset ($_SESSION["notice_type"]);
?>

<script type="text/javascript" src="../assets/js/notice.js"></script>
