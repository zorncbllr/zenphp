<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
    <h1><?= $msg ?></h1>

    <form action="/" method="post">
        <input type="text" name="text" placeholder="type something...">
        <button type="submit">submit</button>
    </form>
</body>

</html>