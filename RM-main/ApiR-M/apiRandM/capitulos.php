<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Rick and morty</title>
    <!--CSS -->
    <link rel="stylesheet" href="style.css">
    <!--bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
    <div class="classM">
        <section class="container-fluid">
            <div class="row">
                <nav class="navbar navbar-expand-lg colorNav">
                    <div class="container-fluid ">
                        <a class="navbar-brand" href="./index.php">
                            <img src="./recursos/logNav.png" class="logoNav" alt=""> Rick and Morty</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="./personajes.php">Personajes</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Capitulos</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </section>
        <!--articulos-->
        <div class="text-center">
            <p class="fs-2 mt-4">Capitulos</p>
        </div>


        <div class="container">
            <div class="row">
            <?php
                if(isset($_GET["page"])){
                    $page=$_GET["page"] +=1;
                }else{
                    $page=1;
                }
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://rickandmortyapi.com/api/episode?page=".$page);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $head = curl_exec($ch);
                curl_close($ch);
                $data = json_decode($head);
                foreach ($data->results as $result) {
                    $name = $result->name;
                    $episode = $result->episode;
                    $air_date = $result->air_date;
                    echo "<style>
                    
                    </style>
                    <div class='col-12 col-md-6 col-lg-4 col-xl-3 mt-5'>
                    <div class='card mb-3'>
                            <div class='card-body'>
                                <h5 class='card-title'>$name</h5>
                                <p class='card-text'>Episode: $episode</p>
                                <p class='card-text'>Air date: $air_date</p>
                            </div>
                        </div>
                    </div>";
                }
                if($page > 1){
                    $back = $page-2;
                    echo"<form action='capitulos.php' method='get'>
                    <input type='text' style='display:none' name='page' value='$back'>
                    <input type='submit' value='<-'>
                </form>";
                }
                if($page < $data->info->pages){
                    echo"<form action='capitulos.php' method='get'>
                    <input type='text' style='display:none' name='page' value='$page'>
                    <input type='submit' value='->'>
                </form>";
                }
                                    
            ?>
            </div>
        </div>
</body>

</html>