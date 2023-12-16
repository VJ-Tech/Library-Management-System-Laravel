<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
    <style>
        body{
            display: flex;
            flex-direction: row;
            margin: 0;
            padding: 0;
            height: 100vh;
            background-color: rgba(0, 255, 255, 0.253);
        }

        nav {
            display: flex;
            flex-direction: column;
            padding: 50px;
            background: white;
            flex: 1;
            border-radius: 20px;
            box-shadow: 0 0 2px;
        }

        #navigation {
            width: 20%;
            padding: 40px 20px;
            display: flex;
            flex-direction: column;
        }

        #contents {
            flex: 1;
            padding: 50px;
        }

        a {
            text-decoration: none;
            color: black;
            font-size: 25px;
            margin: 10px;
            padding: 50px 10px;
            box-shadow: 0 0 2px;
            border-radius: 5px;
            text-align: center;
        }

        a:hover {
            background: rgba(0, 255, 255, 0.541);
        }

        h1 {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 2px;
            background: white;
            color: rgb(13, 46, 46);
            margin-top: 200px;
        }
    </style>
</head>
<body>
    <div id="navigation">
        <nav>
            <a href=" {{ url('/') }} ">Home</a>
            <a href="{{ url('/books') }}">Books</a>
            <a href=" {{ url('/checkouts') }} ">Checkouts</a>
            <a href=" {{ url('/students') }} ">Students</a>
        </nav>
    </div>

    <div id="contents">
        <h1>LIBRARY MANAGEMENT SYSTEM</h1>
    </div>
</body>
</html>
