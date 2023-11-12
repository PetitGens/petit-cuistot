document.getElementById('tag').addEventListener("click", () => {
    document.getElementById("searchbar").classList.remove('visually-hidden');
    document.getElementById('filtre').setAttribute('value','tag')
    document.getElementById("info_recherche").classList.remove('visually-hidden');
})
document.getElementById('titre').addEventListener("click", () => {
    document.getElementById("searchbar").classList.remove('visually-hidden');
    document.getElementById('filtre').setAttribute('value','titre')
})
document.getElementById('ingredients').addEventListener("click", () => {
    document.getElementById("searchbar").classList.remove('visually-hidden');
    document.getElementById('filtre').setAttribute('value','ingredient')
    document.getElementById("info_recherche").classList.remove('visually-hidden');
})