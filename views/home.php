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
    <title> CV Maker - Online Resume Builder </title>
</head>

<body class="text-center" style="background-color: #e7e7e7">
    <main>
        <div class="container">
            <div class="d-flex justify-content-center">
                <div class="card mt-5 border-0 rounded-3 shadow-sm p-3" style="width: 50rem">
                    <div class="flex my-3">
                        <img src="<?php echo LOGO; ?>" alt="logo" style="width:128px; height:128px;" class="align-center object-fit-contain rounded-3">
                    </div>
                    <h3 class="fs-3 fw-semibold">CV Maker - Online Resume Builder</h3>
                    <p class="text-muted fs-6"> <a class="btn btn-primary fw-bold shadow-sm" href="<?php echo url('/auth/login'); ?>"> Create Your Resume </a></p>
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