<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<style>
    .card-box{
    height:500px;
}
.whitecard{
    width: 500px;
     height: 337px;
       box-shadow: 5px 4px 2px 3px;
}
.whitecard h4{
    text-align: center;padding: 20px;color: blue; font-size: 30px;font-weight:800
}
.whitecard p{
    text-align: center;font-weight:800;font-size:16px;color:blue
}
.whitecard .usernameparagraph{
    font-size:22px;
}
.button{
    display:flex;align-items: center;justify-content: center
}
.button a{
    font-weight:800;font-size:16px;color:white;background-color:black;padding:10px;border-radius:5px;
}

</style>
<body>
    <div class="d-flex justify-content-center align-items-center  w-100 card-box">
        <div class="bg-light box card whitecard">
        <h4>Email Verification</h4>
            <p>Thanks for signup with us,click on the button below to <br/>verify your email address.</p>
                <p class="usernameparagraph">{{ $first_name }} {{ $last_name }}</p><br><br>
        <div class="button">
            <a href="{{ url('verify/' . $id) }}">Verify Email</a>
        </div>
    </div>
    </div>
</body>
</html>
