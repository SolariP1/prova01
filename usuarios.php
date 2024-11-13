<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuarios</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f2f5;
            color: #333;
        }

        header {
            background-color: #3880fc;
            color: white;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        header img {
            border-radius: 50%;
            width: 80px;
        }

        header h1 {
            margin-left: 10px;
            font-size: 2rem;
        }

        nav {
            background-color: #3880fc;
            display: flex;
            justify-content: center;
            padding: 10px;
        }

        nav a {
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 25px;
            background-color: #444;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #3880fc;
        }

        section {
            padding: 40px;
            text-align: left;
        }

        section h2 {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        section p {
            font-size: 1.1rem;
            margin: 10px 0;
        }

        @media (max-width: 768px) {
            header {
                flex-direction: column;
                text-align: center;
            }

            header img {
                margin-bottom: 10px;
            }

            nav {
                flex-wrap: wrap;
            }

            nav a {
                margin: 5px;
            }
        }
    </style>
    <script>
        function enviarFormulario(botao) {
            const formData = new FormData();
            formData.append('id', document.getElementById("id").value);
            formData.append('nome', document.getElementById("nome").value);
            formData.append('email', document.getElementById("email").value);
            formData.append('botao', botao);

            fetch('usuarios_modify.php', { method: 'POST', body: formData })
                .then(response => response.json())
                .then(data => {
                    document.getElementById("mensagem").innerHTML = data.mensagem;

                    if (botao === 'consulta' && data.sucesso) {
                        document.getElementById("nome").value = data.usu_nome;
                        document.getElementById("email").value = data.usu_email;
                    }
                })
                .catch(error => {
                    console.error('Erro:', error);
                    document.getElementById("mensagem").innerHTML = "Erro ao realizar a operação.";
                });
        }
    </script>
</head>
<body>
    <header>
        <div style="display: flex; align-items: center;">
            <img src="images.png" alt="Logo da Agenda">
            <h1>Controle das Usuarios</h1>
        </div>
        <nav>
            <a href="principal.php">Menus</a>
            <a href="usuarios.php">Usuarios</a>
            <a href="tarefas.php">Tarefas</a>
            <a href="gerenciar.php">Gerenciar tarefas</a>
        </nav>
    </header>
<section>
    <div>
        <h1>Cadastro de Usuarios:</h1>
        <label>Código:</label>
        <input type="text" id="id"><button onclick="enviarFormulario('consulta')">Buscar</button><br><br>
        <label>Nome:</label>  
        <input type="text" id="nome"><br><br>
        <label>Email:</label>
        <input type="text" id="email"><br><br>
        </select>
    </div>
    <button onclick="enviarFormulario('inserir')">Inserir</button>
    <button onclick="enviarFormulario('alterar')">Alterar</button>
    <button onclick="enviarFormulario('excluir')">Excluir</button><br><br>
    <p id="mensagem"></p>
</section>
</body>
</html>
