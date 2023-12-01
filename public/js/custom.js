// Login Validation function
function validateForm()
{
        var emails = document.getElementById('email').value;
        var pass = document.getElementById('password').value;
        var regularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

        const errorMessage1 = (
                emails == "" ? "** Please fill the email" :
                emails.charAt(emails.length-4)!='.' && emails.charAt(emails.length-3)!='.' ? "*Invalid Position*" :
                    ""
        );
        document.getElementById('emailids').innerHTML = errorMessage1;
            if(errorMessage1 != ""){
                return false;
            }

        const errorMessage2 = (
            pass == "" ? "** Please fill the password field" :
            pass.length<8 ? "** Passwords length must be 8 Characters" :
            !regularExpression.test(pass) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
            ""
        )
            document.getElementById('password12').innerHTML = errorMessage2;
        if(errorMessage2 != ""){
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
    var gender = document.getElementsByName('gender');
    var phone = document.getElementById('phone').value;
    var profile_pi = document.getElementById('selectImage').value;
    var genValue = false;
    var regularExpression = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})");

// First name validation
        const errorMessage = (
            first_name == "" ? "** Please fill the First name field" :
            first_name.length <= 2 || first_name.length > 20 ? "*Firstname length must be between 2 and 20*" :
            !isNaN(first_name) ? "** only characters are allowed" :
            ""
        );
        document.getElementById('firstname').innerHTML = errorMessage;
        if(errorMessage != ""){
            return false;
        }

// Last name validation
        const errorMessage1 = (
            last_name == "" ? "** Please fill the Last name field" :
            last_name.length <= 2 || last_name.length > 20 ? "*Lastname length must be between 2 and 20*" :
                !isNaN(last_name) ? "** only characters are allowed" :
                ""
        );
        document.getElementById('lastname').innerHTML = errorMessage1;
        if(errorMessage1 != ""){
            return false;
        }

// Email validation
        const errorMessage2 = (
            emails == "" ? "** Please fill the email" :
            emails.charAt(emails.length-4)!='.' && emails.charAt(emails.length-3)!='.' ? "*Invalid Position*" :
            ""
        );
        document.getElementById('emailids').innerHTML = errorMessage2;
        if(errorMessage2 != ""){
            return false;
        }

// Password validation
        const errorMessage3 = (
            pass == "" ? "** Please fill the password field" :
            pass.length<8 ? "** Passwords length must be 8 Characters" :
            !regularExpression.test(pass) ? "** Password must contain at least one uppercase, one lowercase, one number and one special character" :
            ""
        )
        document.getElementById('password12').innerHTML = errorMessage3;
        if(errorMessage3 != ""){
            return false;
        }

// Confirm password validation
        const errorMessage4 = (
            confirmpass == "" ? "** Please fill the confirmpass field" :
            pass !=confirmpass ? "** Password does not match the confirm password" :
            ""
        );
        document.getElementById('confrmpass').innerHTML = errorMessage4;
        if(errorMessage4 != ""){
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
        const errorMessage5 = (
            phone == "" ? "** Please add the Phone number" :
            isNaN(phone) ? "**  user must write digits only not characters" :
            phone.length!=10 ? "** Mobile Number must be 10 digits only" :
            ""
        );
        document.getElementById('phonenumber').innerHTML = errorMessage5;
        if(errorMessage5 != ""){
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


