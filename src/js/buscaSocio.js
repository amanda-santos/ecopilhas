
var obj = new json();
ul = document.getElementById("resultado");

var mesText = ["janeiro", "fevereiro", "março", "abril", "maio", "junho", "julho", "agosto", "setembro", "outubro", "novembro", "dezembro"];

function json() {    // Resgatar valores.
    json.prototype.resgatarValores = function () {
        // Estrutura de resultado.
        $.getJSON('data/associado.json', function (data) {
            $('#resultado').html('');
            data1 = data;
            achei = false;
            this.qtd = data.length;
            this.retorno = '';
            var input = $('#myInput').val().toLowerCase();
            ul.style.display = "block";
            j = "";
            //var str = "The best things in life are free";
            var patt = new RegExp(input);
            //var res = patt.test(str);
            if (input.length > 0) {

                $('#resultado').html('Carregando dados...');

                for (i = 0; i < this.qtd; i++) {
                    if (patt.test(data1[i].nome.toLowerCase())) {
                        this.retorno += '<a onclick="myMatricula(' + i + ')">' + data1[i].nome + '<br><br></a>';
                        achei = true;
                    }
                }

                if (achei) {
                    $('#resultado').html(this.retorno);
                } else {
                    $('#resultado').html('Nenhum resultado encontrado.');
                }
            }
        });

    }

}

$("#myInput").keyup(function () {
    obj.resgatarValores();
});

function myMatricula(j) {
    matricula = document.getElementById("matricula");
    matricula.value = data1[j].matricula;
    ul.style.display = "none";
    nome = document.getElementById("nomeAss");
    nome.value = data1[j].nome;
    if (data1[j].dependenteSocio > 0) {
        document.getElementById("contSocioDependente").hidden = false;
        document.getElementById("numSocioDependente").value = data1[j].dependenteSocio;
    } else {
        document.getElementById("contSocioDependente").hidden = true;
    }
    vinculo = document.getElementById("vinculo");
    vinculo.value = data1[j].ativo;
    vinculo.selected = data1[j].ativo;
    document.getElementById("myInput").value = "";

    myDebito(j);
    obj1.setDataPagamento(j);
}

function myDebito(j) {
    debito = document.getElementById("debito");
    deb = data1[j].debito.split(';');
    tabela = '';
    if (deb.length > 0) {
        for (d in deb) {
            tabela += '<tr>' + '<td>' + d + '</td>' + '</tr>';
        }
    } else {
        tabela = '<tr>' + '<td>' + 'Não há débitos.' + '</td>' + '</tr>';
    }
    alert(tabela);
    debito.innerHTML = tabela;
}

var obj1 = new json();


json.prototype.setDataPagamento = function () {
    // Estrutura de resultado.
    $.getJSON('data/mensalidade.json', function (data) {
        mensalidade = data;
        this.qtd = mensalidade.length;
        m = document.getElementById("mesReferenciaInicial");
        y = document.getElementById("anoReferenciaInicial");
        m.value = mes;
        y.value = ano;
        for (d = 0; d < this.qtd; d++) {
            if (document.getElementById("matricula").value === mensalidade[d].matricula) {
                var vencimento = mensalidade[d].vencimento;
                vencimento = vencimento.split("/");
                var mesv = vencimento[1];
                var anov = vencimento[2];
                m.value = mesText[mesv - 1];
                y.value = anov;
                document.getElementById("mesReferenciaFinal").value = mesv;
                document.getElementById("anoReferenciaFinal").value = anov;

            }
        }

    });
}
