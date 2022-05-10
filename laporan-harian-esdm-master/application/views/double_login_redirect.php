<!DOCTYPE html>
<html>
<body>
<?php if(isset($is_double_login)): ?>
Please wait...
<?php endif; ?>
<script>
<?php
// Redirect if double login, for AJAX request
if(isset($is_double_login)):
    $base_window_url = base_url("Beranda/double_login?do");
    ?>
    window.location.href = "<?=$base_window_url?>";
<?php endif; ?>
</script>
</body>
</html>