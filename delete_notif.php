<?php if(isset($_SESSION['delete'])){
    echo '<script>$(document).ready(function (){deleted();});</script>';
    unset($_SESSION['delete']);
    } ?>
<div class="alert alert-danger alert-autocloseable-danger" style=" position: fixed; top: 1em; right: 1em; z-index: 9999; display: none;">
     Deleted Successfully !
</div>