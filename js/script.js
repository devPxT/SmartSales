function dev(event) {
    event.preventDefault();
    alert("Em desenvolvimento!");
}

function validarCPF() {
    cpf = document.getElementById('CPF').value
    cpf = cpf.replace(/[^\d]/g, ''); // Remove todos os caracteres não numéricos
    if (cpf.length !== 11) {
      // alert('CPF do funcionário inválido!');
      $('#statusCPF').css('display', 'block');
      $('#statusCPF').text('CPF do funcionário inválido!');
      return false; // O CPF deve ter 11 dígitos após a remoção de caracteres especiais 
    }

    // Verifica se todos os dígitos são iguais, o que torna o CPF inválido
    if (/^(\d)\1+$/.test(cpf)) {
      // alert('CPF do funcionário inválido!');
      $('#statusCPF').css('display', 'block');
      $('#statusCPF').text('CPF do funcionário inválido!');
      return false; 
    }

    // Calcula o primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = 11 - (soma % 11);
    let digitoVerificador1 = resto === 10 || resto === 11 ? 0 : resto;

    // Verifica se o primeiro dígito verificador está correto
    if (digitoVerificador1 !== parseInt(cpf.charAt(9))) {
      // alert('CPF do funcionário inválido!');
      $('#statusCPF').css('display', 'block');
      $('#statusCPF').text('CPF do funcionário inválido!');
      return false; 
    }

    // Calcula o segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
        soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = 11 - (soma % 11);
    let digitoVerificador2 = resto === 10 || resto === 11 ? 0 : resto;

    // Verifica se o segundo dígito verificador está correto
    if (digitoVerificador2 !== parseInt(cpf.charAt(10))) {
      // alert('CPF do funcionário inválido!');
      $('#statusCPF').css('display', 'block');
      $('#statusCPF').text('CPF do funcionário inválido!');
      return false;
    }

    return true; // Se todas as verificações passaram, o CPF é válido
}

function validarSenha() {
    var senha  = document.getElementById("Senha");  // Senha1 do Modal Cadastro
    var senha2 = document.getElementById("Senha2"); // Senha2 do Modal Cadastro
  
    if (senha.value != senha2.value) {
      senha2.setCustomValidity("Senhas diferentes!");
      senha2.reportValidity();
      return false;
    } else {
      senha2.setCustomValidity("");
      return true;
    }
}

function mostrarOcultarSenha(total) {
    if (total == 2){
      var senhaL  = document.getElementById("SenhaL"); // Senha do Modal Login
      var chkL    = document.getElementById("chkL");   // checkbox Mostra Senha Login
    }
    var senha  = document.getElementById("Senha");   // Senha1 do Modal Cadastro
    var senha2 = document.getElementById("Senha2");  // Senha2 do Modal Cadastro
    var chkC    = document.getElementById("chkC");   // checkbox Mostra Senha Cadastro
  
    if (senha.type == "password"){
      if (total == 2){
        senhaL.type  = "text";
        chkL.checked = true;
      }
      senha.type  = "text";
      senha2.type = "text";
      chkC.checked = true;
    } else {
      if (total == 2){
        senhaL.type  = "password";
        chkL.checked = false;
      }
      senha.type  = "password";
      senha2.type = "password";
      chkC.checked = false;
    }
}

function fecharModal() {
  document.getElementById('modalErro').style.display = 'none';
}

// $(document).ready(function() {
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

// });