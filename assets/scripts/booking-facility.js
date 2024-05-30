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

bookingDate.addEventListener("change", () => {
  window.location.href =
    window.location.pathname + "?date=" + bookingDate.value;
});

select.addEventListener("change", () => {
  const selectedOption = select.value;
  const li = document.getElementById(selectedOption);
  if (selectedOption == 0) return;
  handleTableSelection(li);
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
  newTable.setAttribute("role", "listitem");

  const removeButton = document.createElement("button");
  const removeIcon = document.createElement("i");
  removeButton.appendChild(removeIcon);
  removeButton.setAttribute("aria-label", "remove table " + li.innerText);
  removeIcon.classList.add("fas", "fa-times");
  removeIcon.setAttribute("title", "remove table");
  removeIcon.addEventListener("click", () => {
    selectedTablesList.removeChild(newTable);
    handleTableSelection(li);
  });

  newTable.appendChild(removeButton);
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
  post("/booking-facility", {
    tables: JSON.stringify(selectedTables),
    date: bookingDate.value,
  });
});

function post(path, params, method = "post") {
  const form = document.createElement("form");
  form.method = method;
  form.action = path;

  for (const key in params) {
    if (params.hasOwnProperty(key)) {
      const hiddenField = document.createElement("input");
      hiddenField.type = "hidden";
      hiddenField.name = key;
      hiddenField.value = params[key];

      form.appendChild(hiddenField);
    }
  }

  document.body.appendChild(form);
  form.submit();
}
