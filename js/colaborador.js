// RAMOS
function show() {
    getSelectValue = document.getElementById("ramo").value;
    //Muestra solo para ingresar la consulta de los ramos de GMM, Siniestros y Autos ocultando el de Vida
    if (getSelectValue == "2" || getSelectValue == "3" || getSelectValue == "4") {
        document.getElementById("ramosEstGam").style.display = "block";
        document.getElementById("ramosEstGam_v").style.display = "none";
    }
    //Muestra solo para ingresar la consulta del ramo Vida ocultando los demas
    if (getSelectValue == "1") {
        document.getElementById("ramosEstGam").style.display = "none";
        document.getElementById("ramosEstGam_v").style.display = "block";
    }
}

// AUTOS, GMM, SINIESTROS - funcion para el apartado de consulta en donde cada seleccion muestra algo diferente
function showDatos() {
    getSelectValue = document.getElementById("selec").value;
    if (getSelectValue == "1") {
        document.getElementById("dtGenerales").style.display = "block";
        document.getElementById("dtIndividual").style.display = "none";
        document.getElementById("respG").style.display = "block";
        document.getElementById("respInd").style.display = "none";
    }
    if (getSelectValue == "2") {
        document.getElementById("dtGenerales").style.display = "none";
        document.getElementById("dtIndividual").style.display = "block";
        document.getElementById("respG").style.display = "none";
        document.getElementById("respInd").style.display = "block";
    }
}

// GENERAL - funcion para el apartado de periodo en donde cada seleccion muestra algo diferente 
function showInp2() {
    periodo = document.getElementById("periodoGeneral").value;
    if (periodo == "7") {
        document.getElementById('semanal').style.display = "block";
        document.getElementById('mensual').style.display = "none";
        document.getElementById('cuatrimestral').style.display = "none";
        document.getElementById('semestre').style.display = "none";
        document.getElementById("year").style.display = "none";
    } else if (periodo == "1") {
        document.getElementById('semanal').style.display = "none";
        document.getElementById('mensual').style.display = "block";
        document.getElementById('cuatrimestral').style.display = "none";
        document.getElementById('semestre').style.display = "none";
    } else if (periodo == "4") {
        document.getElementById('semanal').style.display = "none";
        document.getElementById('mensual').style.display = "none";
        document.getElementById('cuatrimestral').style.display = "block";
        document.getElementById('semestre').style.display = "none";
    } else if (periodo == "5") {
        document.getElementById('semanal').style.display = "none";
        document.getElementById('mensual').style.display = "none";
        document.getElementById('cuatrimestral').style.display = "none";
        document.getElementById('semestre').style.display = "block";
    } else if (periodo == "6") {
        document.getElementById('semanal').style.display = "none";
        document.getElementById("mensual").style.display = "none";
        document.getElementById('cuatrimestral').style.display = "none";
        document.getElementById('semestre').style.display = "none";
        document.getElementById("year").style.display = "block";
    }
}

//Funcion para mostrar el periodo mensual
function year() {
    document.getElementById("year").style.display = "block";
}

//Ejecuta la funcionalidad del botón
function muestraGrafico() {
    document.getElementById("respG").style.display = "block";
    document.getElementById("respInd").style.display = "none";
}

