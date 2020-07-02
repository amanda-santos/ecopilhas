// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Pie Chart Example
var ctx = document.getElementById("pesosChart");
var pesos2017 = document.getElementById("peso2017");
var pesos2018 = document.getElementById("peso2018");
var pesos2019 = document.getElementById("peso2019");

var vinculo = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: ["2017", "2018", "2019"],
    datasets: [{
      data: [pesos2017.value, pesos2018.value,pesos2019.value],
      backgroundColor: ['rgb(0,0,205)','rgb(0,100,0)','rgb(255,0,0)'],
    }],
  },
});
