function show() {
    getSelectValue = document.getElementById("ramo").value;
    if (getSelectValue == "gmm" || getSelectValue == "siniestros" || getSelectValue == "autos") {
        document.getElementById("datosRamos").style.display = "block";
        document.getElementById("datosVida").style.display = "none";
    } else if (getSelectValue == "vida") {
        document.getElementById("datosRamos").style.display = "none";
        document.getElementById("datosVida").style.display = "block";
    }
}

function showDatos() {
    getSelectValue = document.getElementById("selectGoV").value;
    if (getSelectValue == "general") {
        document.getElementById("datosGenerales").style.display = "block";
        document.getElementById("datosIndividuales").style.display = "none";
    } if (getSelectValue == "individual") {
        document.getElementById("datosGenerales").style.display = "none";
        document.getElementById("datosIndividuales").style.display = "block";
    }
}

// GENERAL
function showGeneral() {
    periodo = document.getElementById("periodoGeneral").value;
    if (periodo == "semanal") {
        document.getElementById('semanalG').style.display = "block";
        document.getElementById('mensualG').style.display = "none";
        document.getElementById('cuatrimestralG').style.display = "none";
        document.getElementById('semestralG').style.display = "none";
        document.getElementById("yearG").style.display = "none";
    } else if (periodo == "mensual") {
        document.getElementById('semanalG').style.display = "none";
        document.getElementById('mensualG').style.display = "block";
        document.getElementById('cuatrimestralG').style.display = "none";
        document.getElementById('semestralG').style.display = "none";
    } else if (periodo == "cuatrimestral") {
        document.getElementById('semanalG').style.display = "none";
        document.getElementById('mensualG').style.display = "none";
        document.getElementById('cuatrimestralG').style.display = "block";
        document.getElementById('semestralG').style.display = "none";
    } else if (periodo == "semestral") {
        document.getElementById('semanalG').style.display = "none";
        document.getElementById('mensualG').style.display = "none";
        document.getElementById('cuatrimestralG').style.display = "none";
        document.getElementById('semestralG').style.display = "block";
    } else if (periodo == "anual") {
        document.getElementById('semanalG').style.display = "none";
        document.getElementById('mensualG').style.display = "none";
        document.getElementById('cuatrimestralG').style.display = "none";
        document.getElementById('semestralG').style.display = "none";
        document.getElementById("yearG").style.display = "block";
    }
}

function showYearG() {
    document.getElementById("yearG").style.display = "block";
}

function enviarDato() {
    var ramo = document.getElementById('ramo').value;
    var periodoGen = document.getElementById('periodoGeneral').value;
    var periodoSemG1 = document.getElementById('date1Sg').value;
    var periodoSemG2 = document.getElementById('date2Sg').value;
    var periodoMg = document.getElementById('periodoMensualG').value;
    var periodoCg = document.getElementById('periodoCuatrimestralG').value;
    var periodoSg = document.getElementById('periodoSemestralG').value;
    var yearGen = document.getElementById('yearGeneral').value;

    var datosGenerales = '&ramo=' + ramo + '&periodoGeneral=' + periodoGen + '&date1Sg=' + periodoSemG1 + '&date2Sg=' + periodoSemG2 + '&periodoMensualG=' + periodoMg + '&periodoCuatrimestralG=' + periodoCg + '&periodoSemestralG=' + periodoSg + '&yearGeneral=' + yearGen;

    if (ramo == "gmm") {
        if (periodoGen == "semanal") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("resp_G").style.display = "none";
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
                document.getElementById("resp_G").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_gmm_resultGeneral_gdd.php',
                    data: datosGenerales,
                    success: function (resp) {
                        $('#resp_G').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoGen == "mensual" || periodoGen == "cuatrimestral" || periodoGen == "semestral" || periodoGen == "anual") {
            document.getElementById("resp_G").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_gmm_resultGeneral_gdd.php',
                data: datosGenerales,
                success: function (resp) {
                    $('#resp_G').html(resp);
                }
            });
            return false;
        }
    } else if (ramo == "siniestros") {
        if (periodoGen == "semanal") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("resp_G").style.display = "none";
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
                document.getElementById("resp_G").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_s_resultGeneral_gdd.php',
                    data: datosGenerales,
                    success: function (resp) {
                        $('#resp_G').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoGen == "mensual" || periodoGen == "cuatrimestral" || periodoGen == "semestral" || periodoGen == "anual") {
            document.getElementById("resp_G").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_s_resultGeneral_gdd.php',
                data: datosGenerales,
                success: function (resp) {
                    $('#resp_G').html(resp);
                }
            });
            return false;
        }
    } else if (ramo == "autos") {
        if (periodoGen == "semanal") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("resp_G").style.display = "none";
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
                document.getElementById("resp_G").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_a_resultGeneral_gdd.php',
                    data: datosGenerales,
                    success: function (resp) {
                        $('#resp_G').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoGen == "mensual" || periodoGen == "cuatrimestral" || periodoGen == "semestral" || periodoGen == "anual") {
            document.getElementById("resp_G").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_a_resultGeneral_gdd.php',
                data: datosGenerales,
                success: function (resp) {
                    $('#resp_G').html(resp);
                }
            });
            return false;
        }
    }
}

