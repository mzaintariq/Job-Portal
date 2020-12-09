function blockJobPost(job_id) {
    $(document).ready(function(){
        $.post("block_job.php",{id:job_id}, function(data,status) {
            if(status=='success' && data=='blocked') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Job Post blocked successfully.");
            } else if(status=='success' && data=='unblocked') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Job Post unblocked successfully.");
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
        window.location='viewjobposts.php';
    });
});