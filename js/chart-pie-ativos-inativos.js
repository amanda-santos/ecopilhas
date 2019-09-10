// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("vinculo");
var ativos = document.getElementById("numSociosAtivos");
var inativos = document.getElementById("numSociosInativos");

var vinculo = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["Ativo", "Inativo"],
    datasets: [{
      data: [ativos.value, inativos.value],
      backgroundColor: ['#007bff', '#dc3545'],
    }],
  },
});
