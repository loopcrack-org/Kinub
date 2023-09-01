const btnMobileMenu = document.querySelector("#mobile-menu");
const btnCloseMenu = document.querySelector("#close-menu")
const sidebar = document.querySelector(".sidebar");
if(btnMobileMenu){
    btnMobileMenu.addEventListener("click", function(){
        sidebar.classList.add("show");
    });
}

if((btnCloseMenu)){
    btnCloseMenu.addEventListener("click", function(){
        sidebar.classList.add("hide");

        setTimeout(() => {
            sidebar.classList.remove("show");
            sidebar.classList.remove("hide");
        }, 500);
    })
}

window.addEventListener("resize", function(){
    const displayWidth = document.body.clientWidth; //Get the display size
    if(displayWidth>=768){
        sidebar.classList.remove("show");
    }
})