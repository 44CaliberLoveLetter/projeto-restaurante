# projeto-restaurante
# Projeto PHP - Restaurante

Este é um projeto em PHP com banco de dados MySQL chamado **novo_user**, desenvolvido para gerenciamento de **reservas de restaurante**.  
Ele inclui todos os arquivos do sistema e um backup do banco para importar no phpMyAdmin.

---

## Sobre o projeto

- A **tela principal** funciona como um painel de teste, permitindo a visualização rápida do sistema de controle de reservas.
- O sistema utiliza o **banco de dados** para armazenar informações de usuários, reservas e outras funcionalidades.
- É possível acessar a tela de **admin** usando:  

Login: adm2
Senha: 1986

- Todas as **senhas de novos cadastros** são criptografadas para maior segurança.
- O projeto já inclui alguns usuários de teste para visualização do sistema funcionando.

---

## 🚀 Como rodar o projeto

1. **Baixe o projeto**
 - Clique no botão verde **Code** → **Download ZIP**
 - Extraia o ZIP em uma pasta no seu computador

2. **Coloque a pasta no servidor local**
 - Se estiver usando XAMPP, mova a pasta para `htdocs`
 - Exemplo: `C:\xampp\htdocs\restaurante`

3. **Inicie o servidor local**
 - Abra o painel do XAMPP
 - Inicie o **Apache** e o **MySQL**

4. **Importe o banco de dados**
 - Abra o **phpMyAdmin** (geralmente em [http://localhost/phpmyadmin](http://localhost/phpmyadmin))
 - Clique em **Novo** e crie um banco com o nome:  
   ```
   novo_user
   ```
 - Selecione o banco criado
 - Vá na aba **Importar**
 - Clique em **Escolher arquivo** e selecione `banco.sql`
 - Clique em **Executar**

5. **Acesse o sistema**
 - No navegador, abra:  
   ```
   http://localhost/restaurante
   ```

---

## ⚙️ Configuração do arquivo de conexão

No arquivo `conexao.php`, verifique se as credenciais estão corretas:

```php
$host = "localhost";
$usuario = "root";
$senha = "";
$banco = "novo_user";

