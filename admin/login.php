<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>

    <style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
        font-family:'Segoe UI',sans-serif;
    }

    body{
        min-height:100vh;
        display:flex;
        justify-content:center;
        align-items:center;
        background:#f8fafc;
    }

    .login-box{
        width:100%;
        max-width:420px;
        background:#ffffff;
        padding:40px;
        border-radius:18px;
        box-shadow:0 10px 30px rgba(0,0,0,0.08);
        border:1px solid #e2e8f0;
    }

    .logo{
        text-align:center;
        font-size:50px;
        margin-bottom:10px;
    }

    h2{
        text-align:center;
        color:#1e293b;
        margin-bottom:5px;
    }

    .subtitle{
        text-align:center;
        color:#64748b;
        font-size:13px;
        margin-bottom:25px;
        line-height:1.4;
    }

    label{
        font-size:13px;
        color:#334155;
        display:block;
        margin-bottom:6px;
        margin-top:12px;
    }

    input{
        width:100%;
        padding:12px;
        border-radius:10px;
        border:1px solid #cbd5e1;
        outline:none;
        transition:0.3s;
        font-size:14px;
    }

    input:focus{
        border-color:#3b82f6;
        box-shadow:0 0 0 3px rgba(59,130,246,0.15);
    }

    button{
        width:100%;
        margin-top:18px;
        padding:12px;
        border:none;
        border-radius:10px;
        background:#3b82f6;
        color:white;
        font-weight:bold;
        cursor:pointer;
        transition:0.3s;
        font-size:15px;
    }

    button:hover{
        background:#2563eb;
        transform:translateY(-2px);
    }

    .footer{
        text-align:center;
        margin-top:20px;
        font-size:12px;
        color:#94a3b8;
    }

    </style>
</head>
<body>

<div class="login-box">

    <div class="logo">🏠</div>

    <h2>Login Admin</h2>

    <div class="subtitle">
        Sistem Informasi Pencarian Kontrakan<br>
        Berbasis Location Based Service (LBS)
    </div>

    <form action="proses_login.php" method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <label>Password</label>
        <input type="password" name="password" required>

        <button type="submit">Masuk Dashboard</button>

    </form>

    <div class="footer">
    </div>

</div>

</body>
</html>