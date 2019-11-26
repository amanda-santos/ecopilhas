// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("marcasChart");
var numBrasil = document.getElementById("numBrasil");
var numJapao = document.getElementById("numJapao");
var numChina = document.getElementById("numChina");
var numEUA = document.getElementById("numEUA");
var numOutros = document.getElementById("numOutros");

var marcas = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Brasil", "Japão", "China", "EUA", "Outros"],
    datasets: [{
      data: [numBrasil.value, numJapao.value, numChina.value, numEUA.value, numOutros.value],
      backgroundColor: ['rgb(0,0,205)','rgb(0,100,0)','rgb(255,0,0)','rgb(255,255,0)','rgb(0,206,209)'],
    }],
  },
});
