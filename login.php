    <?php
    ob_start();
    session_start(); 
    if (isset($_SESSION['admin'])) {
       header("Location:index.php");
       exit();
   } 

   ?>

   <!DOCTYPE html>
   <html lang="en">
   <head>
    <style media="screen">
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            border: none;
        }

        form {
            height: 400px;
            width: 400px;
            background-color: rgba(255, 255, 255, 0.13);
            position: absolute;
            top: 25%;
            left: 40%;
            border-radius: 10px;
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 20px;
            font-family: 'Poppins', sans-serif;
        }

        label {
            display: block;
            margin-top: 30px;
            font-size: 16px;
            font-weight: 500;
            color:#3f598d ;
        }

        input {
            display: block;
            height: 50px;
            width: 100%;
            border-radius: 3px;
            padding: 0 10px;
            margin-top: 8px;
            font-size: 14px;
            font-weight: 300;
            border: 1px solid #3f598d;
        }

        button {
            margin-top: 50px;
            width: 100%;
            background-color: #3f598d;
            color: #FFFFFF;
            padding: 15px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <form method="post" action="Login/Login.php">
        <label for="username" >İstifadəçi adı</label>
        <input type="text" name="user_name"  id="username">
        <label for="password">İstifadəçı şifrəsi</label>
        <input type="password" name="user_pass" id="password">
        <button name="daxiOl">Daxil ol</button>
    </form>
</body>
</html>
