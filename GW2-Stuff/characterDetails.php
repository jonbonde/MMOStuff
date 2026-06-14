<?php
$character = json_decode($_GET['id']);
$specIdsArr = array();
foreach ($character->specializations->pve as $spec) {
    $specIdsArr[] = $spec->id;
}

$env = parse_ini_file('../.env');
$gw2Key = $env['GW2_API_KEY'];
$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.guildwars2.com/v2/specializations?ids=' . implode(',', $specIdsArr),
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $gw2Key
    ),
));

$response = curl_exec($curl);

curl_close($curl);
?>
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
    <div id="container" class="flex mt-5 w-full items-center justify-center flex-col">
        <h1 id="title" class="text-3xl font-bold">GW2 Stuff</h1>
        <div id="specsDiv" class="flex flex-col">
            <div>Equiped specializations and traits</div>
        </div>
    </div>
    <script type="module">
        const params = new URLSearchParams(window.location.search);
        const character = JSON.parse(decodeURI(params.get("id")));
        console.log("character: ", character);
        document.getElementById('container').classList.add(`bg-[url('https://d3qqidoz8mm2hm.cloudfront.net/wp-content/uploads/wallpapers/GW2${character.profession}Painted-1920x1080.jpg')]`);

        document.getElementById('title').innerHTML = character.name;
        const specsDiv = document.getElementById('specsDiv');

        const specs = <?php echo $response ?>;
        console.log("specs: ", specs);
        specs.forEach((spec, index) => {
            specsDiv.innerHTML += `
                <div class="flex items-center relative h-[12em] w-[40em] mt-2">
                    <div class="absolute bg-bottom-left top-0 left-0 right-0 bottom-0 w-full h-full bg-[url(${spec.background})] title="${spec.name}" rounded">
                        <img class="absolute h-24 inset-0 my-auto top-5 left-20" src="${spec.icon}" title="${spec.name}" />
                    </div>
                </div>
            `;
        });
        // style="background-position-y: -43px; height: 13em; width: 41em;"
    </script>
</body>
</html>