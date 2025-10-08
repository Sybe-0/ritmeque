const modalLibrary = document.querySelector("#library-modal");
const modalEdit = document.querySelector("#library-edit-modal");
const modalUrl = document.querySelector("#url-modal");
const modalUpdate = document.querySelector("#modal-url-update");
const libraryDel = document.querySelector("#library-del");
const playlistDel = document.querySelector("#playlist-del");

function librariesDelete() {
    // if (libraryDel.style.display === "none") {
    //     libraryDel.style.display = "flex";
    // } else {
    //     libraryDel.style.display = "none";
    // }
    libraryDel.style.display = !libraryDel.style.display ? "flex" : libraryDel.style.display === "none" ? "flex" : "none";
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
    modalUrl.style.display = !modalUrl.style.display ? "flex" : modalUrl.style.display === "none" ? "flex" : "none";
}

function modalAddLibrary() {
    modalLibrary.style.display = !modalLibrary.style.display ? "flex" : modalLibrary.style.display === "none" ? "flex" : "none";
}

function editModal() {
    modalEdit.style.display = !modalEdit.style.display ? "flex" : modalEdit.style.display === "none" ? "flex" : "none";
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
