function itemRefresh(zoznamId) {
    setInterval(async function () {
        var response = await fetch('?c=zoznampolozky&a=getItems&zoznamId=' + zoznamId);
        var data = await response.json();
        data.items.forEach(function (item) {
            var cb = document.getElementById('item-check-' + item.id);
            if (cb && cb.checked !== (item.is_checked === 'Y')) {
                cb.checked = item.is_checked === 'Y';
            }
        });
        var zoznamCb = document.getElementById('zoznamBought');
        if (zoznamCb) {
            zoznamCb.checked = data.zoznam_is_bought === 'Y';
        }
    }, 10000);
}

async function addZoznam(groupId, loggedUserId) {
    const name = document.getElementById('zoznamName').value.trim();

    if (name.length < 2) {
        alert('Názov zoznamu je príliš krátky. Musí obsahovať minimálne 2 znaky.');
        return;
    }
    if (name.length > 100) {
        alert('Názov zoznamu je príliš dlhý. Musí obsahovať maximálne 100 znakov.');
        return;
    }

    var response = await fetch('?c=zoznamy&a=addZoznam', {
        method: 'POST',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Content-type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ zoznamName: name, groupId: groupId })
    });
    var data = await response.json();

    if (data.errors) {
        alert(data.errors[0]);
    } else if (data) {
        var new_content = `<tr>`;
        new_content += `<td>${data.name}</td>`;
        new_content += `<td>Is not Bought</td>`;
        new_content += `<td><a href="${data.showUrl}">Zobraziť zoznam</a></td>`;
        new_content += parseInt(data.creatorId) == parseInt(loggedUserId)
            ? `<td>
                    <a href="${data.updateUrl}">Upraviť</a>
                    <span style="margin: 0 5px;"></span>
                    <a href="${data.deleteUrl}" class="text-danger">Vymazať zoznam</a>
               </td>`
            : `<td></td>`;
        new_content += `</tr>`;
        document.getElementById('zoznamyTableBody').innerHTML += new_content;
        document.getElementById('zoznamName').value = '';
    }
}

function validate_registration(event) {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;
    const confirm  = document.getElementById('confirmPassword').value;

    if (username.length < 3) {
        alert('Používateľské meno je príliš krátke. Musí obsahovať minimálne 3 znaky.');
        event.preventDefault();
        return;
    }
    if (username.length > 15) {
        alert('Používateľské meno je príliš dlhé. Musí obsahovať maximálne 15 znakov.');
        event.preventDefault();
        return;
    }
    if (/\s/.test(username)) {
        alert('Používateľské meno nesmie obsahovať medzery.');
        event.preventDefault();
        return;
    }
    if (password.length < 6) {
        alert('Heslo je príliš krátke. Musí obsahovať minimálne 6 znakov.');
        event.preventDefault();
        return;
    }
    if (password.length > 15) {
        alert('Heslo je príliš dlhé. Musí obsahovať maximálne 15 znakov.');
        event.preventDefault();
        return;
    }
    if (password !== confirm) {
        alert('Heslá sa nezhodujú. Pre registráciu sa musia zhodovať.');
        event.preventDefault();
        return;
    }
}

function validate_login(event) {
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    if (username.length === 0) {
        alert('Zadajte používateľské meno.');
        event.preventDefault();
        return;
    }
    if (password.length === 0) {
        alert('Zadajte heslo.');
        event.preventDefault();
        return;
    }
}

function validate_editZoznam(event) {
    const name = document.getElementById('zoznamName').value.trim();
    if (name.length < 2) {
        alert('Názov zoznamu je príliš krátky. Musí obsahovať minimálne 2 znaky.');
        event.preventDefault();
        return;
    }
    if (name.length > 100) {
        alert('Názov zoznamu je príliš dlhý. Musí obsahovať maximálne 100 znakov.');
        event.preventDefault();
        return;
    }
}

function validate_polozka(event) {
    const name   = document.getElementById('name').value.trim();
    const amount = document.getElementById('amount').value;
    const price  = document.getElementById('price').value;

    if (name.length < 2) {
        alert('Názov položky je príliš krátky. Musí obsahovať minimálne 2 znaky.');
        event.preventDefault();
        return;
    }
    if (name.length > 100) {
        alert('Názov položky je príliš dlhý. Musí obsahovať maximálne 100 znakov.');
        event.preventDefault();
        return;
    }
    if (isNaN(parseInt(amount)) || parseInt(amount) < 1) {
        alert('Množstvo musí byť kladné celé číslo.');
        event.preventDefault();
        return;
    }
    if (isNaN(parseFloat(price)) || parseFloat(price) < 0) {
        alert('Cena musí byť nezáporné číslo.');
        event.preventDefault();
        return;
    }
}
