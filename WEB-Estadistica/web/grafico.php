<?php
$datos = json_decode($_POST['arreglo']);
var_dump($datos);

for ($i = 0; $i < count($datos); $i++) {
    for ($x = 0; $x < 12; $x++) {
        $datosY[$i][$x]=$datos[$i][$x+2];
    }
    $establecimientos[]=$datos[$i][0];
}
echo '<pre>';
print_r($datosY);
echo '</pre>';
echo '<pre>';
print_r($establecimientos);
echo '</pre>';

?>

<div id="grafico-lineal"></div>

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
    nom_est = crearcadenaLineal('<?php echo $establecimientos ?>');

    var arrayData = [];
    for (var i = 0; i < '<?php echo $cant_estable ?>'; i++) {

        window["trace" + i] = {
            x: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
            y: datosY[i],
            type: 'scatter',
            name: nom_est[i],
        };

        arrayData.push(window["trace" + i]);
    }
    var layout = {
        title: 'Porcentaje cumplimiento IAAPS',
        font: {
            family: 'Raleway, sans-serif'
        },
        xaxis: {
            tickangle: 0,
            title: 'Meses'
        },
        yaxis: {
            title: '% de  Cumplimiento'
        },
    };

    Plotly.newPlot('grafico-lineal', arrayData, layout, {}, {
        showSendToCloud: true
    });
</script>