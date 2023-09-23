const btnMobileMenu = document.querySelector("#menu-mobile");
const header = document.querySelector("#header-nav");
const navigation = document.querySelector("#navigation");
const headerBackground = document.querySelector("#background");
const links = document.querySelectorAll(".navigation__link");
const displayWidth = document.body.clientWidth;

if (displayWidth<751) {
    header.classList.add("header-mobile");
    navigation.classList.add("no-visible");
}

if(btnMobileMenu){
    const displayWidth = document.body.clientWidth;
    if (displayWidth<751) {
        btnMobileMenu.classList.remove("display-none");
    }
    btnMobileMenu.addEventListener("click", function(){
        header.classList.toggle("no-shadow");
        btnMobileMenu.classList.toggle("is-active");
        if(headerBackground.classList.contains("show")) {
            hideNavBar();

        } else {
            headerBackground.classList.add("show");   
            navigation.classList.remove("no-visible");
            navigation.classList.remove("hide");       
            navigation.classList.add("show");       
        }
    });
}

links.forEach(link => link.addEventListener("click", function(){

    if(header.classList.contains("header-mobile")){
        hideNavBar();
    }

    btnMobileMenu.classList.remove("is-active");
}));

window.addEventListener("resize", function(){
    const displayWidth = document.body.clientWidth;
    if(displayWidth<751){
        if (header.classList.contains("no-shadow") && !navigation.classList.contains("show")) {
            header.classList.remove("no-shadow")
        }
        if (!header.classList.contains("header-mobile")){
            header.classList.add("header-mobile");

            btnMobileMenu.classList.remove("display-none");
            btnMobileMenu.classList.remove("is-active"); 

            navigation.classList.add("no-visible");

            headerBackground.classList.remove("hide");
        }

    } else {

        if (header.classList.contains("no-shadow")) {
            header.classList.remove("no-shadow")
        }
        headerBackground.classList.remove("show");
        headerBackground.classList.remove("hide");
        navigation.classList.remove("show");

        if (navigation.classList.contains("no-visible")){
            navigation.classList.remove("no-visible");
        }
        btnMobileMenu.classList.add("display-none");
        header.classList.remove("header-mobile");
        headerBackground.classList.add("hide");
    }
});

function hideNavBar () {
    navigation.classList.remove("no-visible");
    header.classList.remove("no-shadow")
    headerBackground.classList.add("hide");
    navigation.classList.add("hide-opacity");

    setTimeout(() => {
        headerBackground.classList.remove("show");
        headerBackground.classList.remove("hide");

        navigation.classList.remove("show");
        navigation.classList.add("no-visible");
        navigation.classList.remove("hide-opacity");
    }, 500); 
}