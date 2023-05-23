<?php
error_reporting(0);
include 'app/conexion.php';
$conexion = conexion();
session_start();


if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Anton' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Neucha' rel='stylesheet' type='text/css'>
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" type="text/css" href="css/tabla_menu_agente.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_img_menu_agente.css">
    <link rel="stylesheet" type="text/css" href="css/estilos_generales_menu.css">
    <link rel="stylesheet" type="text/css" href="css/notificacionesIntraGAM.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<?php
// Cabecera que mostrara para los agentes
include('plantillas/cabecera_general_menuA.php');
?>

<body>

    <!-- Seccion para encuestas -->
    <!--<script>(function(w,d,s,u,f,m,n,o){o='https://survey.zohopublic.com';w[f]=w[f]||function(){(w[f].p=w[f].p||[]).push(arguments);};m=d.createElement(s),n=d.getElementsByTagName(s)[0];m.async=1;m.src=o+u;n.parentNode.insertBefore(m,n);zs_intercept(o,'gcD7SS',{"hideEndPage":true,"height":550});})(window, document, 'script', '/api/v1/public/livesurveys/gcD7SS/popup/script', 'zs_intercept');</script>-->

    <!-- Modal de notificaciones/Agentes -->
    <div class="container">
        <div class="modal fade" id="mostrarmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <section class="intro">
                            <div class="slider">
                                <ul>
                                    <li><img src="img/NotifIntra1.png" class="imgNotificaciones"></li>
                                    <!--<li><img src="img/aviso_pag.png" class="imgNotificaciones"></li></li>-->
                                    <li><img src="img/infoApp_gam.png" class="imgNotificaciones"></li>
                                    <li><img src="img/GNP.png" class="imgNotificaciones"></li>
                                    <!--<li><img src="img/image_6483441.JPG" class="imgNotificaciones"></li>-->
                                    <!--<li><img src="img/info_notif.png" class="imgNotificaciones"></li>-->
                                </ul>

                                <ul>
                                    <nav>
                                        <a href="#" class="siguiente"></a>
                                        <a href="#" class="siguiente"></a>
                                        <a href="#" class="siguiente"></a>
                                        <!--<a href="#" class="siguiente"></a>-->
                                        <!--<a href="#" class="siguiente"></a>-->
                                    </nav>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- The social media icon bar -->
    <div class="wrapper">
        <ul class="iconBar">
            <li class="facebook">
                <a target="_blank" href="https://www.facebook.com/asesoresgam780">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    <div class="slider">
                        <p>facebook</p>
                    </div>
                </a>
            </li>
            <li class="twitter">
                <a target="_blank" href="https://twitter.com/asesoresgam780">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <div class="slider">
                        <p>twitter</p>
                    </div>
                </a>
            </li>

            <li class="instagram">
                <a target="_blank" href="https://www.instagram.com/asesoresgam780/">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <div class="slider">
                        <p>instagram</p>
                    </div>
                </a>
            </li>
            <li class="youtube">
                <a target="_blank" href="https://www.youtube.com/channel/UCtiG8e0Uufo4moCzM-R0Tpw/featured">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                    <div class="slider">
                        <p>youtube</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <!-- TABLA/Menu -->
    <div class="container">
        <table class="table text-center">
            <tr>
                <td rowspan=3 id="td_vida">
                    <a href="agente.php" style="color:white">
                        <div class="div_vida">
                            <button type="button">
                                <label>VIDA</label>
                                <img class="img_vida" src="img/Vida x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td id="td_autos">
                    <a href="autosa.php" style="color:white">
                        <div class="div_auto">
                            <button type="button">
                                <label>AUTOS</label>
                                <img class="img_auto" src="img/Autos x4.png">
                            </button>
                        </div>
                    </a>
                </td>
                <td rowspan=2 id="td_apoyo">
                    <a href="material_agente.php" style="color:white">
                        <div class="div_apoyo">
                            <button type="button">
                                <label>MAT. DE APOYO</label>
                                <img class="img_m_apoyo" src="img/Material de apoyo.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td rowspan=2 id="td_siniestros">
                    <a href="siniestros.php" style="color:white">
                        <div class="div_siniestros">
                            <button type="button">
                                <label class="labelSiniestros">SINIESTROS</label>
                                <img class="img_siniestros" src="img/Siniestros x4.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td rowspan=2 id="td_descarga">
                    <a href="cotizadores.php" style="color:white">
                        <div class="div_descarga">
                            <button type="button">
                                <label>COTIZADORES</label>
                                <img class="img_descarga" src="img/Cotizador2.png">
                            </button>
                        </div>
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan=2 id="td_gmm">
                    <a href="gmmagen.php" style="color:white">
                        <button type="button"> GASTOS MÉDICOS MAYORES
                            <img class="img_gmm" src="img/GMM x4.png">
                        </button>
                    </a>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>

<!-- Script para activar modal -->
<script>
    $(document).ready(function() {
        $("#mostrarmodal").modal("show");
    });
</script>

<!-- Ventana Flotante de recordatorio -->
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
                this.timeTrans = 7000; //transition time in milliseconds
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


    // Mostrara y ocutla los elementos con id 'target'
    $(document).ready(function() {
        $('#myModal').modal('toggle')
    });
</script>