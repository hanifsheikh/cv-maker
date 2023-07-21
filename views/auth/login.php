<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('/css/vendor/bootstrap/bootstrap.min.css'); ?>">
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap");

        body {
            font-family: "Inter";
        }
    </style>
    <title>Sign In | CV Maker </title>
</head>

<body class="text-center" style="background-color: #e7e7e7">
    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card my-5 border-0 rounded-3 shadow-sm p-3" style="width: 25rem">
                    <div class="flex my-3">
                        <a href="<?php echo APP_URL; ?>">
                            <img src="<?php echo LOGO; ?>" alt="logo" class="w-25 align-center object-fit-cover rounded-3">
                        </a>
                    </div>
                    <h3 class="fs-3 fw-semibold">Sign In</h3>
                    <form class="flex flex-row w-100 p-3" action="<?php echo url('/auth/login'); ?>" method="POST">
                        <div class="flex w-100 mb-3">
                            <p class="text-start fs-6 fw-semibold mb-1">Email</p>
                            <input name="email" type="email" class="flex form-control" required />
                        </div>
                        <div class="flex w-100 mb-3">
                            <p class="text-start fs-6 fw-semibold mb-1">Password</p>
                            <input name="password" type="password" class="flex form-control" required />
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary fw-bold shadow-sm w-100">
                                Sign In
                            </button>
                        </div>
                    </form>
                    <p class="text-muted fs-6">Don't have an account? <a class="fw-semibold" href="<?php echo url('/auth/register'); ?>"> Register </a></p>
                </div>
            </div>
        </div>
    </main>
    <script src="<?php echo asset('/js/feather.min.js'); ?>"></script>
    <script type="text/javascript">
        feather.replace()
    </script>
</body>

</html>