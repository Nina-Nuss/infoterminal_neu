document.addEventListener('DOMContentLoaded', async () => {
    try {
        const infoCounterLimit = document.getElementById('infoCounterLimit');
        const cardCounterLimit = document.getElementById('cardCounterLimit');
        const userCounterLimit = document.getElementById('userCounterLimit');
        console.log("Config wird geladen");
        const res = await getData('../../config/config.json');
        
        // Dropdown befüllen
        // createList(cfg.intervals, select, cfg.default + " " + "minuten"); // falls du einen Default-Wert hast
        createList(res.maxCountForInfoPages, infoCounterLimit, res.defaultMaxCountForInfoPages);
        createList(res.maxCountForInfoTerminals, cardCounterLimit, res.defaultMaxCountForInfoTerminals);
        loadNumbers(res.userLimitMax, res.userLimitMin, res.defaultUserLimit, userCounterLimit)
        // saveList(select, "default");
        saveList(infoCounterLimit, "defaultMaxCountForInfoPages", "", "");
        saveList(cardCounterLimit, "defaultMaxCountForInfoTerminals", "", "");
        saveList(userCounterLimit, "defaultUserLimit", res.userLimitMax, res.userLimitMin);
    } catch (err) {
        return;
    }
});
async function getData(url) {
    const result = await fetch(url)
    if (!result.ok) throw new Error(`Config nicht gefunden (Status ${result.status})`);
    return await result.json();
}
function createList(cfg, select, def) {
    console.log(def);
    select.innerHTML = ""; // Vorher leeren
    for (let i = 0; i < cfg.length; i++) {
        const opt = document.createElement('option');
        opt.value = cfg[i].value;
        opt.textContent = cfg[i].value;
        select.appendChild(opt);
    }
    select.value = def
}
function loadNumbers(max, min, cfg, userCounterLimit) {
    console.log(max);
    console.log(min)
    console.log(cfg)
    console.log(userCounterLimit)
    userCounterLimit.value = "";
    if (cfg > max == true || cfg < min == true) {
       return
    }
    userCounterLimit.value = cfg
}
function saveList(select, name, max, min) {
    select.addEventListener('change', async () => {
        debugger
        const newDefault = parseFloat(select.value);
        console.log(`Neuer Default-Wert: ${newDefault}`);
        console.log(`Name: ${name}`);
        if (!newDefault) {
            return;
        }
        if(name == "defaultUserLimit" && newDefault > max || newDefault < min){ return }
        if(name)
        try {
            const res = await fetch('../php/config.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name: name, value: newDefault })
            });
            if (!res.ok) throw new Error(`Speichern fehlgeschlagen (Status ${res.status})`);
            const result = await res.json();
            if (result.success) {
              
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
        document.getElementById("val3").value = data.webpageSettings[0].userLimit

    } catch (err) {
        console.error("Error fetching data:", err);
    }
}
