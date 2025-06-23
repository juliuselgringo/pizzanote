document.addEventListener("DOMContentLoaded", (event) => {
    event.preventDefault();
    // Se connecter et récupérer DataNotation
    const connectionBtn = document.querySelector("#connection");
    const inputName = document.querySelector("#name");
    const itemSearch = document.getElementById('item-search');
    const sousitemSearch = document.getElementById('sous-item-search');
    const displaySearch = document.getElementById('display-search');
    const displayMessage = document.getElementById('message');

    connectionBtn.addEventListener("click", (event) => {
        event.preventDefault();
        displaySearch.innerHTML = "";
        console.log(inputName.value);
        let connectionData = new FormData();
        connectionData.append('name', inputName.value);

        fetch('../Backend/configBack.php',{
            method:'POST',
            body: connectionData,
        })
        .then(response=> {
            if(!response.ok){
                throw new Error('pas de réponse');
            }
            return response.json();
        })
        .then(data=> {
            const messageAlert = data['message'];
            const alertClass = data['class'];
            const dataNotation = data['dataNotation'];
            displayMessage.textContent= messageAlert;
            displayMessage.className = alertClass;
            dataNotation.forEach(item => {
                
                if (itemSearch.value === item['item'] && sousitemSearch.value === item['sous_item']){
                    find = "<p>item : " + item["item"] + "</p><p>sous-item : " + item["sous_item"] + "</p><p>min : " + item['min'] + "</p><p>max : " + item['max'] + "</p><p>ponderation : " + item['ponderation'] + "</p><hr>";
                    displaySearch.innerHTML += find;
                }
                else if (itemSearch.value === item['item'] && sousitemSearch.value === ""){
                    find = "<p>item : " + item["item"] + "</p><p>sous-item : " + item["sous_item"] + "</p><p>min : " + item['min'] + "</p><p>max : " + item['max'] + "</p><p>ponderation : " + item['ponderation'] + "</p><hr>";
                    displaySearch.innerHTML += find;
                }
                else if(itemSearch.value === "" && sousitemSearch.value === ""){
                    find = "<p>item : " + item["item"] + "</p><p>sous-item : " + item["sous_item"] + "</p><p>min : " + item['min'] + "</p><p>max : " + item['max'] + "</p><p>ponderation : " + item['ponderation'] + "</p><hr>";
                    displaySearch.innerHTML += find;
                }    
            });
        })
        .catch(error=>{
            console.error('Erreur', error);
        })
    })

})
