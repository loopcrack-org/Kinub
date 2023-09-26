const btnMobileMenu = document.querySelector("#menu-mobile");
const headerMobile = document.querySelector("#header-mobile");

const sidebar = document.querySelector(".sidebar");
const links = document.querySelectorAll(".navigation-mobile__link");

if(btnMobileMenu){
    btnMobileMenu.addEventListener("click", function(){
        headerMobile.classList.toggle("no-shadow");
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

links.forEach(link => link.addEventListener("click", function(){
    sidebar.classList.add("hide");
    headerMobile.classList.toggle("no-shadow");

    setTimeout(() => {
        sidebar.classList.remove("show");
        sidebar.classList.remove("hide");
       }, 500);

    btnMobileMenu.classList.remove("is-active");
}));

window.addEventListener("resize", function(){
    const displayWidth = document.body.clientWidth;
    if(displayWidth>=768){
        sidebar.classList.remove("show");
        btnMobileMenu.classList.remove("is-active");
    }
})