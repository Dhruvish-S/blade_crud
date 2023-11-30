<html lang="en">
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="d-flex justify-content-center align-items-center  w-100" style="height:800px;">
        <div class="bg-light box" class="bg-secondary" style="width: 500px; height: 337px;  box-shadow: 5px 4px 2px 3px;">
        <h4 style="text-align: center;padding: 20px;color: blue; font-size: 30px;font-weight:800">Email Verification</h4>
            <p style="text-align: center;font-weight:800;font-size:16px;color:blue">Thanks for signup with us,click on the button below to <br/>verify your email address.</p>
                <p style="text-align: center;font-weight:800;font-size:22px;color:blue">{{ $first_name }} {{ $last_name }}</p><br><br>
        {{-- <a href="{{ url('verify/' . $id) }}" style="font-weight:800;font-size:16px;color:white;background-color:black;padding:10px;border-radius:5px; margin-left:35%">Verify Email{{ $id }}</a> --}}
        <div class="button" style="display:flex;align-items: center;justify-content: center;">
            <a href="{{ url('verify/' . $id) }}" style="font-weight:800;font-size:16px;color:white;background-color:black;padding:10px;border-radius:5px;">Verify Email</a>
        </div>
    </div>
    </div>
</body>
</html>
