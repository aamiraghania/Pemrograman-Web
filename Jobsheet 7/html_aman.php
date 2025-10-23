<!DOCTYPE html>
<html>
    <head>
        <title>Form Input</title>
    </head>
    <body>
        <h2>Form Input</h2>

        <form action="" method="post">
            Nama: <input type="text" name="input"><br><br>
            Email: <input type="text" name="email"><br><br>
            <input type="submit" value="Kirim">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $input = $_POST['input'];
            $email = $_POST['email'];

            $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
            $email = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');

            echo "<h3>Hasil Input:</h3>";
            echo "<p>Nama: $input</p>";
        
            //Memeriksa apakah input adalah email yang valid
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<p>Email: $email</p>";
                echo "<p>Email valid</p>";
            } else {
                echo "<p>Email tidak valid";
            }
        }
        ?>
    </body>
</html>