//Funcion para asociar la funcion al formulario 
function enviarGeneral() {
    var ramo = document.getElementById('ramo').value;
    var periodoGeneral = document.getElementById('periodoGeneral').value;
    var periodoSemG1 = document.getElementById('date1Sg').value;
    var periodoSemG2 = document.getElementById('date2Sg').value;
    var periodoMensual = document.getElementById('periodoMensual').value;
    var periodoCuatrimestral = document.getElementById('periodoCuatrimestral').value;
    var periodoSemestral = document.getElementById('periodoSemestral').value;
    var año = document.getElementById('año').value;

    var dataenT = 'ramo=' + ramo + '&periodoGeneral=' + periodoGeneral + '&date1Sg=' + periodoSemG1 + '&date2Sg=' + periodoSemG2 + '&periodoMensual=' + periodoMensual + '&periodoCuatrimestral=' + periodoCuatrimestral + '&periodoSemestral=' + periodoSemestral + '&año=' + año;
    //Mostrara los datos de la consulta general para el ramo de GMM
    if (ramo == "2") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoGeneral == "7") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("respG").style.display = "none";
                document.getElementById("respG2").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemG1 <= periodoSemG2) {
                document.getElementById("respG").style.display = "block";
                document.getElementById("respG2").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneralGMM.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG').html(resp);
                    }
                });
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneralGMM2.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG2').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoGeneral == "1" || periodoGeneral == "4" || periodoGeneral == "5" || periodoGeneral == "6") {
            document.getElementById("respG").style.display = "block";
            document.getElementById("respG2").style.display = "block";
            //Muestra las graficas para GMM
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneralGMM.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneralGMM2.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG2').html(resp);
                }
            });
            return false;
        }
        //Muestra los resultados de la consulta general para el ramo de GMM
    } else if (ramo == "3") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoGeneral == "7") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("respG").style.display = "none";
                document.getElementById("respG2").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemG1 <= periodoSemG2) {
                document.getElementById("respG").style.display = "block";
                document.getElementById("respG2").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneralS.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneralS2.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG2').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoGeneral == "1" || periodoGeneral == "4" || periodoGeneral == "5" || periodoGeneral == "6") {
            document.getElementById("respG").style.display = "block";
            document.getElementById("respG2").style.display = "block";
            //Muestra las graficas para Siniestros
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneralS.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneralS2.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG2').html(resp);
                }
            });
            return false;
        }
        //Mostrara los datos de la consulta general para el ramo de Autos
    } else if (ramo == "4") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoGeneral == "7") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("respG").style.display = "none";
                document.getElementById("respG2").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemG1 <= periodoSemG2) {
                document.getElementById("respG").style.display = "block";
                document.getElementById("respG2").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneralA.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneralA2.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG2').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoGeneral == "1" || periodoGeneral == "4" || periodoGeneral == "5" || periodoGeneral == "6") {
            document.getElementById("respG").style.display = "block";
            document.getElementById("respG2").style.display = "block";
            //Muestra las graficas para Autos
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneralA.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneralA2.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG2').html(resp);
                }
            });
            return false;
        }
    }
}

//INDIVIDUAL - Mostrara los nombres de los agentes en la consulta
function showInp3() {
    periodo = document.getElementById("periodoInd").value;
    document.getElementById('individual').style.display = "block";
    if (periodo == "7") {
        document.getElementById('semanalInd').style.display = "block";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestreInd').style.display = "none";
        document.getElementById("yearInd").style.display = "none";
    } else if (periodo == "1") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "block";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestreInd').style.display = "none";
    } else if (periodo == "4") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "block";
        document.getElementById('semestreInd').style.display = "none";
    } else if (periodo == "5") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestreInd').style.display = "block";
    } else if (periodo == "6") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestreInd').style.display = "none";
        document.getElementById("yearInd").style.display = "block";
    }
}

//Funcion para mostrar el periodo mensual
function yearInd() {
    document.getElementById("yearInd").style.display = "block";
}

//Ejecuta la funcionalidad del botón
function muestraGrafico2() {
    document.getElementById("respG").style.display = "none";
    document.getElementById("respInd").style.display = "block";
}

