function deleteNotification(all,notif_id) {
    $(document).ready(function(){
        $.post('deleteNotification.php',{all:all,notif_id:notif_id},function(data,status) {
            if(status=='success' && data=='done') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Notification deleted.");
            } else {
                $('#modalTitle').text("Failure");
                $('#modalBody').text("Could not delete notification. ");
            }
            $('#modalButton').click();
        });
    });
}

function acceptResignation(notif_id,job_id) {
    $(document).ready(function(){
        $.post('acceptResignation.php',{notif_id:notif_id,job_id:job_id},function(data,status) {
            if(status=='success' && data=='done') {
                $('#modalTitle').text("Success");
                $('#modalBody').text("Employee has resigned successfully.");
            } else {
                $('#modalTitle').text("Failure");
                $('#modalBody').text("Could not accept resignation.");
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