// INDIVIDUAL
function showIndividual() {
    periodo = document.getElementById("periodoInd").value;
    document.getElementById('periodoIndividual').style.display = "block";
    if (periodo == "semanalInd") {
        document.getElementById('semanalInd').style.display = "block";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestralInd').style.display = "none";
        document.getElementById("yearInd").style.display = "none";
    } else if (periodo == "mensualInd") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "block";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestralInd').style.display = "none";
    } else if (periodo == "cuatrimestralInd") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "block";
        document.getElementById('semestralInd').style.display = "none";
    } else if (periodo == "semestralInd") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestralInd').style.display = "block";
    } else if (periodo == "anualInd") {
        document.getElementById('semanalInd').style.display = "none";
        document.getElementById('mensualInd').style.display = "none";
        document.getElementById('cuatrimestralInd').style.display = "none";
        document.getElementById('semestralInd').style.display = "none";
        document.getElementById("yearInd").style.display = "block";
    }
}

function showYearInd() {
    document.getElementById("yearInd").style.display = "block";
}

function enviarIndividual() {
    var ramo = document.getElementById('ramo').value;
    var agente = document.getElementById('agente').value;
    var periodoInd = document.getElementById('periodoInd').value;
    var periodoSemInd1 = document.getElementById('date1Sind').value;
    var periodoSemInd2 = document.getElementById('date2Sind').value;
    var periodoMind = document.getElementById('periodoMensualInd').value;
    var periodoCind = document.getElementById('periodoCuatrimestralInd').value;
    var periodoSind = document.getElementById('periodoSemestralInd').value;
    var yearInd = document.getElementById('yearIndividual').value;

    var datosIndividuales = '&ramo=' + ramo + '&agente=' + agente + '&periodoInd=' + periodoInd + '&date1Sind=' + periodoSemInd1 + '&date2Sind=' + periodoSemInd2 + '&periodoMensualInd=' + periodoMind + '&periodoCuatrimestralInd=' + periodoCind + '&periodoSemestralInd=' + periodoSind + '&yearIndividual=' + yearInd;

    if (ramo == "gmm") {
        if (periodoInd == "semanalInd") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("resp_Ind").style.display = "none";
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
                document.getElementById("resp_Ind").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_gmm_resultIndividual_gdd.php',
                    data: datosIndividuales,
                    success: function (resp) {
                        $('#resp_Ind').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoInd == "mensualInd" || periodoInd == "cuatrimestralInd" || periodoInd == "semestralInd" || periodoInd == "anualInd") {
            document.getElementById("resp_Ind").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_gmm_resultIndividual_gdd.php',
                data: datosIndividuales,
                success: function (resp) {
                    $('#resp_Ind').html(resp);
                }
            });
            return false;
        }
    } if (ramo == "siniestros") {
        if (periodoInd == "semanalInd") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("resp_Ind").style.display = "none";
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
                document.getElementById("resp_Ind").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_s_resultIndividual_gdd.php',
                    data: datosIndividuales,
                    success: function (resp) {
                        $('#resp_Ind').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoInd == "mensualInd" || periodoInd == "cuatrimestralInd" || periodoInd == "semestralInd" || periodoInd == "anualInd") {
            document.getElementById("resp_Ind").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_s_resultIndividual_gdd.php',
                data: datosIndividuales,
                success: function (resp) {
                    $('#resp_Ind').html(resp);
                }
            });
            return false;
        }
    } if (ramo == "autos") {
        if (periodoInd == "semanalInd") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("resp_Ind").style.display = "none";
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
                document.getElementById("resp_Ind").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_a_resultIndividual_gdd.php',
                    data: datosIndividuales,
                    success: function (resp) {
                        $('#resp_Ind').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoInd == "mensualInd" || periodoInd == "cuatrimestralInd" || periodoInd == "semestralInd" || periodoInd == "anualInd") {
            document.getElementById("resp_Ind").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_a_resultIndividual_gdd.php',
                data: datosIndividuales,
                success: function (resp) {
                    $('#resp_Ind').html(resp);
                }
            });
            return false;
        }
    }

}


