function blockJobseeker(js_id) {
    $(document).ready(function(){
        $.post("block_js.php",{id:js_id}, function(data,status) {
            if(status=='success' && data=='blocked') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Jobseeker blocked successfully.");
            } else if(status=='success' && data=='unblocked') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Jobseeker unblocked successfully.");
            } else {
                $('#modalTitle').text("Failure");
                $('#modalBody').text("Could not perform operation.");
                $('#error').html(data);
            }
            $('#modalButton').click();
        });
    });
}

$(document).ready(function(){
    $('#closeModal').click(function(){
        window.location='viewjobseekers.php';
    });
});