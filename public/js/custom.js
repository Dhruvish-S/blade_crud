// Login Validation function
function validateForm(event)
{
    event.preventDefault();
        var emails = document.getElementById('email').value;
        var pass = document.getElementById('password').value;
        var passwordRegularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");
        var emailRegularExpression = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;

        const emailError = (
                emails == "" ? "** Please fill the email" :
                emailRegularExpression.test(emails) == false ? "*Invalid email*" :
                    ""
        );
        document.getElementById('email_ids').innerHTML = emailError;
            if(emailError != ""){
                return false;
            }

        const passwordError = (
            pass == "" ? "** Please fill the password field" :
            !passwordRegularExpression.test(pass) ? "** Invalid password" :
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
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var emails = document.getElementById('email').value;
    var pass = document.getElementById('password').value;
    var confirm_pass = document.getElementById('confirm_password').value;
    var dobInput = document.getElementById('dob').value;
    var phone = document.getElementById('phone').value;
    var profile_pi = document.getElementById('selectImage').value;
    var passwordRegularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

    var emailRegularExpression = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;


    // First name validation
        const fnameError = (
            first_name == "" ? "** Please fill the First name field" :
            first_name.length <= 2 || first_name.length > 20 ? "*First name length must be between 2 and 20*" :
            !isNaN(first_name) ? "** only characters are allowed" :
            ""
        );
        document.getElementById('First_name').innerHTML = fnameError;
        if(fnameError != ""){
            return false;
        }

    // Last name validation
        const lnameError = (
            last_name == "" ? "** Please fill the Last name field" :
            last_name.length <= 2 || last_name.length > 20 ? "*Last name length must be between 2 and 20*" :
                !isNaN(last_name) ? "** only characters are allowed" :
                ""
        );
        document.getElementById('Last_name').innerHTML = lnameError;
        if(lnameError != ""){
            return false;
        }


     // Email validation

    if(emails  == ""){
        document.getElementById('Email_ids').innerHTML =" ** Please fill the Email";
        return false;
    }
    if(emailRegularExpression.test(emails) == false)
    {
        document.getElementById('Email_ids').innerHTML =" **InValid";
        return false;
    }

        // Password validation
        let passwordError = (
            pass == "" ? "** Please fill the password field" :
            pass.length<8 ? "** Passwords length must be 8 Characters" :
            !passwordRegularExpression.test(pass) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
            ""
        )
        document.getElementById('password12').innerHTML = passwordError;

        if(passwordError != ""){
            return false;
        }

    // Confirm password validation
        const confirmError = (
            confirm_pass == "" ? "** Please fill the confirm pass field" :
            pass !=confirm_pass ? "** Password does not match the confirm password" :
            ""
        );
        document.getElementById('Confirm_pass').innerHTML = confirmError;
        if(confirmError != ""){
            return false;
        }

    //Date of birth validation
        if(dobInput == ""){
            document.getElementById('Birth_date').innerHTML =" ** Please fill the Date of birth field";
            return false;
        }

    let currentDate = new Date();
	let birthDate = new Date(dobInput);
	// return if age is over 18
	let diff = new Date(currentDate - birthDate)
	let age = Math.abs(diff.getUTCFullYear() - 1970);

    if(age < 18){
        document.getElementById('Birth_date').innerHTML = "** The date difference is less than -18 years";
            return false;
    }
    else{
        document.getElementById('Birth_date').innerHTML ="";
    }

    //Gender validation
        if (!document.querySelector('input[name="gender"]:checked')) {
            document.getElementById('radio').innerHTML = " ** Please select the gender";
            return false;
        }
        else{
            document.getElementById('radio').innerHTML = "";
        }

    //Phone validation
        const phoneError = (
            phone == "" ? "** Please add the Phone number" :
            isNaN(phone) ? "**  user must write digits only not characters" :
            phone.length!=10 ? "** Mobile Number must be 10 digits only" :
            ""
        );
        document.getElementById('Phone_number').innerHTML = phoneError;
        if(phoneError != ""){
            return false;
        }

    // Profile pic

        if(profile_pi == ""){
            document.getElementById('profile_image').innerHTML =" ** Please select image";
            return false;
        }
        var fileInput = document.getElementById("selectImage");
        var fileName = fileInput.value;
        var allowedExtensions = /(\.jpg|\.jpeg|\.png)$/i;
        if (!allowedExtensions.exec(fileName)) {
            document.getElementById('profile_image').innerHTML = "** Only JPG, JPEG, and PNG files are allowed";
            return false;
        }

}


