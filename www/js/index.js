/* Navigation Bar search */
function searchPost() {
    var input = document.getElementById("input").value;
    window.location.assign("/pages/posting.php?input=" + input);
}
/* Profile view go back */
function goBack() {
    window.history.back();
}