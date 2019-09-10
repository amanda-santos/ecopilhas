<?php
include("conexao.php"); //incluir arquivo com conexão ao banco de dados
//include("../testaAdmin.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>EcoPilhas</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor-main-website/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/main-website.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
  <link href="vendor-admin-website/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

  <!--BOOTSTRAP-->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!--EDITOR DE TEXTO CRKEDITOR-->
  <script type="text/javascript" src="ckeditor/ckeditor.js"></script>

  <!-- GALERIA -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css" />

  <style>
    @media (min-width: 800px) and (max-width: 850px) {
      .navbar:not(.top-nav-collapse) {
        background: #1C2331 !important;
      }
    }

    .carousel,
    .carousel .carousel-inner,
    .carousel .carousel-inner .active,
    .carousel .carousel-inner .carousel-item,
    .view,
    body,
    html {
      height: 98%
    }

    .page-footer,
    .top-nav-collapse {
      background-color: #1C2331
    }
  </style>

  <script type="text/javascript">
    new WOW().init();
  </script>

</head>

<body>

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top">

    <a class="navbar-brand" href="index.php"><img class="img-fluid rounded" src="imagens/mascote-ecopilhas.jpg" alt="" style="height: 50px;"></a>

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample09" aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExample09">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="" id="navLink" id="dropdown09" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sobre</a>
          <div class="dropdown-menu" aria-labelledby="dropdown09">
            <a class="dropdown-item" href="#">O Projeto</a>
            <a class="dropdown-item" href="#">Equipe</a>
            <a class="dropdown-item" href="#">Resoluções</a>
            <a class="dropdown-item" href="#">Logística Reversa</a>
            <a class="dropdown-item" href="#">EcoPilhas em Números</a>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#" id="navLink">Atividades</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#" id="navLink">Solicite um Coletor ou uma Palestra</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link js-scroll-trigger" href="#map" id="navLink">Mapa de Coletores de Pilhas</a>
        </li>
      </ul>
    </div>

  </nav>

  <!--Carousel Wrapper-->
  <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">

    <!--Slides-->
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <div class="carousel-item">
          <div class="view" style="background-position: center; background-image: url('imagens/mascote-ecopilhas.jpg'); background-repeat: no-repeat; background-size: cover;">

            <div class="d-flex justify-content-center align-items-center">
              <div class="col-12 text-center white-text mx-5 wow fadeIn">
                <h1 style="color:white;" class="mb-4">
                  <strong>Titulo</strong>
                </h1>
                <p style="padding-top: 0px; color:white; font-size: 25px;">
                  Legenda
                </p>
                <a target="_blank" href="" style="color:white;" class="btn btn-outline-white btn-lg">
                  <strong>
                    Saiba Mais
                  </strong>
                </a>
              </div>
              <!-- Content -->
            </div>
            <!-- Mask & flexbox options-->
          </div>
        </div>
        <!--/First slide-->
      </div>
      <!--/.Slides-->

      <!--Controls-->
      <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Próximo</span>
      </a>
      <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
      </a>
      <!--/.Controls-->

    </div>
    <!--/.Carousel Wrapper-->