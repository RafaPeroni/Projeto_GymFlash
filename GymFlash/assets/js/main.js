function cpnjMask(cnpj) {
    cnpj = cnpj.replace(/\D/g, '');
    cnpj = cnpj.replace(/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5");
    return cnpj;
}

function formatarCNPJ() {
    var inputElement = document.getElementById('cnpj');
    var cnpj = inputElement.value;
    var cnpjFormatado = cpnjMask(cnpj);
    inputElement.value = cnpjFormatado;
}

function cepMask(cep) {
    cep = cep.replace(/\D/g, '');
    cep = cep.replace(/(\d{5})(\d{3})/, "$1-$2");

    return cep;
}

function formatarCEP() {
    var inputElement = document.getElementById('cep');
    var cep = inputElement.value;
    if (cep.length > 9) {
        cep = cep.slice(0, 9);
    }
    var cepFormatado = cepMask(cep);
    inputElement.value = cepFormatado;
}

function formatarCEPloc() {
    var inputElement = document.getElementById('ceploc');
    var cep = inputElement.value;
    if (cep.length > 9) {
        cep = cep.slice(0, 9);
    }
    var cepFormatado = cepMask(cep);
    inputElement.value = cepFormatado;
}

function telMask(tel) {
    tel = tel.replace(/\D/g, '');

    tel = tel.replace(/(\d{2})(\d{5})(\d{4})/, "($1) $2-$3");

    return tel;
}

function formTel() {
    var inputElement = document.getElementById('tel');
    var tel = inputElement.value;

    if (tel.length > 11) {
        tel = tel.slice(0, 11);
    }

    var telefoneFormatado = telMask(tel);
    inputElement.value = telefoneFormatado;
}