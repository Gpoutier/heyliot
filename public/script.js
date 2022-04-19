let cat_btn = document.querySelector(".btn_cat")
cat_btn.addEventListener("click",cat)

function cat() {
    fetch('https://api.thecatapi.com/v1/images/search')
        .then(response => response.json())

}

