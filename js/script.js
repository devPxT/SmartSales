function dev(event) {
    event.preventDefault();
    alert("Em desenvolvimento!");
}

function validarCPF() {
    cpf = $('#CPF').value
    cpf = cpf.replace(/[^\d]+/g, '');
    if (cpf.length !== 11) return false;
  
    // Validação do primeiro dígito verificador
    let soma = 0;
    for (let i = 0; i < 9; i++) {
      soma += parseInt(cpf.charAt(i)) * (10 - i);
    }
    let resto = soma % 11;
    if (resto < 2) {
      resto = 0;
    } else {
      resto = 11 - resto;
    }
    if (resto !== parseInt(cpf.charAt(9))) {
      return false;
    }
  
    // Validação do segundo dígito verificador
    soma = 0;
    for (let i = 0; i < 10; i++) {
      soma += parseInt(cpf.charAt(i)) * (11 - i);
    }
    resto = soma % 11;
    if (resto < 2) {
      resto = 0;
    } else {
      resto = 11 - resto;
    }
    if (resto !== parseInt(cpf.charAt(10))) {
      return false;
    }
  
    return true;
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