//Funcion para asociar la funcion al formulario 
function enviarIndividual() {
    var ramo = document.getElementById('ramo').value;
    var agente = document.getElementById('agente').value;
    var periodoInd = document.getElementById('periodoInd').value;
    var periodoSemInd1 = document.getElementById('date1Sind').value;
    var periodoSemInd2 = document.getElementById('date2Sind').value;
    var periodoMensualInd = document.getElementById('periodoMensualInd').value;
    var periodoCuatrimestralInd = document.getElementById('periodoCuatrimestralInd').value;
    var periodoSemestralInd = document.getElementById('periodoSemestralInd').value;
    var añoInd = document.getElementById('añoInd').value;

    var dataenInd = 'ramo=' + ramo + '&agente=' + agente + '&periodoInd=' + periodoInd + '&date1Sind=' + periodoSemInd1 + '&date2Sind=' + periodoSemInd2 + '&periodoMensualInd=' + periodoMensualInd + '&periodoCuatrimestralInd=' + periodoCuatrimestralInd + '&periodoSemestralInd=' + periodoSemestralInd + '&añoInd=' + añoInd;

    //Mostrara los datos de la consulta individual para el ramo de GMM
    if (ramo == "2") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoInd == "7") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("respInd").style.display = "none";
                document.getElementById("respInd2").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemInd1 <= periodoSemInd2) {
                document.getElementById("respInd").style.display = "block";
                document.getElementById("respInd2").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividualGMM.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividualGMM2.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd2').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoInd == "1" || periodoInd == "4" || periodoInd == "5" || periodoInd == "6") {
            document.getElementById("respInd").style.display = "block";
            document.getElementById("respInd2").style.display = "block";
            //Muestra las graficas para GMM individual
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividualGMM.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividualGMM2.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd2').html(resp);
                }
            });
            return false;
        }
        //Mostrara los datos de la consulta individual para el ramo de Siniestros
    } else if (ramo == "3") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoInd == "7") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("respInd").style.display = "none";
                document.getElementById("respInd2").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemInd1 <= periodoSemInd2) {
                document.getElementById("respInd").style.display = "block";
                document.getElementById("respInd2").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividualS.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividualS2.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd2').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoInd == "1" || periodoInd == "4" || periodoInd == "5" || periodoInd == "6") {
            document.getElementById("respInd").style.display = "block";
            document.getElementById("respInd2").style.display = "block";
            //Muestra las graficas para Siniestros individual
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividualS.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividualS2.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd2').html(resp);
                }
            });
            return false;
        }
        //Mostrara los datos de la consulta individual para el ramo de Autos
    } else if (ramo == "4") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoInd == "7") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("respInd").style.display = "none";
                document.getElementById("respInd2").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemInd1 <= periodoSemInd2) {
                document.getElementById("respInd").style.display = "block";
                document.getElementById("respInd2").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividualA.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividualA2.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd2').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoInd == "1" || periodoInd == "4" || periodoInd == "5" || periodoInd == "6") {
            document.getElementById("respInd").style.display = "block";
            document.getElementById("respInd2").style.display = "block";
            //Muestra las graficas para Autos individual
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividualA.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividualA2.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd2').html(resp);
                }
            });
            return false;
        }
    }
}


// VIDA - funcion para el apartado de consulta en donde cada seleccion muestra algo diferente
function showDatos_v() {
    getSelectValue = document.getElementById("selec_v").value;
    if (getSelectValue == "1_v") {
        document.getElementById("dtGenerales_v").style.display = "block";
        document.getElementById("dtIndividual_v").style.display = "none";
        document.getElementById("respG_v").style.display = "block";
        document.getElementById("respInd_v").style.display = "none";
    }
    if (getSelectValue == "2_v") {
        document.getElementById("dtGenerales_v").style.display = "none";
        document.getElementById("dtIndividual_v").style.display = "block";
        document.getElementById("respG_v").style.display = "none";
        document.getElementById("respInd_v").style.display = "block";
    }
}

