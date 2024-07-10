//Function Delete Sweetalert
function confirmation(ev) {
    ev.preventDefault();

    //Var Link To Delete Data Menu
    var urlToDelete = ev.currentTarget.getAttribute("href");
    console.log(urlToDelete);

    // console.log(urlToDelete);

    //Swet Alert Confrim Delete data Menu
    Swal.fire({
        title: "Delete data ?",
        text: "Data menu yang dihapus tidak bisa dikembalikan lagi",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Delete",
    }).then((result) => {
        if (result.value) {
            window.location.href = urlToDelete; //Url Delete Menu
        }
    });
}


//Change Password
$("#ChangePassword").click(function() {
    //Hide Footer
    $(".footer").hide()

    //get Data From Input Change Password Sanaq
    var NRP = $("#NRP").val();
    var OldPass = $("#OldPassword").val();
    var NewPass = $("#NewPassword").val();
    var ConfirmPass = $("#ConfirmPassword").val();

    // console.log(NRP)
    // console.log(OldPass)
    // console.log(NewPass)
    // console.log(ConfirmPass)

    //Condition Input
    if(NRP.length === 0) {
        Swal.fire({
            type: 'error',
            title: "Required NRP",
            text: 'Please enter your NRP'
        });
    } else if(OldPass.length === 0) {
        Swal.fire({
            type: 'error',
            title: "Required Old Password",
            text: 'Please enter your old password'
        });
    } else if(NewPass.length === 0) {
        Swal.fire({
            type: 'error',
            title: "Required New Password",
            text: 'Please enter your new password'
        });
    } else if(ConfirmPass.length === 0) {
        Swal.fire({
            type: 'error',
            title: "Required Confirm Password",
            text: 'Please enter your confirm password'
        });
    } else {
        //Ajax Jquery Hit Data User to change Password
        $.ajax({
            url: '../api/data_user.php',
            type: 'POST',
            data: {
                NRP: NRP,
                OldPassword: OldPass,
                NewPassword: NewPass,
                ConfirmPassword: ConfirmPass
            },
            success: function(response) {
                console.log(response)
                //Sweet Alert
                if (response.Result.Success == true) {
                    Swal.fire({
                        type: 'success',
                        title: 'Successfuly',
                        text: response.Result.Message,
                    });
                    // window.location.href = '../dashboard/';
                } else {
                    Swal.fire({
                        type: 'error',
                        title: 'Oops...',
                        text: response.Result.Message,
                    });
                }
            },complete: function() {}
        })
    }

    //Show Footer
    $(".footer").show()

});