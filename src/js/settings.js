document.addEventListener('DOMContentLoaded', async () => {
    try{
        const infoCounterLimit = document.getElementById('infoCounterLimit');
        const cardCounterLimit = document.getElementById('cardCounterLimit');
        const userCounterLimit = document.getElementById('maxUsersLimit');
    } catch (err) {
        return;
    }
    try {
        console.log("Config wird geladen");
        const res = await getData('../../config/config.json');
        // Dropdown befüllen
        // createList(cfg.intervals, select, cfg.default + " " + "minuten"); // falls du einen Default-Wert hast
        createList(res.maxCountForInfoPages, infoCounterLimit, res.defaultMaxCountForInfoPages + " " + "Info-Seiten");
        createList(res.maxCountForInfoTerminals, cardCounterLimit, res.defaultMaxCountForInfoTerminals + " " + "Terminals");
        createList
        console.log(res);
        // saveList(select, "default");
        saveList(infoCounterLimit, "defaultMaxCountForInfoPages");
        saveList(cardCounterLimit, "defaultMaxCountForInfoTerminals");
    } catch (err) {
        console.error('Fehler beim Laden der Config:', err);
        return;
    }
});

async function getData(url) {
    const result = await fetch(url)
    if (!result.ok) throw new Error(`Config nicht gefunden (Status ${result.status})`);
    return await result.json();
}
function createList(cfg, select, defaultValue) {
    select.innerHTML = ""; // Vorher leeren
    const bitteWaehlen = document.createElement('option');
    bitteWaehlen.value = "bitte wählen";
    bitteWaehlen.textContent = defaultValue;
    select.appendChild(bitteWaehlen);
    for (let i = 0; i < cfg.length; i++) {
        const opt = document.createElement('option');
        opt.value =  cfg[i].value;
        opt.textContent = cfg[i].name;
        select.appendChild(opt);
    }
}

async function loadNumbers(){
    

}


function saveList(select, name) {
    select.addEventListener('change', async () => {
        const newDefault = parseFloat(select.value);
        console.log(`Neuer Default-Wert: ${newDefault}`);
        console.log(`Name: ${name}`);
        if (!newDefault) {
            return;
        }
        try {
            const res = await fetch('../php/config.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name: name, value: newDefault })
            });
            if (!res.ok) throw new Error(`Speichern fehlgeschlagen (Status ${res.status})`);
            const result = await res.json();
            if (result.success) {
                alert('Default-Intervall gespeichert');
            } else {
                alert('Fehler: ' + result.error);
            }
        } catch (err) {
            console.error('Fehler beim Speichern der Config:', err);
            alert('Speicher-Fehler');
        }
    });
}

async function setData() {
    try {
        var data = await getData('../../config/configTest.json');
        document.getElementById("val1").value = data.webpageSettings[0].maxCountForInfoPages
        document.getElementById("val1").value = data.webpageSettings[0].maxCountForInfoPages
        document.getElementById("val3").value = data.webpageSettings[0].maxUsers
        
    } catch (err) {
        console.error("Error fetching data:", err);
    }
}