// GENERAL - funcion para el apartado de periodo en donde cada seleccion muestra algo diferente 
function showInp2_v() {
    periodo = document.getElementById("periodoGeneral_v").value;
    if (periodo == "7_v") {
        document.getElementById('semanal_v').style.display = "block";
        document.getElementById('mensual_v').style.display = "none";
        document.getElementById('trimestral_v').style.display = "none";
        document.getElementById('semestre_v').style.display = "none";
        document.getElementById("year_v").style.display = "none";
    } else if (periodo == "1_v") {
        document.getElementById('semanal_v').style.display = "none";
        document.getElementById('mensual_v').style.display = "block";
        document.getElementById('trimestral_v').style.display = "none";
        document.getElementById('semestre_v').style.display = "none";
    } else if (periodo == "3_v") {
        document.getElementById('semanal_v').style.display = "none";
        document.getElementById('mensual_v').style.display = "none";
        document.getElementById('trimestral_v').style.display = "block";
        document.getElementById('semestre_v').style.display = "none";
    } else if (periodo == "5_v") {
        document.getElementById('semanal_v').style.display = "none";
        document.getElementById('mensual_v').style.display = "none";
        document.getElementById('trimestral_v').style.display = "none";
        document.getElementById('semestre_v').style.display = "block";
    } else if (periodo == "6_v") {
        document.getElementById('semanal_v').style.display = "none";
        document.getElementById("mensual_v").style.display = "none";
        document.getElementById('trimestral_v').style.display = "none";
        document.getElementById('semestre_v').style.display = "none";
        document.getElementById("year_v").style.display = "block";
    }
}

//Funcion para mostrar el periodo mensual
function yearG_v() {
    document.getElementById("year_v").style.display = "block";
}

//Funcion para asociar la funcion al formulario 
function enviarGeneral_v() {
    var ramo = document.getElementById('ramo').value;
    var periodoGeneral_v = document.getElementById('periodoGeneral_v').value;
    var periodoSemG1_v = document.getElementById('date1Sg_v').value;
    var periodoSemG2_v = document.getElementById('date2Sg_v').value;
    var periodoMensual_v = document.getElementById('periodoMensual_v').value;
    var periodoTrimestral_v = document.getElementById('periodoTrimestral_v').value;
    var periodoSemestral_v = document.getElementById('periodoSemestral_v').value;
    var año_v = document.getElementById('año_v').value;

    var dataenT = 'ramo=' + ramo + '&periodoGeneral_v=' + periodoGeneral_v + '&date1Sg_v=' + periodoSemG1_v + '&date2Sg_v=' + periodoSemG2_v + '&periodoMensual_v=' + periodoMensual_v + '&periodoTrimestral_v=' + periodoTrimestral_v + '&periodoSemestral_v=' + periodoSemestral_v + '&año_v=' + año_v;

    //Mostrara los datos de la consulta general para el ramo de Vida
    if (ramo == "1") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoGeneral_v == "7_v") {
            if (periodoSemG1_v > periodoSemG2_v) {
                document.getElementById("respG_v").style.display = "none";
                document.getElementById("respG2_v").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemG1_v <= periodoSemG2_v) {
                document.getElementById("respG_v").style.display = "block";
                document.getElementById("respG2_v").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneral.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG_v').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultGeneral2.php',
                    data: dataenT,
                    success: function(resp) {
                        $('#respG2_v').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas para mensual, cuatrimestral, semestral y anual
        } else if (periodoGeneral_v == "1_v" || periodoGeneral_v == "3_v" || periodoGeneral_v == "5_v" || periodoGeneral_v == "6_v") {
            document.getElementById("respG_v").style.display = "block";
            document.getElementById("respG2_v").style.display = "block";
            //Muestra las graficas para Vida
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneral.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG_v').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultGeneral2.php',
                data: dataenT,
                success: function(resp) {
                    $('#respG2_v').html(resp);
                }
            });
            return false;
        }
    }

}

//Ejecuta la funcionalidad del botón
function muestraGraficoG_v() {
    document.getElementById("respG_v").style.display = "block";
    document.getElementById("respInd_v").style.display = "none";
}

