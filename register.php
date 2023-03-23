<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTER FORM</title>
    <link rel="stylesheet" href="register.css">


</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form id="checkout-form" action="action.php" method="POST">
                    <div class="alert alert-danger" role="alert">
                        <?php if (isset($_GET['error'])) {
                            echo $_GET['error'];
                        } ?>
                    </div>
                    <h2>Register</h2>
                    <!-- Input Area -->
                    <div class="inputbox">
                        <input name="username" type="username" required>
                        <label for="username">Username</label>
                    </div>

                    <div class="inputbox">

                        <input name="email" type="email" required>
                        <label for="email">Email</label>
                    </div>

                    <div class="inputbox">
                        <input name="upassword" type="password"  id="myInput" required>
                        <label for="upassword">Password</label>
                        <script>
                            function myFunction(){
                                var x = document.getElementById("myInput");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }

                            }
                        </script>
                        <i class="bx bx-key"></i>
                    </div>

                    <div class="inputbox">
                        <input name="notelp" type="notelp" required>
                        <label for="notelp">no telephone</label>
                    </div>

                    <div class="inputbox">
                        <input name="alamat" type="alamat" required>
                        <label for="alamat">Alamat</label>
                    </div>



                    <button class="signup" name="register">Register</button>
                    <div class="login">
                        <p>Already account <a href="login.php">Login</a></p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>