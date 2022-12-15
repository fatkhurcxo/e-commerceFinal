var myModal = new bootstrap.Modal(document.getElementById("mymodal"), {});
document.onreadystatechange = function () {
    myModal.show();
};

// if (window.history.replaceState) {
//     window.history.replaceState(null, null, window.location.href);
// }