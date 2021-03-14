function hideForm() {
    document.getElementsByClassName("cookie-disclaimer-wrapper")[0].style.display = "none";
};

function acceptTerms() {
    document.cookie = "acceptedTerms=true";
    hideForm();
}