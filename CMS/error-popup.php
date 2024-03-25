
<div class="modal fade" class="cms-error" tabindex="-1" style="top:10%; display:block;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit-label">Error!</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <?php
                echo "<p id='message'>" . $_SESSION["message"]["text"] . "</p>";
            ?>
            </div>
            <div class="modal-footer">
                <form action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="get">
                    <button class="btn btn-danger" data-bs-dismiss="modal" name="ok">OK!</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_GET['ok'])){
    unset($_SESSION["message"]);
}
?>