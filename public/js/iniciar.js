document.addEventListener('DOMContentLoaded', () => {
    const menuToggle = document.getElementById('menuToggle');
    const navbarContainer = document.getElementById('navbar-container');
    const conteudo = document.getElementById('conteudo');
    const destaquesContainer = document.getElementById('destaques-container');
    const loginSection = document.getElementById('login'); // Seleciona a seção de destaques (imagens à direita)
    const titulo = document.querySelector('.titulo');

    // Função para configurar a responsividade do menu
    function setupResponsiveMenu() {
      const isMobile = window.innerWidth <= 768;
  
      if (isMobile) {
        navbarContainer.style.display = 'none'; // Esconde o menu inicialmente
        menuToggle.style.display = 'block'; // Exibe o botão
      } else {
        navbarContainer.style.display = 'flex'; // Mostra o menu em telas grandes
        navbarContainer.style.flexDirection = 'row'; // Itens em linha
        menuToggle.style.display = 'none'; // Esconde o botão
      }
    }
  
    // Função para alternar a visibilidade do menu em telas pequenas
    function toggleMenu() {
      const isMobile = window.innerWidth <= 768;
      if (isMobile) {
        if (navbarContainer.style.display === 'none') {
          navbarContainer.style.display = 'flex'; // Mostra o menu
          navbarContainer.style.flexDirection = 'column'; // Empilha os itens
        } else {
          navbarContainer.style.display = 'none'; // Esconde o menu
        }
      }
    }
  
    // Função para configurar a responsividade das seções
    function setupResponsiveLayout() {
      const isMobile = window.innerWidth <= 768;
  
      if (isMobile) {
        // Esconde a seção "Animes Recentes"
        if (destaquesContainer) destaquesContainer.style.display = 'none';
  
        // Esconde a seção de destaques (login)
        if (loginSection) loginSection.style.display = 'none';
  
        // Ajusta layout de "Meus Animes" para 1 coluna
        if (conteudo) {
          conteudo.style.display = 'grid';
          conteudo.style.gridTemplateColumns = '1fr';
          conteudo.style.gap = '10px';
          titulo.style.width = '100%';
        }
      } else {
        // Restaura a seção "Animes Recentes"
        if (destaquesContainer) destaquesContainer.style.display = 'block';
  
        // Restaura a seção de destaques (login)
        if (loginSection) loginSection.style.display = 'block';
  
        // Restaura layout de "Meus Animes" para múltiplas colunas
        if (conteudo) {
          conteudo.style.display = 'grid';
          conteudo.style.gridTemplateColumns = 'repeat(4, 1fr)'; // 4 colunas
          conteudo.style.gap = '20px';
          titulo.style.width = '77%';
        }
      }
    }
  
    // Evento de clique no botão toggle
    menuToggle.addEventListener('click', toggleMenu);
  
    // Configura o menu e layout na inicialização
    setupResponsiveMenu();
    setupResponsiveLayout();
  
    // Adiciona eventos para redimensionamento da tela
    window.addEventListener('resize', () => {
      setupResponsiveMenu();
      setupResponsiveLayout();
    });
  });
  