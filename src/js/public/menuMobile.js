const btnMobileMenu = document.querySelector("#menu-mobile");
const sidebar = document.querySelector(".sidebar");
if(btnMobileMenu){
    btnMobileMenu.addEventListener("click", function(){
        btnMobileMenu.classList.toggle("is-active");
        if(sidebar.classList.contains("show")) {
            sidebar.classList.add("hide");

            setTimeout(() => {
             sidebar.classList.remove("show");
             sidebar.classList.remove("hide");
            }, 500);
        } else {
            sidebar.classList.add("show");
        }
    });
}

window.addEventListener("resize", function(){
    const displayWidth = document.body.clientWidth;
    if(displayWidth>=768){
        sidebar.classList.remove("show");
        btnMobileMenu.classList.remove("is-active");
    }
})