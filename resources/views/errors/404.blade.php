@extends('layouts.app')

@section('content')
<style>
    body,
    html {
    padding: 0;
    margin: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    background-color: #eaeaea;
    font-family: 'Montserrat', sans-serif;
    color: #333333
    }

    html {
    background: url('https://static.pexels.com/photos/818/sea-sunny-beach-holiday.jpg');
    background-size: cover;
    background-position: bottom
    }

    .error {
    text-align: center;
    padding: 16px;
    position: relative;
    top: 25%;
    transform: translateY(-50%);
    -webkit-transform: translateY(-50%)
    }

    h1 {
    margin: -10px 0px -30px;
    font-size: calc(17vw + 40px);
    opacity: .8;
    letter-spacing: -17px;
    }

    p {
    opacity: .8;
    font-size: 20px;
    margin: 8px 0 38px 0;
    font-weight: bold;
    }

    .img{
    opacity: .2;
    width:10%;
    height:10%;
    margin-top: 40px;
    }


    </style>
</head>
<body>
    <center>
        <img class="img " src="img/CodeWave.png" alt="CodeWave logo">
    </center>
    <a href="" class="fa fa-arrow-left"></a>
    <div class="error">
    <h1>404</h1>
    <p>Oops! Algo salió mal.</p>
    </div>
</body>
@endsection
