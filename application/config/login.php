<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <title>Login</title>
    <style>
        body {
            padding: 50px;
        }

        .container {
            max-width: 300px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: rgba(50, 50, 61, 0.2) 0px 7px 29px 0px;
        }

        .form-group {
            padding: 5px 0px;
            margin-bottom: 30px;
        }

        .form-btn {
            padding: 5px 0px;
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="Email:">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Password:">
            </div>
            <div class="form-btn d-flex     align-items-center">
                <input type="submit" class="btn btn-primary" value="Login" name="submit">

				<div class="login-button-div w-50" style="text-align:right;">
					<button class="m-0 btn btn-primary"><a class="text-white text-decoration-none" href="register">sign up</a></button>
				</div>
            </div>
        </form>
    </div>
</body>
</html>

