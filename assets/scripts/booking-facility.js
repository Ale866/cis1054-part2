const list = document.getElementById("tableList");
const selectedTablesList = document.getElementById("selected-tables-list");
let selectedTables = [];
const bookingDate = document.getElementById("booking-date");

[...list.children].forEach((li) => {
  li.addEventListener("click", () => {
    handleTableSelection(li);
  });
});

const select = document.getElementById("booking-select");

select.addEventListener("change", () => {
  const selectedOption = select.value;
  const li = document.getElementById(selectedOption);
  if (selectedOption == 0) return;
  handleTableSelection(li);
  select.selectedIndex = 0;
});

function handleTableSelection(li) {
  const tableId = parseInt(li.id);
  const isTableTaken = li.dataset.tableistaken === "true";

  if (!isTableTaken) {
    // Check if the table is already selected
    const isTableSelected = selectedTables.some(
      (table) => table.id === tableId
    );

    if (!isTableSelected) {
      // First time selecting the table
      selectedTables.push({ id: tableId, isTaken: true });
      li.style.backgroundColor = "green";
      createNewSelectedTable(li);
    } else {
      // Second time selecting the table
      selectedTables = selectedTables.filter((table) => table.id !== tableId);
      li.dataset.tableistaken = "false";
      li.style.backgroundColor = "#6f4518";
      removeSelectedTable(li);
    }
  }
}

function createNewSelectedTable(li) {
  const newTable = document.createElement("div");
  newTable.setAttribute("id", "selected-table-" + li.id);
  newTable.innerHTML = li.innerText;

  const removeIcon = document.createElement("i");
  removeIcon.classList.add("fas", "fa-times");
  removeIcon.setAttribute("title", "remove table");
  removeIcon.addEventListener("click", () => {
    selectedTablesList.removeChild(newTable);
    handleTableSelection(li);
  });

  newTable.appendChild(removeIcon);
  selectedTablesList.appendChild(newTable);
}

function removeSelectedTable(li) {
  const selectedTableId = "selected-table-" + li.id;
  const selectedTable = document.getElementById(selectedTableId);
  if (selectedTable) {
    selectedTablesList.removeChild(selectedTable);
  }
}

document.getElementById("book-btn").addEventListener("click", async (e) => {
  let results = await fetch("booking-facility.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({ tables: selectedTables, date: bookingDate.value }),
  });
  if (!results.ok) {
    return;
  }

  for (table of selectedTables) {
    let li = document.getElementById(table.id);
    li.style.backgroundColor = "";
    li.dataset.tableistaken = table.isTaken ? "true" : "false";
  }
});
