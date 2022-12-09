const URL_API = "http://localhost";

const tarefas = documentElementById('tarefas');

fetch(URL_API)
    .then(function (response){
        return response.text();
    })
    .then(function (arrayBuffer){
        const tarefasArray = JSON.parse(arrayBuffer);

        tarefasArray.forEach(e => {
            const tr = document.createElement('tr');
            const td = document.createElement('td');
            const div = document.createElement('div');
            const h3 = document.createElement('h3');
            const h5 = document.createElement('h3');
            const h6 = document.createElement('h3');
            const subdiv = document.createElement('div');
            
            h3.innerHTML = e.titulo;
            subdiv.innerHTML = "Daqui a " + 0 + " dias"; //conta dos dias
            h5.innerHTML = e.descricao;
            h6.innerHTML = "Programado para" + e.data;
            div.classList.add("d-flex");
            div.classList.add("justify-content-between");
            subdiv.classList.add("d-flex");
            subdiv.classList.add("justify-content-center");
            subdiv.classList.add("bg-secondary");
            subdiv.classList.add("p-2");
            subdiv.classList.add("rounded-pill");
            subdiv.style = "--bs-bg-opacity: .5;";

            div.appendChild(h3);
            div.appendChild(subdiv);
            div.appendChild(h5);
            div.appendChild(h6);

            td.appendChild(div);

            tr.appendChild(td);
        });
    });