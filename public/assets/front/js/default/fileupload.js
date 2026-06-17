"use strict";

const fileUploadElem = document.getElementById("fileUpload");

const uploadUrl = fileUploadElem ? fileUploadElem.getAttribute("data-url") : "";
const csrfToken = fileUploadElem
    ? fileUploadElem.getAttribute("data-token")
    : "";

var notyf = new Notyf({
    duration: 5000,
});

Dropzone.autoDiscover = false;
const dropzone = new Dropzone("#fileUpload", {
    url: uploadUrl,
    method: "post",
    maxFilesize: 100,
    parallelUploads: 5,
    uploadMultiple: true,
    addRemoveLinks: false,
    previewsContainer: false,
    clickable: "#fileUpload",
    headers: {
        "X-CSRF-TOKEN": csrfToken,
    },
    init: function () {
        this.on("addedfile", function (file) {
            createListItem(file);
        });

        this.on("uploadprogress", function (file, progress) {
            const progressBar = document.getElementById(
                `progress-${file.upload.uuid}`,
            );
            if (progressBar) {
                progressBar.style.width = `${progress}%`;
            }
        });

        this.on("successmultiple", function (files, response) {
            if (response && response.files) {
                files.forEach((file) => {
                    const matchedFile = response.files.find(
                        (f) => f.name === file.name,
                    );
                    if (matchedFile) {
                        const listItem = document.getElementById(
                            `file-${file.upload.uuid}`,
                        );
                        if (listItem) {
                            const progressBar =
                                listItem.querySelector(".progress-bar");
                            if (progressBar) {
                                progressBar.classList.remove(
                                    "progress-bar-animated",
                                );
                                progressBar.classList.add("bg-success");
                                progressBar.style.width = "100%";
                            }

                            listItem.id = `file-${matchedFile.id}`;

                            const deleteBtn = listItem.querySelector("button");
                            if (deleteBtn) {
                                deleteBtn.setAttribute(
                                    "onclick",
                                    `removeFile('${matchedFile.id}')`,
                                );
                            }
                        }
                    }
                });
                setDynamicOption(response);
            }
        });

        this.on("errormultiple", function (files, errorMessage) {
            let message = "Upload failed";
            if (typeof errorMessage === "string") {
                message = errorMessage;
            } else if (errorMessage && errorMessage.errors) {
                message = Object.values(errorMessage.errors).flat().join(", ");
            } else if (errorMessage && errorMessage.message) {
                message = errorMessage.message;
            }

            notyf.error(message);

            files.forEach((file) => {
                const listItem = document.getElementById(
                    `file-${file.upload.uuid}`,
                );
                if (listItem) {
                    const progressBar = listItem.querySelector(".progress-bar");
                    if (progressBar) {
                        progressBar.classList.remove(
                            "progress-bar-striped",
                            "progress-bar-animated",
                        );
                        progressBar.classList.add("bg-danger");
                        progressBar.style.width = "100%";
                    }
                }
            });
        });
    },
});

function setDynamicOption(response) {
    var previewFileInput = document.getElementById("preview_file_input");
    var screenshotsInput = document.getElementById("screenshot_input");
    var uploadSource = document.getElementById("upload_source");

    if (previewFileInput)
        previewFileInput.innerHTML = '<option value="">Select File</option>';
    if (screenshotsInput)
        screenshotsInput.innerHTML = '<option value="">Select File</option>';
    if (uploadSource)
        uploadSource.innerHTML = '<option value="">Select File</option>';

    if (response && response.files) {
        response.files.forEach((file) => {
            if (previewFileInput) {
                var previewOption = document.createElement("option");
                previewOption.value = file.path;
                previewOption.text = file.name;
                previewFileInput.add(previewOption);
            }

            if (screenshotsInput) {
                var screenOption = document.createElement("option");
                screenOption.value = file.path;
                screenOption.text = file.name;
                screenshotsInput.add(screenOption);
            }

            if (uploadSource) {
                var uploadOption = document.createElement("option");
                uploadOption.value = file.path;
                uploadOption.text = file.name;
                uploadSource.add(uploadOption);
            }
        });
    }
}

function getIcon(fileType) {
    let fileIcon = "bi-file-earmark";
    if (!fileType) return fileIcon;
    if (fileType.startsWith("image/")) fileIcon = "bi-file-earmark-image";
    else if (fileType.startsWith("video/")) fileIcon = "bi-file-earmark-play";
    else if (fileType.startsWith("audio/")) fileIcon = "bi-file-earmark-music";
    else if (fileType.endsWith("pdf")) fileIcon = "bi-file-earmark-pdf";
    else if (fileType.startsWith("text/")) fileIcon = "bi-file-earmark-text";
    else if (fileType.startsWith("application/"))
        fileIcon = "bi-file-earmark-zip";
    return fileIcon;
}

function createListItem(file) {
    const fileIcon = getIcon(file.type);
    const listItem = document.createElement("li");
    listItem.className =
        "list-group-item file-list-item d-flex align-items-center justify-content-between";
    listItem.id = `file-${file.upload.uuid}`;
    listItem.innerHTML = `
        <div class="w-100">
            <div class="d-flex align-items-center mb-2">
                <i class="bi ${fileIcon} fs-3 me-3 text-primary"></i>
                <span>${file.name} <span class="file-size text-muted">(${getFileSize(file)})</span></span>
            </div>
            <div class="progress me-3" style="width:100%; height: 5px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                     role="progressbar"
                     style="width: 0%;"
                     id="progress-${file.upload.uuid}"></div>
            </div>
        </div>
        <button type="button" class="btn btn-danger btn-sm justify-content-end ms-3"
                onclick="cancelOrRemoveTmpFile('${file.upload.uuid}', this)">
            <i class="bi bi-trash3"></i>
        </button>
    `;
    document.getElementById("fileList").appendChild(listItem);
}

function getFileSize(file) {
    const size = file.size;
    if (size === 0) return "0 B";
    const i = Math.floor(Math.log(size) / Math.log(1024));
    return `${(size / Math.pow(1024, i)).toFixed(2) * 1} ${["B", "KB", "MB", "GB", "TB"][i]}`;
}

function removeFile(id) {
    const deleteUrl = `/user/item-destroy/${id}`;

    fetch(deleteUrl, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json",
            Accept: "application/json",
        },
    })
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((data) => {
            if (data.status === "success") {
                const listItem = document.getElementById(`file-${id}`);
                if (listItem) {
                    listItem.remove();
                }

                notyf.success(data.message || "Item removed successfully");

                setDynamicOption(data);
            } else {
                notyf.error(data.message || "Failed to delete file");
            }
        })
        .catch((error) => {
            console.error("Error:", error);
            notyf.error("Failed to delete file");
        });
}
function cancelOrRemoveTmpFile(uuid, btn) {
    const listItem = document.getElementById(`file-${uuid}`);
    if (listItem) {
        listItem.remove();
    }
}

document
    .getElementById("main_resource_select")
    .addEventListener("change", function () {
        const value = this.value;
        const UploadSource = document.getElementById("upload_source");
        const LinkSource = document.getElementById("link_source");

        if (value === "upload") {
            if (UploadSource) UploadSource.classList.remove("d-none");
            if (LinkSource) LinkSource.classList.add("d-none");
        } else if (value === "link") {
            if (UploadSource) UploadSource.classList.add("d-none");
            if (LinkSource) LinkSource.classList.remove("d-none");
        }
    });
