function buscaCEP() {
    let cep = document.getElementById('ceploc').value;
    if (cep !== "") {
        let url = "https://brasilapi.com.br/api/cep/v2/" + cep;

        let req = new XMLHttpRequest();
        req.open("GET", url);
        req.send();

        req.onload = function () {
            if (req.status === 200) {
                let endereco = JSON.parse(req.response);
                document.getElementById("rua").value = endereco.street
                document.getElementById("bairro").value = endereco.neighborhood
            }
            else if (req.status === 400) {
                alert("CEP Inválido!")
            }
            else {
                alert("Erro ao fazer a requisição")
            }
        }
    }
}

window.onload = function () {
    let txtCep = document.getElementById("ceploc");
    txtCep.addEventListener("blur", buscaCEP);
}