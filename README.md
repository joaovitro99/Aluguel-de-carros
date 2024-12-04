# Engenharia de Software - 2024.2 | Universidade Federal do Tocantins - Palmas

#### Curso: Bacharelado em Ciência da Computação

#### Professor: Edeilson Milhomem da Silva

#### Time: Mayconn Cardoso Soares, Pedro Lucas Moreira Pinto, João Vitor Reis Días e Victhor Cabral Magalhães

# LoCar
Site para aluguel de carros feito para disciplina de engenharia de software 
![Logo do Projeto](docs/logo/LogoLoCar.jpeg)





# Sobre o Projeto

## Visão Geral:
LoCar é uma plataforma online projetada para simplificar o aluguel de carros, atendendo às necessidades de turistas, moradores locais e empresas. Com uma interface intuitiva e funcionalidades personalizadas, a plataforma permite que usuários desempenhem atividades específicas de acordo com seus papéis no sistema: cliente, funcionário ou administrador. Nosso objetivo é oferecer uma experiência eficiente, prática e adaptada a diferentes perfis de clientes.

- **[Acesse aqui a Landing Page do projeto](https://swampertian.github.io/Landing-Page/)**
- **[Acesse aqui o vídeo de apresentação](https://drive.google.com/file/d/1ovdHVbo7fpbZHQ3vepduI2LcFXOTM5bm/view)**
- **[Acesse aqui a Apresentação final](https://www.canva.com/design/DAGXtvQPbpk/wajP5qEYpfII4jJGA8xXcg/edit?utm_content=DAGXtvQPbpk&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton.com)**
- **[Instalar versão final do projeto](https://https://github.com/joaovitro99/Aluguel-de-carros/releases/tag/v2.2.0)**

## Funcionalidades Principais:

### Para Clientes:

- Pesquisa e reserva de veículos.
- Acompanhamento de reservas ativas.
- Histórico de aluguéis.
- Envio de feedbacks sobre veículos ou serviços.

### Para Funcionários:

- Gerenciamento da frota de veículos (adicionar, editar, remover).
- Processamento de solicitações de aluguel.
- Acompanhamento de devoluções e manutenção dos veículos.

### Para Administradores:

- Administração de contas de funcionários e clientes.
- Visualização e análise de relatórios de desempenho.
- Configuração de políticas de aluguel e preços dinâmicos.
- Monitoramento de feedbacks e ajustes nos serviços.



# Sprints

- [Sprint 1](docs/sprints/Sprint_1.pdf)
- [Sprint 2](docs/sprints/Sprint%202.pdf)
- [Sprint 3](docs/sprints/Sprint%203%20(1).pdf)
- [Sprint 4](docs/sprints/Sprint%204.pdf)
- [Sprint 5](docs/sprints/Sprint%205.pdf)



 
# User Stories

![User Story - Busca](docs/user_stories/user%20stories%20busca.png)  
![User Story - Editar Perfil](docs/user_stories/user%20stories%20editar%20perfil.png)  
![User Story - Histórico](docs/user_stories/user%20stories%20historico.png)  
![User Story - Inicial](docs/user_stories/user%20stories%20inicial.png)  
![User Story - Moderação de Perfil](docs/user_stories/user%20stories%20moderar%20perfil.png)  
![User Story - Moderação de Veículos - Funcionário](docs/user_stories/user%20stories%20moderar%20veiculos%20funcionario.png)  
![User Story - Moderação de Veículos](docs/user_stories/user%20stories%20moderar%20veiculos.png)  
![User Story - Rendimentos](docs/user_stories/user%20stories%20rendimentos.png)  
![User Story](docs/user_stories/user%20stories.png)
## Como rodar o projeto

Siga os passos abaixo para configurar e executar o projeto:

1. **Clone o repositório localmente:**
   ```bash
   git clone https://github.com/joaovitro99/Aluguel-de-carros.git
2. **Navegue até o diretório do projeto e instale as dependências:**
- No terminal, execute:
    ```bash
    composer install
- Depois, gere o autoload:
  ```bash
    composer dump-autoload
4. **Configure as credenciais do banco de dados:**
- Edite o arquivo config.php e insira as informações de acesso ao seu banco de dados.
5. **Configure as credenciais SMTP para notificações por e-mail:**
- No arquivo notificationsAPI/src/services/EmailService.php, ajuste as configurações SMTP com as credenciais apropriadas.
6. **Execute o projeto:**
- Certifique-se de que o servidor web (como o WAMP ou XAMPP) e o banco de dados estão em execução. Acesse o projeto através do navegador no endereço configurado.


