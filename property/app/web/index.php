<?php
    include 'business/services/PropertyService.php';
    include 'business/services/CategoryService.php';
    $filter = $_GET['filter'] ?? null;
    if(isset($_GET['search'])){
        if(!$filter){
            $filter = "1=1";
        }
        $filter = $filter." AND title LIKE '%".$_GET['search']."%' OR description LIKE '%".$_GET['search']."%'";
    }
    $properties = propertyGetAllWhere($filter ?? null, $_GET['sort'] ?? null);
    $categories = categoryGetAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Property</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style>
    :root {
    --first-color: #4E1116;
    --black-color: #000;
    --white-color: #FFF;
    }
    .first {
    background-color: var(--first-color);
    }

    .second {
    background-color: var(--first-color);
    left: 33.3%;
    }

    .third {
    background-color: var(--first-color);
    left: 66.6%;
    }

        .max-height-slide{
            max-height:500px;
        }
    </style>
</head>
<body>
        <div class="overlay first"></div>
        <div class="overlay second"></div>
        <div class="overlay third"></div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <!-- <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button> -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="?route=/">Home <span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0" action="">
                <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                
            </form>
        </div>
    </nav>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
            <img class="d-block w-100 max-height-slide" src="public/img/1622047946.png" alt="First slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100 max-height-slide" src="public/img/1622047946.png" alt="Second slide">
            </div>
            <div class="carousel-item">
            <img class="d-block w-100 max-height-slide" src="public/img/1622047946.png" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="mt-5"></div>
    <?php $i = 0; ?>
    <div class="container mt-3 mb-5">
        <h3>Properties</h3>
        <hr/>
        <?php foreach($properties as $key => $value){?>
        <?php if($i==0){
            echo '<div class="row">';
        }
        ?>
            <div class="col-md-6 mt-5">
                <div class="card">
                    <img class="card-img-top" style="height:300px" src="<?=$value['image']?>">
                    <div class="card-body">
                        <h5 class="card-title"><?=$value['title']?></h5>
                        <h6><?=$value['created_at']?> | Rp. <?=$value['price']?> | Category: <?=categoryGetOneByID($value['category_id'])['name'] ?></h6>
                        <p class="card-text"><?=substr($value['description'],0 , 200)?><?php if(strlen($value['description'])>200){echo "....";}?></p>
                        <a href="#" class="btn btn-block btn-primary" data-toggle="modal" data-target="#modal-<?=$value['id']?>">Details</a>
                    </div>
                </div>
            </div>
        

         <!-- Modal -->
         <div class="modal fade bd-example-modal-lg" id="modal-<?=$value['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?=$value['title']?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <img class="img-thumbnail" src="<?=$value['image']?>">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?=$value['created_at']?> | <?=categoryGetOneByID($value['category_id'])['name'] ?> |  <strong><?=$value['owner_name']?></strong> (<?=$value['owner_contact']?>)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            Rp. <?=$value['price']?>
                        </div>
                    </div>
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <?=$value['description']?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
        </div>

        <?php
        $i++;
        if($i==2){
            echo '</div>';
            $i=0;
        } 
        }   
        ?>
    </div>

    <div class="mt-3">
        <hr/>
    </div>

    <nav class="navbar fixed-bottom navbar-light bg-light">
        <!-- <div class="ml-0">
            <div class="btn btn-primary">
                <<
            </div>
        </div> -->
        <div class="mx-auto">
            <!-- Default dropup button -->
            <div class="btn-group dropup">
            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Filter
            </button>
            <div class="dropdown-menu">
                <!-- Dropdown menu links -->
                <a class="dropdown-item" href="?sort&filter">All</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="?sort=created_at DESC">Newest</a>
                <a class="dropdown-item" href="?sort=created_at ASC">Oldest</a>
                <a class="dropdown-item" href="?sort=price DESC">Highest Price</a>
                <a class="dropdown-item" href="?sort=price ASC">Lowest Price</a>
                <div class="dropdown-divider"></div>
                <?php foreach($categories as $v){?>
                    <a class="dropdown-item" href="?filter=category_id=<?=$v['id']?>"><?=$v['name']?></a>
                <?php } ?>
            </div>
            </div>
        </div>
        <div class="mr-0">
                <?php if(!isLoginGetToken()){ ?>
                    <a href="?route=login" class="btn btn-outline-primary">Login</a>
                <?php }else{ ?>
                    <a href="?route=admin" class="btn btn-outline-primary">Admin Dashboard</a>
                <?php } ?>
        </div>
    </nav>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.2.4/gsap.min.js"></script>

<script src="public/js/main.js"></script>

</body>
</html>