// VIDA
function showDatosVida() {
    getSelectValue = document.getElementById("selectGoInd_v").value;
    if (getSelectValue == "generalVida") {
        document.getElementById("datosGeneralesV").style.display = "block";
        document.getElementById("datosIndividualesV").style.display = "none";
    } if (getSelectValue == "individualVida") {
        document.getElementById("datosGeneralesV").style.display = "none";
        document.getElementById("datosIndividualesV").style.display = "block";
    }
}


// GENERAL 
function showGeneral_v() {
    periodo = document.getElementById("periodoGeneral_v").value;
    if (periodo == "semanalV") {
        document.getElementById('semanalG_v').style.display = "block";
        document.getElementById('mensualG_v').style.display = "none";
        document.getElementById('trimestralG_v').style.display = "none";
        document.getElementById('semestralG_v').style.display = "none";
        document.getElementById("yearG_v").style.display = "none";
    } else if (periodo == "mensualV") {
        document.getElementById('semanalG_v').style.display = "none";
        document.getElementById('mensualG_v').style.display = "block";
        document.getElementById('trimestralG_v').style.display = "none";
        document.getElementById('semestralG_v').style.display = "none";
    } else if (periodo == "trimestralV") {
        document.getElementById('semanalG_v').style.display = "none";
        document.getElementById('mensualG_v').style.display = "none";
        document.getElementById('trimestralG_v').style.display = "block";
        document.getElementById('semestralG_v').style.display = "none";
    } else if (periodo == "semestralV") {
        document.getElementById('semanalG_v').style.display = "none";
        document.getElementById('mensualG_v').style.display = "none";
        document.getElementById('trimestralG_v').style.display = "none";
        document.getElementById('semestralG_v').style.display = "block";
    } else if (periodo == "anualV") {
        document.getElementById('semanalG_v').style.display = "none";
        document.getElementById('mensualG_v').style.display = "none";
        document.getElementById('trimestralG_v').style.display = "none";
        document.getElementById('semestralG_v').style.display = "none";
        document.getElementById("yearG_v").style.display = "block";
    }
}

function showYearG_v() {
    document.getElementById("yearG_v").style.display = "block";
}

