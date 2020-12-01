function generateReferralCode() {
    $(document).ready(function(){
        $('#loader').toggle();
        $.get("gen_ref.php", function(data,status) {
            if(status=='success') {
                $('#referralCode').val(data);
                $('#loader').toggle();
                $('#refDiv').fadeIn();
            }
        });
        
    });
}