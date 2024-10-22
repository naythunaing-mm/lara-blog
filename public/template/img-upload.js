const dropArea = document.getElementById("drop-area");
const inputFile = document.getElementById("input-file");
const imageView = document.getElementById("img-view");

inputFile.addEventListener("change", uploadImage);
dropArea.addEventListener("dragover", function (e) {
    e.preventDefault();
});
dropArea.addEventListener("drop", function (e) {
    e.preventDefault();
    inputFile.files = e.dataTransfer.files;
    uploadImage();
});

function uploadImage() {
    const file = inputFile.files[0];
    const allowedExtensions = ["jpg", "png", "jpeg", "gif"];
    if (!file) {
        alert("Please select an image file.");
        return; // Exit the function early if no file is selected
    }
    if (file) {
        const fileName = file.name;
        const fileExtension = fileName.split(".").pop().toLowerCase();

        if (allowedExtensions.includes(fileExtension)) {
            let imgPath = URL.createObjectURL(file);
            imageView.style.backgroundImage = `url(${imgPath})`;
            imageView.textContent = "";
            imageView.style.border = "none";
        } else {
            alert("Extension accept only JPG, PNG, JPEG, and GIF");
            // Clear the input field
            inputFile.value = "";
        }
    }
}
