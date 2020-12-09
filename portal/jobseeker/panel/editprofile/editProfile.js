function editProfile(type, emp_id,value) {
    if(type=='firstname' || type=='lastname' || type=='profession' || type=='address') {
        $('#'+type).html("<form action='changeProfile.php' method='post'><input type='text' name='"+type+"' class='form-control' value='"+value+"'><input class='btn btn-primary' type='submit'></form>");
    } else if (type=='age') {
        $('#'+type).html("<form action='changeProfile.php' method='post'><input type='number' name='age' class='form-control' value='"+value+"'><input class='btn btn-primary' type='submit'></form>");
    } else if (type=='gender') {
        $('#'+type).html("<form action='changeProfile.php' method='post'><select class='form-control' name='gender'><option value='0'>Male</option><option value='1'>Female</option><option value='2'>Other</option></select><input class='btn btn-primary' type='submit'></form>");
    }
}