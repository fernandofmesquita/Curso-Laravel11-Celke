// Máscara para o campo price
// Receber o seletor o campo preço
let inputPrice = document.getElementById('price');

// Verificar se Existe o seletor no HTML
if(inputPrice){

    // Aguardar o usuário digitar o valor no campo
    inputPrice.addEventListener('input', function(){

        // Obter o Valor Atual removendo qualquer caractere que não seja número
        let valuePrice = this.value.replace(/[^\d]/g, '');

        // Adicionar os separadores de milhar
        var formattedPrice = (valuePrice.slice(0, -2).replace(/\B(?=(\d{3})+(?!\d))/g, '.')) + '' + valuePrice.slice(-2);

        // Adicionar a virgula até dois gigitos se houver centavos
        if(formattedPrice.length > 2){
            formattedPrice = formattedPrice.slice(0, -2) + ',' + formattedPrice.slice(-2);
        }

        // Atualizar o valor do Campo
        this.value = formattedPrice;

    })
}