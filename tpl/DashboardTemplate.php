<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="css\style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <title>
        <?= $title ?? '' ?>
    </title>
</head>

<body class="d-flex flex-column min-vh-100" >
    <main>
        <header class="header">
            <h1>
                <?= $header ?? '' ?>
            </h1>
        </header>

        <div class="container">
            <div class="row">
                <img src="css\Logo.png" class=" col-sm-2" alt="Logo" />
                <div class="col-sm-2"></div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2"></div>
                <div class="col-sm-2">
                    <p><a href="Logout.php"> Log Out </a></p>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-5">
                    <?= $role ?? '' ?>:
                    <?= $username ?? '' ?>
                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-3">Email:
                    <?= $email ?? '' ?>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="space"> </div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <?= $CNSbtn ?? '' ?>

                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <?= $VASbtn ?? '' ?>

                </div>
            </div>

            <div class="row">
                <div class="space"> </div>
            </div>
            <div class="row">
                <div class="col-sm-2"></div>
                <div class="col-sm-3">
                    <?= $DPSbtn ?? '' ?>

                </div>
                <div class="col-sm-2"></div>
                <div class="col-sm-3">

                    <?= $CNRbtn ?? '' ?>

                </div>
                <div class="col-sm-2"></div>

            </div>
        </div>

        <?= $createUser ?? '' ?>:

        <div class="row">
            <div class="space"> </div>
        </div>

    </main>
    <footer class="bg-light text-center text-lg-start mt-auto">
        <div class="text-center p-3" style="background-color: #003366;">
            <?= $footerContent ?? '' ?>
        </div>
    </footer>
</body>



</html>