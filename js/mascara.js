function mascara(o, f) {

    v_obj = o;

    v_fun = f;

    setTimeout("execmascara()", 1);

}

function execmascara() {

    v_obj.value = v_fun(v_obj.value);

}

/*Função que padroniza telefone*/

function mtel(v) {

    v = v.replace(/\D/g, "");             //Remove tudo o que não é dígito

    v = v.replace(/^(\d{2})(\d)/g, "($1)$2"); //Coloca parênteses em volta dos dois primeiros dígitos

    v = v.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

    return v;

}

/*Função que padroniza CPF*/

function cpf(v) {

    v = v.replace(/\D/g, "");

    v = v.replace(/(\d{3})(\d)/, "$1.$2");

    v = v.replace(/(\d{3})(\d)/, "$1.$2");

    v = v.replace(/(\d{3})(\d{1,2})$/, "$1-$2");

    return v;

}



/*Função que padroniza CEP*/

function cep(v) {

    v = v.replace(/D/g, "");

    v = v.replace(/^(\d{5})(\d)/, "$1-$2");

    return v;

}

function mAno(v) {

    v = v.replace(/\D/g, "");             //Remove tudo o que não é dígito

    v = v.replace(/(\d)(\d{4})$/, "$1-$2");    //Coloca hífen entre o quarto e o quinto dígitos

    return v;

}



