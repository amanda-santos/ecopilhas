// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("situacao");
var regulares = document.getElementById("numSociosRegulares");
var atraso = document.getElementById("numSociosAtraso");
var inadimplentes = document.getElementById("numSociosInadimplentes");

var situacao = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Regular", "Em Atraso", "Inadimplente"],
    datasets: [{
      data: [regulares.value, atraso.value, inadimplentes.value],
      backgroundColor: ['#007bff', 'yellow', '#dc3545'],
    }],
  },
});
