<html>
<head>
    <title>TMBC - Comment App</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.6.1/angular-animate.js"></script>
    <script src="//angular-ui.github.io/bootstrap/ui-bootstrap-tpls-2.5.0.js"></script>

    <script src="js/commentApp/controllers/CommentController.js"></script>
    <script src="js/commentApp/services/CommentService.js"></script>
    <script src="js/commentApp/app.js"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1>TMBC Comment App</h1>
                @yield('content')
            </div>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <footer>
            <div class="row">
                <div class="col-lg-12">
                    <p>Copyright © Bishal Paudel 2017</p>
                </div>
            </div>
            <!-- /.row -->
        </footer>

    </div>
</body>
</html>