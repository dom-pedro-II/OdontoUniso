
function consultaCEP() {
    var cep = document.getElementById('cep').value;

    // Remover caracteres não numéricos do CEP
    cep = cep.replace(/\D/g, '');

    if (cep.length == 8) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'https://viacep.com.br/ws/' + cep + '/json/');
        xhr.onload = function() {
            if (xhr.status === 200) {
                var endereco = JSON.parse(xhr.responseText);

                document.getElementById('logradouro').value = endereco.logradouro;
                document.getElementById('bairro').value = endereco.bairro;
                document.getElementById('cidade').value = endereco.localidade;
                document.getElementById('estado').value = endereco.uf;
            } else {
                alert('CEP não encontrado.');
            }
        };
        xhr.send();
    }
}
function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g,'');
    if(cpf == '') return false; 
    if (cpf.length != 11 || 
        cpf == "00000000000" || 
        cpf == "11111111111" || 
        cpf == "22222222222" || 
        cpf == "33333333333" || 
        cpf == "44444444444" || 
        cpf == "55555555555" || 
        cpf == "66666666666" || 
        cpf == "77777777777" || 
        cpf == "88888888888" || 
        cpf == "99999999999")
        return false;   
    var add = 0;
    for (i=0; i < 9; i ++)
        add += parseInt(cpf.charAt(i)) * (10 - i); 
    var rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) rev = 0;   
    if (rev != parseInt(cpf.charAt(9))) return false;   
    add = 0;
    for (i = 0; i < 10; i ++)
        add += parseInt(cpf.charAt(i)) * (11 - i); 
    rev = 11 - (add % 11);  
    if (rev == 10 || rev == 11) rev = 0;   
    if (rev != parseInt(cpf.charAt(10))) return false;   
    return true;   
}

document.querySelector("form").addEventListener("submit", function(event) {
    var cpfInput = document.getElementById("cpf");
    var cpf = cpfInput.value;
    if (!validarCPF(cpf)) {
        alert("CPF inválido. Por favor, insira um CPF válido.");
        event.preventDefault();
    }
});
