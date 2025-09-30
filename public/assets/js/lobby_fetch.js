const modalUpdateUrl = document.querySelector("#modal-url-update");
const btnUrl = document.querySelector("#url-btn");
//area const for any on play area.
const libraryTitle = document.querySelector("#library-title");
const libraryDesc = document.querySelector("#library-description");
const favBtnId = document.querySelector("#form-fav-btn");
const inputFav = document.querySelector(".input-fav");
const playlistTable = document.querySelector("#playlist-table");

const idGlobal = "";

function libraries(idlibrary) {
    const idGlobal = idlibrary;
    fetch("/library/find?id=" + idlibrary)
        .then((response) => response.json())
        .then((data) => {
            if (data.is_favorite === true) {
                inputFav.checked = true;
            } else {
                inputFav.checked = false;
            }

            favBtnId.style.display = "flex";
            btnUrl.style.display = "flex";
            libraryTitle.textContent = data.title;
            libraryDesc.textContent = data.description;
            document.querySelector(
                '#url-modal input[name="libraries_id"]'
            ).value = idGlobal;
            document.querySelector(
                '#library-del input[name="libraries_id"]'
            ).value = idGlobal;
            document.querySelector(
                '#library-edit-modal input[name="libraries_id"]'
            ).value = idGlobal;
            document.querySelector(
                '#library-edit-modal input[name="title"]'
            ).value = data.title;
            document.querySelector(
                '#library-edit-modal input[name="description"]'
            ).value = data.description;
        });

    fetch("/library/playlist/find?id=" + idGlobal)
        .then((response) => response.json())
        .then((list) => {
            playlistTable.innerHTML = "";
            list.forEach((play) => {
                let list = `<div class="flex justify-between items-center w-full border-b-[1px] mt-2">
                                <div class="flex">
                                    <p></p>
                                    <div class="text-xl">${play.songs}</div>
                                    </div>
                                <div class="flex">
                                    <button class="mr-2 px-2" onclick="modalUpdatePlay(${play.id})">Edit</button>
                                    <button class="ml-2 px-2 bg-custom-pink rounded-[4px]" onclick="modalDelPlay(${play.id})">Hapus</button>
                                    </div>
                            </div>`;
                playlistTable.insertAdjacentHTML("beforeend", list);
            });
        });
    console.log(idGlobal);
    inputFav.addEventListener("change", async function () {
        fetch("/library/favbtn?id=" + idGlobal, {
            method: "GET",
            headers: {
                Accept: "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                libraries(data);
            });
    });
}

document
    .querySelector("#form-update-library")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const update = e.target;
        const updLibrary = new FormData(update);

        fetch("/home/edit/library", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": updLibrary.get("_token"),
                Accept: "application/json",
            },
            body: updLibrary,
        })
            .then((response) => response.json())
            .then((data) => {
                libraries(data.users_id);
            });
    });

document.addEventListener("DOMContentLoaded", function () {
    const librarySearch = document.querySelector("#search-library");
    const libraryResult = document.querySelector("#result-library");
    librarySearch.addEventListener("keyup", function () {
        const query = this.value.trim();
        if (query.length > 0) {
            fetch(`/home/library/search?query=${encodeURIComponent(query)}`)
                .then((response) => response.json())
                .then((data) => {
                    let html = "";
                    if (data.length > 0) {
                        data.forEach((item) => {
                            html += `<div>${item.title}</div>`;
                        });
                    } else {
                        html = "<div>Library not found</div>";
                    }
                    libraryResult.innerHTML = html;
                })
                .catch((error) => {
                    console.error("Error:", error);
                    libraryResult.innerHTML =
                        "<div>Something wrong, please wait!</div>";
                });
        } else {
            libraryResult.innerHTML = "";
        }
    });
});

document
    .querySelector("#form-update-playlist")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const upd = e.target;
        const updData = new FormData(upd);

        fetch("/home/edit/playlist", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": updData.get("_token"),
                Accept: "application/json",
            },
            body: updData,
        })
            .then((response) => response.json())
            .then((data) => {
                libraries(data.libraries_id);
            });
    });

document
    .querySelector("#form-delete-playlist")
    .addEventListener("submit", function (e) {
        e.preventDefault();
        const del = e.target;
        const delData = new FormData(del);

        fetch("/playlist/delete", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": delData.get("_token"),
                Accept: "application/json",
            },
            body: delData,
        })
            .then((response) => response.json())
            .then((data) => {
                libraries(data.libraries_id);
            });
    });

document
    .querySelector("#form-add-playlist")
    .addEventListener("submit", function (e) {
        e.preventDefault();

        const add = e.target;
        const addData = new FormData(add);

        fetch("/home/playlist", {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": addData.get("_token"),
                Accept: "application/json",
            },
            body: addData,
        })
            .then((response) => response.json())
            .then((data) => {
                libraries(data.libraries_id);
            });
    });

function modalUpdatePlay(id) {
    fetch("/playlist/find?id=" + id)
        .then((response) => response.json())
        .then((alpha) => {
            document.querySelector(
                '#modal-url-update input[name="playlist_id"]'
            ).value = id;
            document.querySelector(
                '#modal-url-update input[name="songs"]'
            ).value = alpha.songs;
            document.querySelector(
                '#modal-url-update input[name="url_link"]'
            ).value = alpha.url_link;
        });
    if (modalUpdateUrl.style.display === "none") {
        modalUpdateUrl.style.display = "flex";
    } else {
        modalUpdateUrl.style.display = "none";
    }
}
