const modalLibrary = document.querySelector("#library-modal");
const modalEdit = document.querySelector("#library-edit-modal");
const modalUrl = document.querySelector("#url-modal");
const modalUpdate = document.querySelector("#modal-url-update");
const libraryDel = document.querySelector("#library-del");
const playlistDel = document.querySelector("#playlist-del");

function librariesDelete() {
    if (libraryDel.style.display === "none") {
        libraryDel.style.display = "flex";
    } else {
        libraryDel.style.display = "none";
    }
}

function modalDelPlay(id) {
    document.querySelector('#playlist-del input[name="playlist_id"]').value =
        id;

    // example for tenary condition
    playlistDel.style.display = !playlistDel.style.display
        ? "flex"
        : playlistDel.style.display === "none"
        ? "flex"
        : "none";
}

function urlInput() {
    if (modalUrl.style.display === "none") {
        modalUrl.style.display = "flex";
    } else {
        modalUrl.style.display = "none";
    }
}

function modalAddLibrary() {
    if (modalLibrary.style.display === "none") {
        modalLibrary.style.display = "flex";
    } else {
        modalLibrary.style.display = "none";
    }
}

function editModal() {
    if (modalEdit.style.display === "none") {
        modalEdit.style.display = "flex";
    } else {
        modalEdit.style.display = "none";
    }
}

function closeModal() {
    modalLibrary.style.display = "none";
    modalEdit.style.display = "none";
    modalUrl.style.display = "none";
    modalUpdate.style.display = "none";
    libraryDel.style.display = "none";
    playlistDel.style.display = "none";
}

function submitModal() {
    closeModal();
}
