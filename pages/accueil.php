<?php
$today = date('Y-m-d');
$reqcoast = $bdd->prepare("SELECT * FROM coastes WHERE date = ?");
$reqcoast->execute(array($today));
$coast = $reqcoast->fetch();
?>
<div class="coast">
    <p class="coast"><?php echo $coast['name']; ?></p>
    <div id="buttons" class="buttons">
        <button class="coast cst citiz" id="coast" value="5" onClick="coast(5);">5</button>
        <button class="coast cst citiz" id="coast" value="10" onClick="coast(10);">10</button>
        <button class="coast cst citiz" id="coast" value="20" onClick="coast(20);">20</button>
        <form>
            <input type="number" style="" id="after" class="after cst" >
    </div>
</div>