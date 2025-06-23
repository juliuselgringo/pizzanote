document.addEventListener("DOMContentLoaded", (event) => {
    event.preventDefault();
    //## RECHERCHE
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

        fetch('../Backend/getNotationBack.php',{
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


    //## UPDATE
    let itemUpdate = document.getElementById("item-update");
    let sousitemUpdate = document.getElementById("sous-item-update");
    let minUpdate = document.getElementById("min-update");
    let maxUpdate = document.getElementById("max-update");
    let ponderationUpdate = document.getElementById("ponderation-update");
    const updateBtn = document.querySelector("#update-notation");

    updateBtn.addEventListener('click', (event) => {
        event.preventDefault();
        itemUpdate = itemUpdate.value;
        sousitemUpdate = sousitemUpdate.value;
        console.log(minUpdate.value);
        minUpdate = String(minUpdate.value);
        maxUpdate = maxUpdate.value;
        ponderationUpdate = ponderationUpdate.value;

        let updateData = new FormData();
        updateData.append('item', itemUpdate);
        updateData.append('sous-item', sousitemUpdate);
        updateData.append('min', minUpdate);
        updateData.append('max', maxUpdate);
        updateData.append('ponderation', ponderationUpdate);
        updateData.append('name', inputName.value);

        fetch('../Backend/updateNotationBack.php',{
            method:'POST',
            body: updateData,
        })
        .then(response=> {
            if(!response.ok){
                throw new Error('pas de réponse');
            }
            return response.json();
        })
        .then(data=> {
            console.log(data);
            displayMessage.textContent= data['message'];
            displayMessage.className = data['class'];

        })
        .catch(error=>{
            console.error('Erreur', error);
        })
    })

})
