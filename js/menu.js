/* ================================================== */
/*                CONTROLE DO MENU                    */
/* ================================================== */

document.addEventListener('DOMContentLoaded', () => {
    const nomeJogadorInput = document.getElementById('nome-jogador');
    const btnJogar = document.getElementById('btn-jogar');

    const nomeSalvo = localStorage.getItem('nomeJogador');
    if (nomeSalvo) {
        nomeJogadorInput.value = nomeSalvo;
    }

    btnJogar.addEventListener('click', (event) => {
        event.preventDefault(); 
        
        const nome = nomeJogadorInput.value.trim();

        if (nome === '') {
            alert('Por favor, digite seu nome para jogar!');
            return;
        }

        localStorage.setItem('nomeJogador', nome);

        window.location.href = btnJogar.href;
    });
});