// INDIVIDUAL - funcion para el apartado de consulta individual en donde cada seleccion muestra algo diferente
function showInp3_v() {
    periodo = document.getElementById("periodoInd_v").value;
    document.getElementById('individual_v').style.display = "block";
    if (periodo == "7ind_v") {
        document.getElementById('semanalInd_v').style.display = "block";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestreInd_v').style.display = "none";
        document.getElementById("yearInd_v").style.display = "none";
    } else if (periodo == "1ind_v") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "block";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestreInd_v').style.display = "none";
    } else if (periodo == "3ind_v") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "block";
        document.getElementById('semestreInd_v').style.display = "none";
    } else if (periodo == "5ind_v") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestreInd_v').style.display = "block";
    } else if (periodo == "6ind_v") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestreInd_v').style.display = "none";
        document.getElementById("yearInd_v").style.display = "block";
    }
}

//Funcion para mostrar el periodo mensual individual
function yearInd_v() {
    document.getElementById("yearInd_v").style.display = "block";
}

//Ejecuta la funcionalidad del botón
function muestraGrafico2_v() {
    document.getElementById("respG_v").style.display = "none";
    document.getElementById("respInd_v").style.display = "block";
}

//Funcion para asociar la funcion al formulario individual
function enviarIndividual_v() {
    var ramo = document.getElementById('ramo').value;
    var agente_v = document.getElementById('agente_v').value;
    var periodoInd_v = document.getElementById('periodoInd_v').value;
    var periodoSemInd1_v = document.getElementById('date1Sind_v').value;
    var periodoSemInd2_v = document.getElementById('date2Sind_v').value;
    var periodoMensualInd_v = document.getElementById('periodoMensualInd_v').value;
    var periodoTrimestralInd_v = document.getElementById('periodoTrimestralInd_v').value;
    var periodoSemestralInd_v = document.getElementById('periodoSemestralInd_v').value;
    var añoInd_v = document.getElementById('añoInd_v').value;

    var dataenInd = 'ramo=' + ramo + '&agente_v=' + agente_v + '&periodoInd_v=' + periodoInd_v + '&date1Sind_v=' + periodoSemInd1_v + '&date2Sind_v=' + periodoSemInd2_v + '&periodoMensualInd_v=' + periodoMensualInd_v + '&periodoTrimestralInd_v=' + periodoTrimestralInd_v + '&periodoSemestralInd_v=' + periodoSemestralInd_v + '&añoInd_v=' + añoInd_v;

    //Mostrara los datos de la consulta general para el ramo de Vida
    if (ramo == "1") {
        //Valida si las fechas ingresadas en la consulta personalizada estan correctas
        if (periodoInd_v == "7ind_v") {
            if (periodoSemInd1_v > periodoSemInd2_v) {
                document.getElementById("respInd_v").style.display = "none";
                document.getElementById("respInd2_v").style.display = "none";
                swal({
                    title: "¡Error!",
                    text: "Verifica que las fechas esten bien ingresadas",
                    type: "error",
                    customClass: 'swal-wide',
                    allowOutsideClick: false
                });
                hasError = true;
                return false;
            } else if (periodoSemInd1_v <= periodoSemInd2_v) {
                document.getElementById("respInd_v").style.display = "block";
                document.getElementById("respInd2_v").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividual.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd_v').html(resp);
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: 'colaborador_resultIndividual2.php',
                    data: dataenInd,
                    success: function(resp) {
                        $('#respInd2_v').html(resp);
                    }
                });
                return false;
            }
            //Arroja las consultas individual para mensual, cuatrimestral, semestral y anual
        } else if (periodoInd_v == "1ind_v" || periodoInd_v == "3ind_v" || periodoInd_v == "5ind_v" || periodoInd_v == "6ind_v") {
            document.getElementById("respInd_v").style.display = "block";
            document.getElementById("respInd2_v").style.display = "block";
            //Muestra las graficas para Vida
            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividual.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd_v').html(resp);
                }
            });

            $.ajax({
                type: 'POST',
                url: 'colaborador_resultIndividual2.php',
                data: dataenInd,
                success: function(resp) {
                    $('#respInd2_v').html(resp);
                }
            });
            return false;
        }
    }

}