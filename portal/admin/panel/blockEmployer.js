function blockEmployer(emp_id) {
    $(document).ready(function(){
        $.post("block_emp.php",{id:emp_id}, function(data,status) {
            if(status=='success' && data=='blocked') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Employer blocked successfully.");
            } else if(status=='success' && data=='unblocked') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Employer unblocked successfully.");
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
        window.location='viewemployers.php';
    });
});