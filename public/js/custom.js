// Login Validation function
function validateForm()
{
        var emails = document.getElementById('email').value;
        var pass = document.getElementById('password').value;
        var email_regular_expression = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        const emailError = (
                emails == "" ? "** Please fill the email field" :
                email_regular_expression.test(emails) == false ? "** Invalid email address" :
                    ""
        );
        document.getElementById('email_ids').innerHTML = emailError;
            if(emailError != ""){
                return false;
            }

        const passwordError = (
            pass == "" ? "** Please fill the password field" :
            ""
        )
            document.getElementById('password12').innerHTML = passwordError;
        if(passwordError != ""){
            return false;
        }
}

// Register Validation function
function registerValidateForm()
{
    var ft_letter_capital_regex = /^[A-Z][a-z]*$/;
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var emails = document.getElementById('email').value;

    if(users == ''){
        var pass = document.getElementById('password').value;
        var confirm_pass = document.getElementById('confirm_password').value;
    }

    var dob_input = document.getElementById('dob').value;
    var phone = document.getElementById('phone').value;
    var profile_pi = document.getElementById('selectImage').value;
    var pd_regular_expression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
    var email_regular_expression = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

    // First name validation

        let fname_error = (
            first_name == "" ? "** Please fill the First name field" :
            first_name.length <= 2 || first_name.length > 20 ? "** First name length must be between 2 and 20*" :
            !isNaN(first_name) ? "** only characters are allowed" :
            !ft_letter_capital_regex.test(first_name) ? "** First name must start with a capital letter" :
            ""
        );
        document.getElementById('First_name').innerHTML = fname_error;
        if(fname_error != ""){
            return false;
        }

    // Last name validation
        let lname_error = (
            last_name == "" ? "** Please fill the Last name field" :
            last_name.length <= 2 || last_name.length > 20 ? "** Last name length must be between 2 and 20" :
                !isNaN(last_name) ? "** only characters are allowed" :
                !ft_letter_capital_regex.test(last_name) ? "** Last name must start with a capital letter" :
                ""
        );
        document.getElementById('Last_name').innerHTML = lname_error;
        if(lname_error != ""){
            return false;
        }


    // Email validation
        if(emails  == ""){
            document.getElementById('Email_ids').innerHTML ="** Please fill the email field";
            return false;
        }
        if(email_regular_expression.test(emails) == false)
        {
            document.getElementById('Email_ids').innerHTML ="** Invalid email address";
            return false;
        }


    if(users == ''){
    // Password validation
        let password_error = (
            pass == "" ? "** Please fill the password field" :
            pass.length<8 ? "** Passwords length must be 8 Characters" :
            !pd_regular_expression.test(pass) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
            ""
        )
        document.getElementById('password12').innerHTML = password_error;
        if(password_error != ""){
            return false;
        }

    // Confirm password validation
        let confirm_error = (
            confirm_pass == "" ? "** Please fill the confirm password field" :
            pass !=confirm_pass ? "** Password does not match the confirm password" :
            ""
        );
        document.getElementById('Confirm_pass').innerHTML = confirm_error;
        if(confirm_error != ""){
            return false;
        }
    }

    //Date of birth validation
        let current_date = new Date();
        let birth_date = new Date(dob_input);
        // return if age is over 18
        let diff = new Date(current_date - birth_date)
        let age = Math.abs(diff.getUTCFullYear() - 1900);
        if(dob_input == ""){
            document.getElementById('Birth_date').innerHTML ="** Please fill the Date of birth field";
            return false;
        }
        if(birth_date < 1900){
            document.getElementById('Birth_date').innerHTML = "** Invalid Date of birth";
            return false;
        }
        else{
            document.getElementById('Birth_date').innerHTML ="";
        }

    //Gender validation
        if (!document.querySelector('input[name="gender"]:checked')) {
            document.getElementById('radio').innerHTML = "** Please select the gender";
            return false;
        }
        else{
            document.getElementById('radio').innerHTML = "";
        }


    //Phone validation
        let phone_error = (
            phone == "" ? "** Please add the Phone number" :
            isNaN(phone) ? "**  User must write digits only not characters" :
            phone.length!=10 ? "** Mobile Number must be 10 digits only" :
            ""
        );
        document.getElementById('Phone_number').innerHTML = phone_error;
        if(phone_error != ""){
            return false;
        }

    // Profile pic

if(users == ''){
        if(profile_pi == ""){
            document.getElementById('profile_image').innerHTML ="** Please select profile pic";
            return false;
        }
        var file_input = document.getElementById("selectImage");
        var file_name = file_input.value;
        var allowed_extensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowed_extensions.exec(file_name)) {
            document.getElementById('profile_image').innerHTML = "** Only JPG, JPEG, and PNG files are allowed...";
            return false;
        }
}
else{
    var file_input = document.getElementById("selectImage");
    var file_name = file_input.value;
    var allowed_extensions = /(\.jpg|\.jpeg|\.png)$/i;
    if(users != "")
    {
        if (file_name && !allowed_extensions.exec(file_name)) {
            document.getElementById('profile_image').innerHTML = "** Only JPG, JPEG, and PNG files are allowed...";
            return false;
        }
    }
}

}


function changePassword()
{
    var cu_password = document.getElementById('current_password').value;
    var pd_regular_expression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

    let cp_error = (
        cu_password == "" ? "** Please fill the current password field" :
        cu_password.length<8 ? "** Passwords length must be 8 Characters" :
        !pd_regular_expression.test(cu_password) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
        ""
    )
    document.getElementById('odPassword').innerHTML = cp_error;

    if(cp_error != ""){
        return false;
    }


    var new_password = document.getElementById('password').value;

    let new_pd_error = (
        new_password == "" ? "** Please fill the new password field" :
        new_password.length<8 ? "** Passwords length must be 8 Characters" :
        !pd_regular_expression.test(new_password) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
        ""
    )
    document.getElementById('nPassword').innerHTML = new_pd_error;

    if(new_pd_error != ""){
        return false;
    }

    var confirm_password = document.getElementById('password_confirmation').value;

    let confirm_password_error = (
        confirm_password == "" ? "** Please fill the confirm password field" :
        new_password !=confirm_password ? "** Password does not match the confirm password" :
        ""
    );
    document.getElementById('cPassword').innerHTML = confirm_password_error;
    if(confirm_password_error != ""){
        return false;
    }


}
