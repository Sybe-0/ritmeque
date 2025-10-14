const ul = document.getElementById("playlist-table");
let draggedItem = null;
let draggedOverItem = null;

ul.addEventListener("dragstart", (e) => {
    if (e.target.classList.contains("drag-handle")) {
        draggedItem = e.target.parentElement;
        draggedItem.classList.add("dragging");
        e.dataTransfer.effectAllowed = "move";
        e.dataTransfer.setData("text/html", draggedItem.outerHTML);
    } else {
        e.preventDefault();
    }
});

ul.addEventListener("dragend", (e) => {
    if (draggedItem) {
        draggedItem.classList.remove("dragging");
        ul.querySelectorAll("li").forEach((li) =>
            li.classList.remove("drag-over")
        );
        draggedItem = null;
        draggedOverItem = null;
    }
});

ul.addEventListener("dragover", (e) => {
    e.preventDefault();
    e.dataTransfer.dropEffect = "move";
});

ul.addEventListener("dragenter", (e) => {
    const targetLi = e.target.closest("li");
    if (targetLi && targetLi.tagName === "LI" && targetLi !== draggedItem) {
        e.preventDefault();
        targetLi.classList.add("drag-over");
        draggedOverItem = targetLi;
    }
});

ul.addEventListener("dragleave", (e) => {
    const targetLi = e.target.closest("li");
    if (targetLi && targetLi.tagName === "LI" && targetLi !== draggedItem) {
        targetLi.classList.remove("drag-over");
    }
});

ul.addEventListener("drop", (e) => {
    e.preventDefault();
    if (draggedItem && draggedOverItem) {
        const rect = draggedOverItem.getBoundingClientRect();
        const midpoint = rect.top + rect.height / 2;

        if (e.clientY < midpoint) {
            ul.insertBefore(draggedItem, draggedOverItem);
        } else {
            ul.insertBefore(draggedItem, draggedOverItem.nextSibling);
        }
    } else if (draggedItem) {
        ul.appendChild(draggedItem);
    }

    const newOrder = Array.from(ul.querySelectorAll("li")).map((li) => {
        return parseInt(li.dataset.id);
    });
    fetch("/playlist/order", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document
                .querySelector('meta[name="csrf-token"]')
                .getContent(),
        },
        body: JSON.stringify({ order: newOrder }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.success) {
                console.log("Urutan disimpan:", data.order);
            } else {
                console.error("Error:", data.message);
            }
        })
        .catch((error) => console.error("Gagal kirim:", error));

    ul.querySelectorAll("li").forEach((li) => li.classList.remove("drag-over"));
});
