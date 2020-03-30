<?php

$valores = json_decode($_POST['arreglo1']);
$nombres = json_decode($_POST['arreglo2']);

$datosY = json_encode($valores);
$datosX = json_encode($nombres);
?>

<div id="grafico-lineal"></div>
<div id="grafico-barras"></div>

<script>
    function crearcadenaLineal(json) {
        var parsed = JSON.parse(json);
        var arr = [];
        for (var x in parsed) {
            arr.push(parsed[x]);
        }
        return arr;
    }

    datosY = crearcadenaLineal('<?php echo $datosY ?>');
    nom_est = crearcadenaLineal('<?php echo $datosX ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo count($nombres) ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'scatter',
            name: nom_est[i],
        };

        arrayData.push(window["trace" + i]);
    }

    var layout = {
        title: 'Egresos COMGES',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 45,
            title: 'Meses'
        },
        yaxis: {
            title: 'Cantidad de egresos'
        },
    };

    Plotly.newPlot('grafico-lineal', arrayData, layout, {}, {
        showSendToCloud: true
    });
</script>

<!-- scrip grafico de barras -->

<script>
    datosY = crearcadenaLineal('<?php echo $datosY ?>');
    nom_est = crearcadenaLineal('<?php echo $datosX ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo count($nombres) ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'bar',
            name: nom_est[i],
            text: datosY[i].map(String),
            textposition: 'auto',
        };

        arrayData.push(window["trace" + i]);
    }

    var layout = {
        title: 'Egresos COMGES',
        barmode: 'group',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 45,
            title: 'Meses'
        },
        yaxis: {
            title: 'Cantidad de egresos'
        },
    };

    Plotly.newPlot('grafico-barras', arrayData, layout, {}, {
        showSendToCloud: true
    });
</script>