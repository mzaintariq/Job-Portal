function resign(job_id) {
    $(document).ready(function(){
        $.post('resign.php',{job_id:job_id},function(data,status) {
            if(status=='success' && data=='done') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("You have submitted your resignation. When the employer responds, you will be notified.");
            } else {
                $('#modalTitle').text("Failure");
                $('#modalBody').text("Could not submit resignation. " + data);
            }
            $('#modalButton').click();
        });
    });
}