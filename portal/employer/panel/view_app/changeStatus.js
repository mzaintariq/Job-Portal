function changeStatus(job_id) {
    $(document).ready(function(){
        $.post("change_status.php",{id:job_id}, function(data,status) {
            if(status=='success' && data=='status changed to active') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Job status changed successfully.");
            } else if(status=='success' && data=='status changed to inactive') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Job status changed successfully.");
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
        window.location='index.php';
    });
});