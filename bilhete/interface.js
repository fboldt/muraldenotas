const apidebilhetes = "bilhete/api/";

document.addEventListener("DOMContentLoaded", function () {
    document.body.notas = new Bilhetes();
});

class Bilhetes {

    constructor() {
        this.makeNewNotaFormDiv();
        this.makeNotasDiv();
    }

    removeNota(bilid) {
        const usuid = this.loginDiv.getAttribute('usuid');
        let data = new FormData();
        data.append('usuid', usuid);
        data.append('bilid', bilid);
        fetch(apidebilhetes + 'removebilhete.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(data => {
                if (data == "1") {
                    this.fetchNotas();
                }
            });
    }

    makeNewNotaFormDiv() {
        this.newNotaFormDiv = document.createElement("div");
        this.newNotaFormDiv.innerHTML = `
        <form action="javascript:document.body.notas.insertNota()">
            <textarea name="texto" placeholder="texto da mensagem" id="newnotatext" cols="25" rows="3" maxlength="128" required></textarea>
            <input type="submit" value="insert nota">
        </form>`;
        document.body.appendChild(this.newNotaFormDiv);
        this.createLoginDivObserver();
    }

    createLoginDivObserver() {
        this.loginDiv = document.querySelector("#login");
        const observer = new MutationObserver(() => {
            newNotaFormDisplay(this.loginDiv, this.newNotaFormDiv);
            const usuid = this.loginDiv.getAttribute('usuid');
            toggleRemoveNotaLinkDisplay(usuid);
        });
        observer.observe(this.loginDiv, { subtree: true, childList: true });
    }

    insertNota() {
        const usuid = this.loginDiv.getAttribute('usuid');
        const form = this.newNotaFormDiv.querySelector("form");
        let data = new FormData();
        data.append('usuid', usuid);
        data.append('texto', form.newnotatext.value);
        fetch(apidebilhetes + 'inserebilhete.php', { method: 'POST', body: data })
            .then(response => response.text())
            .then(data => {
                if (data == "1") {
                    this.fetchNotas();
                    form.newnotatext.value = "";
                }
            });
    }

    makeNotasDiv() {
        this.notasDiv = document.createElement("div");
        document.body.appendChild(this.notasDiv);
        this.fetchNotas();
        this.createNotasDivObserver();
    }

    fetchNotas() {
        fetch(apidebilhetes + 'getbilhetes.php')
            .then(response => response.json())
            .then(data => {
                this.notasDiv.innerHTML = "";
                data.forEach(nota => {
                    this.notasDiv.innerHTML = formatNota(nota) + this.notasDiv.innerHTML ;
                });
            });
    }

    createNotasDivObserver() {
        const observer = new MutationObserver(() => {
            const usuid = this.loginDiv.getAttribute('usuid');
            toggleRemoveNotaLinkDisplay(usuid);
        });
        observer.observe(this.notasDiv, { subtree: true, childList: true });
    }
    
}

function toggleRemoveNotaLinkDisplay(usuid) {
    let links = document.querySelectorAll(`.linkremovenota`);
    links.forEach(link => {
        if (link.getAttribute("usuid") == usuid) {
            link.style.display = "inline";
        } else {
            link.style.display = "none";
        }        
    })
}

function newNotaFormDisplay(loginDiv, newNotaFormDiv) {
    let usuid = loginDiv.getAttribute('usuid');
    if (usuid != '0') {
        newNotaFormDiv.style.display = "block";
    } else {
        newNotaFormDiv.style.display = "none";
    }
}

function formatNota(bilhete) {
    return `    <div id="nota${bilhete.bilid}" usuid="${bilhete.usuid}">
        <div class="nomeusu"">${bilhete.login}</div>
        <div class="tempo">${bilhete.tempo}</div>
        <div class="msgtexto">
            ${bilhete.texto}
            <a href="javascript:document.body.notas.removeNota(${bilhete.bilid})" class="linkremovenota" usuid="${bilhete.usuid}" style="display: none">remove</a>
        </div>
    </div>`;
}
