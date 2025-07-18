function addRow() {
    const tbody = document.getElementById("attendanceList");
    const rowCount = tbody.rows.length;
    const row = tbody.insertRow();

    for (let i = 0; i < 6; i++) {
        const cell = row.insertCell();
        if (i === 0) cell.textContent = rowCount + 1;
    }
}

function deleteLastRow() {
    const tbody = document.getElementById("attendanceList");
    if (tbody.rows.length > 0) {
        tbody.deleteRow(tbody.rows.length - 1);
    }

    // Re-numbering
    for (let i = 0; i < tbody.rows.length; i++) {
        tbody.rows[i].cells[0].textContent = i + 1;
    }
}

function setInfo() {
    const tanggal = document.getElementById("inputTanggal").value.trim();
    const waktu = document.getElementById("inputWaktu").value.trim();
    const tempat = document.getElementById("inputTempat").value.trim();
    const acara = document.getElementById("inputAcara").value.trim();

    if (tanggal) document.getElementById("tanggalText").textContent = tanggal;
    if (waktu) document.getElementById("waktuText").textContent = waktu;
    if (tempat) document.getElementById("tempatText").textContent = tempat;
    if (acara) document.getElementById("acaraText").textContent = acara;
}
