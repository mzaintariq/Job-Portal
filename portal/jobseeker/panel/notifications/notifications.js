function acceptInvite(app_id,notif_id) {
    $(document).ready(function(){
        $.post("acceptInvite.php",{app_id:app_id,notif_id:notif_id}, function(data,status) {
            if(status=='success' && data=='done') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Job Invite Accepted. You are now employed. The notification has been removed now.");
            } else {
                $('#modalTitle').text("Failure");
                $('#modalBody').text("Could not perform operation. Please contact admin or try again.");
                //$('#error').html(data);
            }
            $('#modalButton').click();
        });
    });
}

function rejectInvite(app_id,notif_id) {
    $(document).ready(function() {
        $.post("rejectInvite.php",{app_id:app_id,notif_id:notif_id}, function(data,status) {
            if(status=='success' && data=='done') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Job Invite Rejected. The notification has been removed now.");
            } else {
                $('#modalTitle').text("Failure");
                $('#modalBody').text("Could not perform operation. Please contact admin or try again.");
                //$('#error').html(data);
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