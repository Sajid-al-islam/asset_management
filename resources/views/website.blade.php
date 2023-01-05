<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Asset Management</title>
    <style>
        body{
            margin: 0;
        }
        .app{
            background:#07080c url('/frontend/images/homebg.jpg');
            background-size: contain;
            background-repeat: no-repeat;
            background-position: right center;
            width: 100vw;
            height: 100vh;
            display: grid;
            align-content: center;
        }
        a{
            display: inline-block;
            border: 2px solid #05a6fd;
            width: 103px;
            padding: 13px;
            margin-left: 20vw;
            border-radius: 6px;
            color: #74c8da;
            font-family: sans-serif;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 24px;
            text-align: center;
            transition-duration: .3s;
        }
        a:hover{
            background-color: #05a6fd;
            color: white;
        }
    </style>
</head>
<body>
    <div class="app">
        <a href="/admin">Login</a>
    </div>
</body>
</html>