/* Selecionando os links de Excluir através
da classe ".excluir" (colocada em cada link no HTML) */
const links = document.querySelectorAll(".excluir");

/* Percorrendo cada link selecionado anteriormente
(conteúdo da constante "links") */
for(const link of links){
    /* Adicionando um evento de clique para 
    cada link de excluir. */
    link.addEventListener("click", function(event){
        /* Anulando o comportamento padrão do link que é
        redirecionar para algum lugar. */
        event.preventDefault();

        /* Usando um confirm() para capturar a resposta do usuário,
        que pode ser OK/Sim (true) ou Cancelar/Não (false) */
        let resposta = confirm("Deseja realmente excluir este registro?");
        
        /* Se a resposta for true, então redirecionamos
        para o destino original de cada link, ou seja, para a página
        PHP de exclusão. */
        if(resposta) location.href = this.href;
    })
}

