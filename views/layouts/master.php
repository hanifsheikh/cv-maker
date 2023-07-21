<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo asset('/css/vendor/bootstrap/bootstrap.min.css'); ?>">
    <style>
        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-Light.ttf'); ?>) format("truetype");
            font-weight: 300;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-Regular.ttf'); ?>) format("truetype");
            font-weight: 400;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-Medium.ttf'); ?>) format("truetype");
            font-weight: 500;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-SemiBold.ttf'); ?>) format("truetype");
            font-weight: 600;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-Bold.ttf'); ?>) format("truetype");
            font-weight: 700;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-ExtraBold.ttf'); ?>) format("truetype");
            font-weight: 900;
            font-style: normal;
        }

        @font-face {
            font-family: "Inter";
            src: url(<?php echo asset('/fonts/Inter/Inter-Black.ttf'); ?>) format("truetype");
            font-weight: 900;
            font-style: normal;
        }

        body {
            font-family: "Inter";
        }
    </style>
    <title>CV Maker | <?php echo $page_title; ?></title>
</head>

<body style="background-color: #e7e7e7">
    <?php require "navbar.php"; ?>
    <main class="py-3">
        <div class="py-5">
            <?php require "../views/" . str_replace('.', '/', $view) . '.php'; ?>
        </div>
    </main>
    <script src="<?php echo asset('/js/bootstrap.bundle.min.js'); ?>"></script>
    <script src="<?php echo asset('/js/feather.min.js'); ?>"></script>
    <script src="<?php echo asset('/js/alpine.min.js'); ?>"></script>
    <script type="text/javascript">
        feather.replace()
    </script>
</body>

</html>