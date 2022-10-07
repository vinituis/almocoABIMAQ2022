function update() {
    var campo = document.getElementById('type');
    var nome = document.getElementById('nome');
    var email = document.getElementById('email');
    var empresa = document.getElementById('empresa');
    var endereco = document.getElementById('endereco');
    var tel = document.getElementById('tel');
    var obs = document.getElementById('observacoes');
    var pag = document.getElementById('pag');
    var valor = campo.options[campo.selectedIndex];

    var cpf = document.getElementById('cpf');
    
    cpf.placeholder = valor.value;


    if(valor.value == "CPF" || valor.value == "CNPJ"){
        cpf.classList.remove('apagado');
        nome.classList.remove('apagado');
        email.classList.remove('apagado');
        empresa.classList.remove('apagado');
        endereco.classList.remove('apagado');
        tel.classList.remove('apagado');
        obs.classList.remove('apagado');
        pag.classList.remove('apagado');
    }else {
        cpf.classList.add('apagado');
        nome.classList.add('apagado');
        email.classList.add('apagado');
        empresa.classList.add('apagado');
        endereco.classList.add('apagado');
        tel.classList.add('apagado');
        obs.classList.add('apagado');
        pag.classList.add('apagado');
    }
}

function update_adm() {
    var select = document.getElementById('cad');
    var nome = document.getElementById('nome');
    var email = document.getElementById('email');
    var empresa = document.getElementById('empresa');
    var valor = select.options[select.selectedIndex];

console.log(valor.value);

    if(valor.value !== 'null'){
        nome.classList.remove('apagado');
        email.classList.remove('apagado');
        empresa.classList.remove('apagado');
    }else {
        nome.classList.add('apagado');
        email.classList.add('apagado');
        empresa.classList.add('apagado');
    }
}

// Função de alerta

// function alert() {
//     var x;
//     var r = confirm("Escolha o valor!");
//     if(r == true){
//         x = "Você pressionou OK!";
//     }else{
//         x = "Você pressionou Cancelar!";
//     }
//     document.getElementById("demo").innerHTML = x;
// }