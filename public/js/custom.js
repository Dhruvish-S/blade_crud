// Login Validation function
function validateForm()
{
        var emails = document.getElementById('email').value;
        var pass = document.getElementById('password').value;
        var regularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

        const emailMessage = (
                emails == "" ? "** Please fill the email" :
                emails.charAt(emails.length-4)!='.' && emails.charAt(emails.length-3)!='.' ? "*Invalid Position*" :
                    ""
        );
        document.getElementById('emailids').innerHTML = emailMessage;
            if(emailMessage != ""){
                return false;
            }

        const passwordMessage = (
            pass == "" ? "** Please fill the password field" :
            pass.length<8 ? "** Passwords length must be 8 Characters" :
            !regularExpression.test(pass) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
            ""
        )
            document.getElementById('password12').innerHTML = passwordMessage;
        if(passwordMessage != ""){
            return false;
        }
}

// Register Validation function
function validateForm12()
{
    var first_name = document.getElementById('first_name').value;
    var last_name = document.getElementById('last_name').value;
    var emails = document.getElementById('email').value;
    var pass = document.getElementById('password').value;
    var confirmpass = document.getElementById('confirm_password').value;
    var birthdate = document.getElementById('dob').value;
    var phone = document.getElementById('phone').value;
    var profile_pi = document.getElementById('selectImage').value;
    var regularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

    // First name validation
        const firstnameMessage = (
            first_name == "" ? "** Please fill the First name field" :
            first_name.length <= 2 || first_name.length > 20 ? "*Firstname length must be between 2 and 20*" :
            !isNaN(first_name) ? "** only characters are allowed" :
            ""
        );
        document.getElementById('firstname').innerHTML = firstnameMessage;
        if(firstnameMessage != ""){
            return false;
        }

    // Last name validation
        const lastnameMessage = (
            last_name == "" ? "** Please fill the Last name field" :
            last_name.length <= 2 || last_name.length > 20 ? "*Lastname length must be between 2 and 20*" :
                !isNaN(last_name) ? "** only characters are allowed" :
                ""
        );
        document.getElementById('lastname').innerHTML = lastnameMessage;
        if(lastnameMessage != ""){
            return false;
        }

    // Email validation
        const emailMessage = (
            emails == "" ? "** Please fill the email" :
            emails.charAt(emails.length-4)!='.' && emails.charAt(emails.length-3)!='.' ? "*Invalid Position*" :
            ""
        );
        document.getElementById('emailids').innerHTML = emailMessage;
        if(emailMessage != ""){
            return false;
        }

    // Password validation
        const passwordMessage = (
            pass == "" ? "** Please fill the password field" :
            pass.length<8 ? "** Passwords length must be 8 Characters" :
            !regularExpression.test(pass) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
            ""
        )
        document.getElementById('password12').innerHTML = passwordMessage;
        if(passwordMessage != ""){
            return false;
        }

    // Confirm password validation
        const confirmMessage = (
            confirmpass == "" ? "** Please fill the confirmpass field" :
            pass !=confirmpass ? "** Password does not match the confirm password" :
            ""
        );
        document.getElementById('confrmpass').innerHTML = confirmMessage;
        if(confirmMessage != ""){
            return false;
        }

    //Date of birth validation
        if(birthdate == ""){
            document.getElementById('birthdate').innerHTML =" ** Please fill the Date of birth field";
            return false;
        }

        var dobInput = document.getElementById("dob");
        var selectedDate = new Date(dobInput.value);
        var today = new Date();
        var age = today.getFullYear() - selectedDate.getFullYear();
            if (
                today.getMonth() < selectedDate.getMonth() ||
                (today.getMonth() === selectedDate.getMonth() && today.getDate() < selectedDate.getDate())
            ) {
                age--;
            }
            if (age < 18) {
                document.getElementById('birthdate').innerHTML = "** The date difference is less than -18 years";
                return false;
            }
            else{
                document.getElementById('birthdate').innerHTML ="";
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
        const phoneMessage = (
            phone == "" ? "** Please add the Phone number" :
            isNaN(phone) ? "**  user must write digits only not characters" :
            phone.length!=10 ? "** Mobile Number must be 10 digits only" :
            ""
        );
        document.getElementById('phonenumber').innerHTML = phoneMessage;
        if(phoneMessage != ""){
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


