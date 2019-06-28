<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Dictionary</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <!--{-- Fonts 
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">-->
        <style>
        /*検索ボタン*/
            .btn-dark {
                background-color: #cc0066;
                color: #ffffff;
                margin :0;
            }
            
            .btn-search {
                padding :0;
                text-align: center;                
            }
            
            .btn-dark:hover, .btn-dark:focus, 
            .btn-dark:active, .btn-dark:active:focus, .btn-dark:active:hover, .btn-dark:active.focus,
            .btn-dark.active, .btn-dark.active:focus, .btn-dark.active:hover, .btn-dark.active.focus,
            .open > .dropdown-toggle.btn-dark, 
            .open > .dropdown-toggle.btn-dark:hover,
            .open > .dropdown-toggle.btn-dark:focus, 
            .open > .dropdown-toggle.btn-dark.focus,
            .btn-dark.disabled:hover, .btn-dark[disabled]:hover, fieldset[disabled] .btn-dark:hover,
            .btn-dark.disabled:focus, .btn-dark[disabled]:focus, fieldset[disabled] .btn-dark:focus,
            .btn-dark.disabled.focus, .btn-dark[disabled].focus, fieldset[disabled] .btn-dark.focus {
                background: #ec2086;
                color: #ffffff;
                margin :0;
            }
            .btn-dark.outline {
                border: 3px solid;
                color: #ffffff;
                margin :0;
            }
            
            /*単語作成ボタン*/
            .btn-secondary {
                background-color: #5f5f5f;
                color: white;
                margin :0;
            }
            .btn-secondary:hover, .btn-secondary:focus, 
            .btn-secondary:active, .btn-secondary:active:focus, .btn-secondary:active:hover, .btn-secondary:active.focus,
            .btn-secondary.active, .btn-secondary.active:focus, .btn-secondary.active:hover, .btn-secondary.active.focus,
            .open > .dropdown-toggle.btn-secondary, 
            .open > .dropdown-toggle.btn-secondary:hover,
            .open > .dropdown-toggle.btn-secondary:focus, 
            .open > .dropdown-toggle.btn-secondary.focus,
            .btn-secondary.disabled:hover, .btn-secondary[disabled]:hover, fieldset[disabled] .btn-secondary:hover,
            .btn-secondary.disabled:focus, .btn-secondary[disabled]:focus, fieldset[disabled] .btn-secondary:focus,
            .btn-secondary.disabled.focus, .btn-secondary[disabled].focus, fieldset[disabled] .btn-secondary.focus {
                background: #7f7f7f;
                color: white;
                margin :0;
            }
            .btn-secondary.outline {
                border: none;
                margin :0;
            }            
            .card-header {
                background-color: #cca3a3;
                color: white;
            }
            .navbar-pink {
                background-color: #cc0066;
            }

            html, body {
                background-color: #f9f9f9;
            }    

            .card-text {
                font-size: 18px;
                line-height: 1.6;
            }
            
            .btn-sm {
                padding: 4px 10px;
                font-size: 16px;
            }
            
            button {
                background-color: white;
                color: #cc0066;
                border : none;
/*                border-radius: 5px;
                border-color : #cca3a3;
                border-style: solid;
                border-width: thin;*/
                padding: 1 1;
            }
            
            .count {
                color: #cc0066;
                font-size: 80%;
                margin: auto;
            }
            
            .balloon {
            	position: relative;
            	z-index: auto;                
            }

            .balloon_box {
            	position: absolute;
            	width: 300px; /* 吹き出しの幅 */
            	height: 50px; /* 吹き出しの高さ */
            	top: 60px; /* 画像と三角形の高さをプラスした値 */
            	left: -30px;
            	border-radius: 10px 10px 10px 10px;
            	background-color: #cca3a3;
            	display: none;                
            }
            .balloon_box:after {
            	position: absolute;
            	content: "";
            	width: 0;
            	height: 0;
            	top: -32px; /* 三角形の高さを２倍した値 */
            	left: 32px;
            	border: 16px solid transparent;
            	border-bottom: 16px solid #cca3a3;
            }
            
            .balloon_text {
            	position: absolute;
            	font-size: 16px;
            	top: 10px;
            	left: 10px;
            	color: #fff;
            	margin: auto;
            } 
            
            .balloon:hover .balloon_box {
                z-index: 2;
                display: block;
            }
                        
            /*全体*/
            .hidden_box {
                margin: 2em 0;/*前後の余白*/
                padding: 0;
            }
            
            /*チェックは見えなくする*/
            .hidden_box input {
                display: none;
            }
            
            /*中身を非表示にしておく*/
            .hidden_box .hidden_show {
                height: 0;
                padding: 0;
                overflow: hidden;
                opacity: 0;
                transition: 0.8s;
            }
            
            /*クリックで中身表示*/
            .hidden_box input:checked ~ .hidden_show {
                padding: 10px 0;
                height: auto;
                opacity: 1;
            }
/*            
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }    */
            
        </style>

    </head>

    <body>

        @include('commons.navbar')
        
        <div class="container">
            @include('commons.error_messages')
            @yield('content')
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.7.2/js/all.js"></script>
    </body>
</html>