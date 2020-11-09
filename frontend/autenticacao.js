const apideautenticacao = "autenticacao/api/";

document.addEventListener("DOMContentLoaded", function () {
    document.body.login = new Login();
});

function logout() {
    document.body.login.logout();
}

function login() {
    document.body.login.login();
}

function signup() {
    document.body.login.signup();
}

class Login {

    constructor() {
        this.makeDivLogin();
    }

    makeDivLogin() {
        this.loginDiv = document.createElement("div");
        this.loginDiv.setAttribute("id", "login");
        document.body.appendChild(this.loginDiv);
        this.fetchCheckLoginPage();
    }

    fetchCheckLoginPage() {
        fetch(apideautenticacao + 'login.php')
            .then(response => response.json())
            .then(data => {
                this.checkLogin(data);
            });
    }

    checkLogin(usuario) {
        if (usuario.usuid > 0) {
            this.makeFormLogout(usuario);
            this.loginDiv.setAttribute("usuid", usuario.usuid);
        } else {
            this.makeFormLogin();
            this.loginDiv.setAttribute("usuid", "0");
        }
    }

    makeFormLogout(usuario) {
        this.loginDiv.innerHTML = `${usuario.login}
        <a href="javascript:logout()">logout</a>`;
    }

    logout() {
        let data = new FormData();
        data.append('login', "");
        data.append('senha', "");
        fetch(apideautenticacao + 'login.php', { method: "POST", body: data })
            .then(response => response.json())
            .then(data => {
                this.checkLogin(data);
            });
    }

    makeFormLogin() {
        this.loginDiv.innerHTML = `
        <form action="javascript:login()">
            <input type="text" size="6" name="login" placeholder="login" maxlength="16">
            <input type="password" size="6" name="senha" placeholder="senha" maxlength="128">
            <input type="submit" value="entrar">
            <button onclick="signup()">cadastrar</button>
        </form>`;
    }

    login() {
        const form = this.loginDiv.querySelector("form");
        let data = new FormData();
        data.append('login', form.login.value);
        data.append('senha', form.senha.value);
        fetch(apideautenticacao + 'login.php', { method: 'POST', body: data })
            .then(response => response.json())
            .then(data => {
                this.checkLogin(data);
            });
    }

    signup() {
        const form = this.loginDiv.querySelector("form");
        let data = new FormData();
        data.append('login', form.login.value);
        data.append('senha', form.senha.value);
        fetch(apideautenticacao + 'insereusuario.php', { method: 'POST', body: data })
            .then(response => response.json())
            .then(data => {
                this.checkLogin(data);
            });
    }

}
