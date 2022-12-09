
function sleep(milliseconds) {
    const date = Date.now();
    let currentDate = null;
    do {
        currentDate = Date.now();
    } while (currentDate - date < milliseconds);
}

function signup() {
    //alert("entrou");
    const URL_API = "http://localhost/sitetodophp/user/create.php";



    const name = document.getElementById("inputNome").value;
    const email = document.getElementById("inputEmail").value;
    const nascimento = document.getElementById("inputNascimento").value;
    const type = document.getElementById("inputType").value;
    const login = document.getElementById("inputLogin").value;
    const pass = document.getElementById("inputPass").value;

    //alert("eNTROU NESSE DIABOOO");
    //sleep(5000);

    //const body = '{"nome": "' + name + '", "email": "' + email + '", "nascimento": "' + nascimento + '", "login": "' + login + '", "senha": "' + pass + '"}';

    const body = {
        nome: name,
        email: email,
        nascimento: nascimento,
        login: login,
        senha: pass
    }

    //alert(body);
    console.log(JSON.stringify(body));

    fetch(URL_API, {
        method: 'POST',
        headers: {
            Accept: 'application.json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(body)
    }).then(function (res) {
        alert(res);
        console.log(res);
        alert("deu certo?")
    }).catch(function (err) {
            alert(err);});
}