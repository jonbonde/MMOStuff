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
        <!-- <div class="grid grid-cols-4 gap-4"> -->
            <h1 class="text-3xl font-bold">GW2 Stuff</h1>
        <!-- </div> -->
        <div id="charactersDiv" class="flex flex-col">
        </div>
        <?php
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.guildwars2.com/v2/characters?ids=all',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Authorization: Bearer '
                ),
            ));

            $response = curl_exec($curl);

            if (curl_errno($curl)) {
                echo 'Error: ' . curl_error($curl);
            }
            curl_close($curl);
        ?>
        <script>
            const data = <?php echo $response; ?>;
            console.log(typeof data);
            console.log("Dette er data: ", data);
        </script>
    </div>
</body>
</html>