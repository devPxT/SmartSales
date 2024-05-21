function dev(event) {
    event.preventDefault();
    Swal.fire({
      title: "Oops",
      text: "Em desenvolvimento",
      icon: "info"
    });
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

function CPFValidateForm(cpf) {
  cpf = cpf.replace(/[^\d]+/g, ''); // Remove tudo que não é número

  if (cpf.length !== 11 ||
      cpf === "00000000000" ||
      cpf === "11111111111" ||
      cpf === "22222222222" ||
      cpf === "33333333333" ||
      cpf === "44444444444" ||
      cpf === "55555555555" ||
      cpf === "66666666666" ||
      cpf === "77777777777" ||
      cpf === "88888888888" ||
      cpf === "99999999999") {
      return false;
  }

  var soma = 0;
  var resto;

  for (var i = 1; i <= 9; i++) {
      soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
  }

  resto = (soma * 10) % 11;

  if (resto === 10 || resto === 11) {
      resto = 0;
  }

  if (resto !== parseInt(cpf.substring(9, 10))) {
      return false;
  }

  soma = 0;
  for (var i = 1; i <= 10; i++) {
      soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
  }

  resto = (soma * 10) % 11;

  if (resto === 10 || resto === 11) {
      resto = 0;
  }

  if (resto !== parseInt(cpf.substring(10, 11))) {
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

function fecharModal() {
  document.getElementById('modalErro').style.display = 'none';
}

function deletar(element) {
  Swal.fire({
      title: "Excluir este registro?",
      text: "Você não será capaz de refazer isso!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#dc3545",
      cancelButtonColor: "#6c757d",
      confirmButtonText: "Sim, deletar!",
      cancelButtonText: "Cancelar"
  }).then((result) => {
      if (result.isConfirmed) {
          $(element).closest('tr').children('form').submit();
      }
  });
}

$(document).ready(function() {
  const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
  const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

  const form = document.getElementById('formCadastro');
  if (form) {
    form.addEventListener('submit', function (event) {
      const cpfInput = form.querySelector('input[name="CADcpf"]');
  
      if (cpfInput) {
        if (!CPFValidateForm(cpfInput.value)) {
          event.preventDefault();
          event.stopPropagation();
          cpfInput.classList.remove('is-valid');
          cpfInput.classList.add('is-invalid');
          cpfInput.nextElementSibling.textContent = 'CPF inválido. Por favor, preencha um CPF válido.';
          cpfInput.setCustomValidity('Invalid');
        } else {
            cpfInput.classList.remove('is-invalid');
            cpfInput.classList.add('is-valid');
            cpfInput.setCustomValidity('');
        }

        $(cpfInput).on('change', function() {
          var cpfValue = form.querySelector('input[name="CADcpf"]').value
          if (!CPFValidateForm(cpfValue)) {
            cpfInput.classList.remove('is-valid');
            cpfInput.classList.add('is-invalid');
            cpfInput.nextElementSibling.textContent = 'CPF inválido. Por favor, preencha um CPF válido.';
            cpfInput.setCustomValidity('Invalid');
          } else {
              cpfInput.classList.remove('is-invalid');
              cpfInput.classList.add('is-valid');
              cpfInput.setCustomValidity('');
          }
        });
      }
  
      form.classList.add('was-validated');
    }, false);
  }

  //ESTOQUE
  function updateTamanhoOptions() {
      const tipoTamanho = $('input[name="tipoTamanho"]:checked').val();
      const tamanhoSelect = $('#Tamanho');
      tamanhoSelect.empty();

      if (tipoTamanho === 'roupas') {
          const roupasTamanhos = ['PP', 'P', 'M', 'G', 'GG', 'XGG'];
          roupasTamanhos.forEach(function(tamanho) {
              tamanhoSelect.append(new Option(tamanho, tamanho));
          });
      } else if (tipoTamanho === 'calcados') {
          for (let i = 34; i <= 45; i++) {
              tamanhoSelect.append(new Option(i, i));
          }
      }
  }
  // Initialize with the default selection
  updateTamanhoOptions();
  // Update the options when the radio button is changed
  $('input[name="tipoTamanho"]').change(updateTamanhoOptions);
});