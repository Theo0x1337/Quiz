

$(document).ready(function() {
    var data = <?php echo json_encode($_SESSION['questions']); ?>;
    console.log(data);

});