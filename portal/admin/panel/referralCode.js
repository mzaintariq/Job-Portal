function generateReferralCode() {
    $(document).ready(function(){
        $.get("gen_ref.php", function(data,status) {
            if(status=='success') {
                $('#referralCode').val(data);
                $('#refDiv').fadeIn();
            }
        });
    });
}