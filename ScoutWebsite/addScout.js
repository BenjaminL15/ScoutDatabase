const form = document.querySelector("form"),
    nextButton = form.querySelector(".nextButton"),
    backButton = form.querySelector(".backButton"),
    allInput = form.querySelectorAll(".first input");

nextButton.addEventListener("click", ()=> {
    allInput.forEach(input => {
        if(input.value != "") {
            form.classList.add('secActive');
        } else {
            form.classList.remove('secActive');
        }
    })
})


nextButton.addEventListener("click", ()=> form.classList.remove('secActive')); 