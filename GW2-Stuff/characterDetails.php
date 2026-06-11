<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <a href='../' class="absolute bottom-5 left-5"><i class="fa fa-arrow-left" style="font-size:48px;"></i></a>
    <div class="flex mt-5 w-full items-center justify-center flex-col">
        <h1 id="title" class="text-3xl font-bold">GW2 Stuff</h1>
        <div id="charactersDiv" class="flex flex-col">
        </div>
    </div>
    <script type="module">
        const params = new URLSearchParams(window.location.search);
        const name = decodeURI(params.get("id"));

        document.getElementById('title').innerHTML = name;

        const character = JSON.parse(localStorage.getItem('gw2Characters')).find(char => char.name === name);
        console.log(typeof character);
        console.log("character: ", character);

        
    </script>
</body>
</html>
<?php
$name = $_GET['id'];
echo $name;
?>