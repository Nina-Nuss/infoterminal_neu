"use strict";
document.addEventListener('DOMContentLoaded', async () => {
    try {
        const infoCounterLimit = document.getElementById('infoCounterLimit');
        const cardCounterLimit = document.getElementById('cardCounterLimit');
        const userCounterLimit = document.getElementById('userCounterLimit');
        if (!infoCounterLimit || !cardCounterLimit || !userCounterLimit) {
            throw new Error('Required elements not found');
        }
        console.log("Config wird geladen");
        const res = await getData('../../config/config.json'); // Define ConfigData interface
        createList(res.maxCountForInfoPages, infoCounterLimit, res.defaultMaxCountForInfoPages);
        createList(res.maxCountForInfoTerminals, cardCounterLimit, res.defaultMaxCountForInfoTerminals);
        loadNumbers(res.userLimitMax, res.userLimitMin, res.defaultUserLimit, userCounterLimit);
        saveList(infoCounterLimit, "defaultMaxCountForInfoPages", "", "");
        saveList(cardCounterLimit, "defaultMaxCountForInfoTerminals", "", "");
        saveList(userCounterLimit, "defaultUserLimit", res.userLimitMax, res.userLimitMin);
    }
    catch (err) {
        console.error('Error loading config:', err);
    }
});
async function getData(url) {
    const result = await fetch(url);
    if (!result.ok)
        throw new Error(`Config nicht gefunden (Status ${result.status})`);
    return await result.json();
}
function createList(cfg, select, def) {
    console.log(def);
    select.innerHTML = "";
    for (const item of cfg) {
        const opt = document.createElement('option');
        opt.value = item.value.toString();
        opt.textContent = item.value.toString();
        select.appendChild(opt);
    }
    select.value = def.toString();
}
function loadNumbers(max, min, cfg, userCounterLimit) {
    console.log(max, min, cfg, userCounterLimit);
    userCounterLimit.value = "";
    if (cfg > max || cfg < min) {
        return;
    }
    userCounterLimit.value = cfg.toString();
}
function saveList(select, name, max, min) {
    select.addEventListener('change', async () => {
        const newDefault = parseFloat(select.value);
        console.log(`Neuer Default-Wert: ${newDefault}`);
        console.log(`Name: ${name}`);
        if (isNaN(newDefault)) {
            return;
        }
        if (name === "defaultUserLimit" && (newDefault > Number(max) || newDefault < Number(min))) {
            return;
        }
        try {
            const res = await fetch('../php/config.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ name, value: newDefault })
            });
            if (!res.ok)
                throw new Error(`Speichern fehlgeschlagen (Status ${res.status})`);
            const result = await res.json();
            if (!result.success) {
                alert('Fehler: ' + (result.error || 'Unbekannter Fehler'));
            }
        }
        catch (err) {
            console.error('Fehler beim Speichern der Config:', err);
            alert('Speicher-Fehler');
        }
    });
}
async function setData() {
    try {
        const data = await getData('../../config/configTest.json'); // Adjust type if possible
        const val1 = document.getElementById("val1");
        const val2 = document.getElementById("val2");
        const val3 = document.getElementById("val3");
        if (!val1 || !val2 || !val3) {
            throw new Error('Input elements not found');
        }
        val1.value = data.webpageSettings[0].maxCountForInfoPages.toString();
        val2.value = data.webpageSettings[0].maxCountForInfoPages.toString();
        val3.value = data.webpageSettings[0].userLimit.toString();
    }
    catch (err) {
        console.error("Error fetching data:", err);
    }
}
