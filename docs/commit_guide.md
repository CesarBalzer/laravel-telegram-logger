# Guia de Commits Semânticos

Commits semânticos ajudam a manter um histórico de mudanças mais claro e organizado. Abaixo estão as principais convenções:

## Estrutura de um Commit Semântico

```
<tipo>(<escopo opcional>): <descrição breve>

<corpo opcional>

<footer opcional>
```

## Tipos de Commits

- **feat:** Adiciona uma nova funcionalidade ao projeto.  
  _Exemplo:_ `feat: Adiciona botão de login social`

- **fix:** Correção de bugs.  
  _Exemplo:_ `fix: Corrige bug no formulário de cadastro`

- **chore:** Tarefas de manutenção que não alteram o código fonte ou funcionalidades.  
  _Exemplo:_ `chore: Atualiza dependências do projeto`

- **docs:** Alterações na documentação apenas.  
  _Exemplo:_ `docs: Atualiza o README com instruções de setup`

- **style:** Mudanças que não afetam a lógica do código, como formatação, correção de espaçamento, etc.  
  _Exemplo:_ `style: Remove espaços em branco desnecessários`

- **refactor:** Refatorações que não adicionam funcionalidade nem corrigem bugs.  
  _Exemplo:_ `refactor: Melhora a legibilidade da função de validação`

- **test:** Adição ou correção de testes.  
  _Exemplo:_ `test: Adiciona testes para o serviço de autenticação`

- **perf:** Alterações que melhoram o desempenho.  
  _Exemplo:_ `perf: Otimiza a consulta no banco de dados`

- **build:** Mudanças que afetam o sistema de build.  
  _Exemplo:_ `build: Adiciona webpack para bundling de arquivos`

- **ci:** Mudanças nas configurações de integração contínua.  
  _Exemplo:_ `ci: Ajusta pipeline do GitHub Actions`

## Exemplo de Commit Completo

```
feat(auth): adiciona suporte a login com Google

Este commit adiciona a possibilidade do usuário realizar login utilizando sua conta do Google. Foi integrada a biblioteca Socialite para facilitar a autenticação.

- Atualiza a rota de login
- Adiciona botões de login social na tela de autenticação
- Cria novas variáveis de ambiente para configurar as credenciais do Google
```

