<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Light</title>
</head>

<body>
    <h1>Aceasta pagina este welcome</h1>
</body>

</html>
<!DOCTYPE html>
<html>

<head>
</head>

<body>
    <style>
        .image-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            position: relative;
        }

        .image {
            max-width: 100%;
            cursor: pointer;
            z-index: 2;
            position: relative;
        }

        .image img {
            max-width: 100%;
            height: auto;
            transition: transform 0.2s ease-in-out;
        }

        .image:hover img {
            transform: scale(1.05);
        }

        .image-border {
            position: absolute;
            top: 25px;
            left: 25px;
            right: 25px;
            bottom: 450px;
            background-color: rgba(128, 128, 128, 0.5);
        }

        .div {
            display: grid;
            grid-gap: 20px;
            position: relative;
            z-index: 3;
        }
    </style>
