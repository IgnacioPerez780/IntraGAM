<?php
error_reporting(0);
session_start();
include 'app/conexion.php';
$conexion = conexion();

if ($_SESSION['logged_in'] <> TRUE) {
    header('location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link rel="stylesheet" type="text/css" href="librerias/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="librerias/datatable/bootstrap.min.css">
    <title>Descarga de cotizadores</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Load font awesome icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- HOJAS DE ESTILO -->
    <link rel="stylesheet" href="css/hoja_cotizadores.css">
    <link rel="stylesheet" type="text/css" href="css/slider.css">

<!-- Chatra {literal}
<script>
    (function(d, w, c) {
        w.ChatraID = 'nhpkGLxTvJKpwhFt8';
        var s = d.createElement('script');
        w[c] = w[c] || function() {
            (w[c].q = w[c].q || []).push(arguments);
        };
        s.async = true;
        s.src = 'https://call.chatra.io/chatra.js';
        if (d.head) d.head.appendChild(s);
    })(document, window, 'Chatra');
</script> /Chatra {/literal} -->
</head>

<?php
include('plantillas/m_agente.php');
?>

<body>


    <!-- Modal -->
    <div class="container">
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <section class="intro">
                            <div class="slider">
                                <ul>
                                    <li><img src="img/cotizadores_aviso.png" class="imgSlider"></li>
                                    <li><img src="img/cotizadores_aviso2.png" class="imgSlider"></li>
                                </ul>

                                <ul>
                                    <nav>
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

    <!-- The social media icon bar -->
    <div class="wrapper">
        <ul class="iconBar">
            <li class="facebook">
                <a href="https://www.facebook.com/asesoresgam780">
                    <i class="fa fa-facebook" aria-hidden="true"></i>
                    <div class="slider">
                        <p>facebook</p>
                    </div>
                </a>
            </li>
            <li class="twitter">
                <a href="https://twitter.com/asesoresgam780">
                    <i class="fa fa-twitter" aria-hidden="true"></i>
                    <div class="slider">
                        <p>twitter</p>
                    </div>
                </a>
            </li>

            <li class="instagram">
                <a href="https://www.instagram.com/asesoresgam780/">
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                    <div class="slider">
                        <p>instagram</p>
                    </div>
                </a>
            </li>
            <li class="youtube">
                <a href="https://www.youtube.com/channel/UCtiG8e0Uufo4moCzM-R0Tpw/featured">
                    <i class="fa fa-youtube" aria-hidden="true"></i>
                    <div class="slider">
                        <p>youtube</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <!-- TABLA COTIZADORES GNP -->
    <div class="container">
        <table class="table text-center">
            <tr class="titulo">
                <td colspan=3>
                    <p><strong>COTIZADORES DESCARGABLES GNP</strong></p>
                </td>
            </tr>

            <tr class="secciones">
                <td style="width: 283px;">
                    <p><strong>Sistema Operativo</strong></p>
                </td>
                <td style="width: 283px;">
                    <p><strong>Cotizadores</strong></p>
                </td>
                <td style="width: 283px;">
                    <p><strong>Descargar</strong></p>
                </td>
            </tr>
            <tr class="material">
                <td>
                    <img class="img_mac_vida" src="img/sistema_mac.png">
                </td>
                <td>
                    <p>Vida</p>
                </td>
                <td>
                    <a href="cotizadores/Setup_Nautilus_MAC_3.1.5.109.pkg" target=" _blank" download="">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                    </a>
                </td>
            </tr>
            <tr class="material">
                <td>
                    <img class="img_windows_vida" src="img/sistema_windows.png">
                </td>
                <td>
                    <p>Vida</p>
                </td>
                <td>
                    <a href="cotizadores/Setup_Nautilus_WIN_3.1.5.109.msi" target=" _blank" download="">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                    </a>
                </td>
            </tr>
            <!-- <tr class="material">
                <td>
                    <img class="img_windows_gmm" src="img/sistema_windows.png">
                </td>
                <td>
                    <p>Gastos Médicos Mayores</p>
                </td>
                <td>
                    <a href="cotizadores/Setup_GNP_Movil_GMM_13.51.msi" target=" _blank" download="">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                    </a>
                </td>
            </tr>
            <tr class="material">
                <td>
                    <img class="img_windows_consola" src="img/sistema_windows.png">
                </td>
                <td>
                    <p>Consola GNP</p>
                </td>
                <td>
                    <a href="cotizadores/Setup_GNP_consola.msi" target=" _blank" download="">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                    </a>
                </td>
            </tr> -->
        </table>
    </div>

    <!-- TABLA COTIZADORES GAM -->
    <div class="container">
        <table class="table2 text-center">
            <tr class="titulo2">
                <td colspan=3>
                    <p><strong>COTIZADORES DESCARGABLES GAM</strong></p>
                </td>
            </tr>

            <tr class="secciones">
                <td style="width: 283px;">
                    <p><strong>Sistema Operativo</strong></p>
                </td>
                <td style="width: 283px;">
                    <p><strong>Cotizadores</strong></p>
                </td>
                <td style="width: 283px;">
                    <p><strong>Descargar</strong></p>
                </td>
            </tr>
            <tr class="material">
                <td>
                    <img class="img_mac_win" src="img/mac_win-cotizadores.png">
                </td>
                <td>
                    <p>Simulador: Ahorro para el retiro</p>
                </td>
                <td>
                    <a href="cotizadores/SIMULADOR AHORRO PARA RETIRO.xlsx" target=" _blank" download="">
                        <span class="btn btn-primary glyphicon glyphicon-download-alt"></span>
                    </a>
                </td>
            </tr>
        </table>
    </div>

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




        $(document).ready(function() {
            $('#myModal').modal('toggle')
        });
    </script>

</body>


</html>