function enviarDato_v() {
    var ramo = document.getElementById('ramo').value;
    var periodoGen = document.getElementById('periodoGeneral_v').value;
    var periodoSemG1 = document.getElementById('date1Sg_v').value;
    var periodoSemG2 = document.getElementById('date2Sg_v').value;
    var periodoMg = document.getElementById('periodoMensualG_v').value;
    var periodoTg = document.getElementById('periodoTrimestralG_v').value;
    var periodoSg = document.getElementById('periodoSemestralG_v').value;
    var yearGen = document.getElementById('yearGeneral_v').value;

    var datosGenerales = '&ramo=' + ramo + '&periodoGeneral_v=' + periodoGen + '&date1Sg_v=' + periodoSemG1 + '&date2Sg_v=' + periodoSemG2 + '&periodoMensualG_v=' + periodoMg + '&periodoTrimestralG_v=' + periodoTg + '&periodoSemestralG_v=' + periodoSg + '&yearGeneral_v=' + yearGen;

    if (ramo == "vida") {
        if (periodoGen == "semanalV") {
            if (periodoSemG1 > periodoSemG2) {
                document.getElementById("resp_G_v").style.display = "none";
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
                document.getElementById("resp_G_v").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_v_resultGeneral_gdd.php',
                    data: datosGenerales,
                    success: function (resp) {
                        $('#resp_G_v').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoGen == "mensualV" || periodoGen == "trimestralV" || periodoGen == "semestralV" || periodoGen == "anualV") {
            document.getElementById("resp_G_v").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_v_resultGeneral_gdd.php',
                data: datosGenerales,
                success: function (resp) {
                    $('#resp_G_v').html(resp);
                }
            });
            return false;
        }
    }

}

// INDIVIDUAL / VIDA
function showIndividual_v() {
    periodo = document.getElementById("periodoInd_v").value;
    document.getElementById('periodoIndividual_v').style.display = "block";
    if (periodo == "semanalIndV") {
        document.getElementById('semanalInd_v').style.display = "block";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestralInd_v').style.display = "none";
        document.getElementById("yearInd_v").style.display = "none";
    } else if (periodo == "mensualIndV") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "block";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestralInd_v').style.display = "none";
    } else if (periodo == "trimestralIndV") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "block";
        document.getElementById('semestralInd_v').style.display = "none";
    } else if (periodo == "semestralIndV") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestralInd_v').style.display = "block";
    } else if (periodo == "anualIndV") {
        document.getElementById('semanalInd_v').style.display = "none";
        document.getElementById('mensualInd_v').style.display = "none";
        document.getElementById('trimestralInd_v').style.display = "none";
        document.getElementById('semestralInd_v').style.display = "none";
        document.getElementById("yearInd_v").style.display = "block";
    }
}

function showYearInd_v() {
    document.getElementById("yearInd_v").style.display = "block";
}

function enviarIndividual_v() {
    var ramo = document.getElementById('ramo').value;
    var agente = document.getElementById('agente_v').value;
    var periodoInd = document.getElementById('periodoInd_v').value;
    var periodoSemInd1 = document.getElementById('date1Sind_v').value;
    var periodoSemInd2 = document.getElementById('date2Sind_v').value;
    var periodoMind = document.getElementById('periodoMensualInd_v').value;
    var periodoCind = document.getElementById('periodoTrimestralInd_v').value;
    var periodoSind = document.getElementById('periodoSemestralInd_v').value;
    var yearInd = document.getElementById('yearIndividual_v').value;

    var datosIndividuales = '&ramo=' + ramo + '&agente_v=' + agente + '&periodoInd_v=' + periodoInd + '&date1Sind_v=' + periodoSemInd1 + '&date2Sind_v=' + periodoSemInd2 + '&periodoMensualInd_v=' + periodoMind + '&periodoTrimestralInd_v=' + periodoCind + '&periodoSemestralInd_v=' + periodoSind + '&yearIndividual_v=' + yearInd;

    if (ramo == "vida") {
        if (periodoInd == "semanalIndV") {
            if (periodoSemInd1 > periodoSemInd2) {
                document.getElementById("resp_Ind_v").style.display = "none";
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
                document.getElementById("resp_Ind_v").style.display = "block";
                $.ajax({
                    type: 'POST',
                    url: 'datoA_v_resultIndividual_gdd.php',
                    data: datosIndividuales,
                    success: function (resp) {
                        $('#resp_Ind_v').html(resp);
                    }
                });
                return false;
            }
        } else if (periodoInd == "mensualIndV" || periodoInd == "trimestralIndV" || periodoInd == "semestralIndV" || periodoInd == "anualIndV") {
            document.getElementById("resp_Ind_v").style.display = "block";
            $.ajax({
                type: 'POST',
                url: 'datoA_v_resultIndividual_gdd.php',
                data: datosIndividuales,
                success: function (resp) {
                    $('#resp_Ind_v').html(resp);
                }
            });
            return false;
        }
    }
}
