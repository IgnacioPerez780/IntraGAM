<?php
error_reporting(E_ALL);
session_start();
include 'app/conexion.php';
$conexion = conexion();

//Redireccion al index si no se esta logueado
if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Intra GAM</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="librerias/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="icon" type="image/x-icon" href="img/logo_intra1.ico">
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_tutorial.css">
    <link rel="stylesheet" href="css/ventanaEmergente.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>

    <!-- Barra de navegacion -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img class="logoIntra" src="img/IntraGAM.png">
            </div>

            <!-- Define la zona que se colapsara (u ocultara) para pantallas pequeñas -->
            <div class="collapse navbar-collapse" id="myNavbar">
                <div class="iconos">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="salir.php"><span class="glyphicon glyphicon-log-in"></span> Salir</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="menu_agente.php"><span class="glyphicon glyphicon-menu-hamburger"></span> Men&uacute;</a></a>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <div class="dropdown">
                            <button type="button" data-toggle="dropdown"><span class="glyphicon glyphicon-save"></span> Material</button>
                            <ul class="dropdown-menu">
                                <li><a download="ManualDeErrores" href="ManualErrores_IntraGAM.pdf">Manual de Errores </a></li>
                                <li><a download="Instructivo_ActPerfil" href="Instructivo_sesion.pdf">Instructivo: Edici&oacute;n Perfil</a></li>
                            </ul>
                        </div>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a data-toggle="modal" data-target="#exampleModal" title="Informaci&oacute;n"><span class="glyphicon glyphicon-info-sign"></span> Informaci&oacute;n</li></a>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="preguntas-frecuentes.php"><span class="glyphicon glyphicon-question-sign"></span> Preguntas Frecuentes</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <!-- Modal con slider para mostrar apartados de importancia en el tutorial-->
    <div class="container">
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <section class="intro">
                            <div class="slider">
                                <ul>
                                    <li><img src="img/soporte_extra.png" class="imgSlider"></li>
                                    <li><img src="img/recom_extra.png" class="imgSlider"></li>
                                    <li><img src="img/sugerencia_extra.png" class="imgSlider"></li>
                                </ul>

                                <ul>
                                    <nav>
                                        <a href="#" class="siguiente"></a>
                                        <a href="#" class="siguiente"></a>
                                        <a href="#" class="siguiente"></a>
                                    </nav>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Muestra el video el cual viene compuesto de un tutorial para la plataforma -->
    <div class="container">
        <div class="video">
            <iframe class="videoTutorial" src="tutorial/intragam_tutorial.mp4" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>

</body>

</html>

<!-- Script del slider mostrado en el modal -->
<script>
    {
        class SliderClip {
            constructor(el) {
                this.el = el;
                this.Slides = Array.from(this.el.querySelectorAll('li'));
                this.Nav = Array.from(this.el.querySelectorAll('nav a'));
                this.totalSlides = this.Slides.length;
                this.current = 0;
                this.autoPlay = true; //true or false
                this.timeTrans = 7000; //trancision de tiempo en milisegundos
                this.IndexElements = [];

                for (let i = 0; i < this.totalSlides; i++) {
                    this.IndexElements.push(i);
                }

                this.setCurret();
                this.initEvents();
            }
            setCurret() {
                this.Slides[this.current].classList.add('current');
                this.Nav[this.current].classList.add('current_dot');
            }
            initEvents() {
                const self = this;

                this.Nav.forEach((dot) => {
                    dot.addEventListener('click', (ele) => {
                        ele.preventDefault();
                        this.changeSlide(this.Nav.indexOf(dot));
                    })
                })

                this.el.addEventListener('mouseenter', () => self.autoPlay = false);
                this.el.addEventListener('mouseleave', () => self.autoPlay = true);

                setInterval(function() {
                    if (self.autoPlay) {
                        self.current = self.current < self.Slides.length - 1 ? self.current + 1 : 0;
                        self.changeSlide(self.current);
                    }
                }, this.timeTrans);

            }
            changeSlide(index) {

                this.Nav.forEach((allDot) => allDot.classList.remove('current_dot'));

                this.Slides.forEach((allSlides) => allSlides.classList.remove('prev', 'current'));

                const getAllPrev = value => value < index;

                const prevElements = this.IndexElements.filter(getAllPrev);

                prevElements.forEach((indexPrevEle) => this.Slides[indexPrevEle].classList.add('prev'));

                this.Slides[index].classList.add('current');
                this.Nav[index].classList.add('current_dot');
            }
        }

        const slider = new SliderClip(document.querySelector('.slider'));
    }
</script>