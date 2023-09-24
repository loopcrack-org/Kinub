const btnMobileMenu = document.querySelector("#menu-mobile");
const header = document.querySelector("#header-nav");
const navigation = document.querySelector("#navigation");
const headerBackground = document.querySelector("#background");

if (isMobile()) {
    setMobileNavBar();
}

whatchMenuClicks();
whatchLinkClicks();
whatchResize();

function hideNavBar () {
    navigation.classList.remove("no-visible");
    header.classList.remove("no-shadow")
    headerBackground.classList.add("hide");
    navigation.classList.add("hide-opacity");

    setTimeout(() => {
        removeBackgroundClasses();

        navigation.classList.remove("show");
        navigation.classList.add("no-visible");
        navigation.classList.remove("hide-opacity");
    }, 500); 
}

function showNavBar() {
    navigation.classList.remove("no-visible");
    navigation.classList.remove("hide");       
    navigation.classList.add("show");    
}

function removeBackgroundClasses() {
    headerBackground.classList.remove("show");
    headerBackground.classList.remove("hide");
}

function isMobile(){
    const displayWidth = document.body.clientWidth;
    return displayWidth<768;
}

function isHeaderMobile() {
    return header.classList.contains("header-mobile");
}

function whatchMenuClicks() {
    btnMobileMenu.addEventListener("click", function(){
        header.classList.toggle("no-shadow");
        btnMobileMenu.classList.toggle("is-active");
        if (headerBackground.classList.contains("show")) {
            hideNavBar();
        } else {
            headerBackground.classList.add("show");   
            showNavBar();
        }
    });
}

function whatchLinkClicks() {
    const links = document.querySelectorAll(".navigation__link");

    links.forEach(link => link.addEventListener("click", function(){
        if (isHeaderMobile()){
            hideNavBar();
        }
        btnMobileMenu.classList.remove("is-active");
    }));
}

function whatchResize() {
    window.addEventListener("resize", function(){
        if (isMobile()){
            if (header.classList.contains("no-shadow") && !navigation.classList.contains("show")) {
                header.classList.remove("no-shadow")
            }
            if (!isHeaderMobile()){
                setMobileNavBar();
                btnMobileMenu.classList.remove("is-active"); 
    
                headerBackground.classList.remove("hide");
            }
        } else {
            if (header.classList.contains("no-shadow")) {
                header.classList.remove("no-shadow")
            }
            removeBackgroundClasses();
            navigation.classList.remove("show");
    
            if (navigation.classList.contains("no-visible")){
                navigation.classList.remove("no-visible");
            }
            btnMobileMenu.classList.add("display-none");
            header.classList.remove("header-mobile");
            headerBackground.classList.add("hide");
        }
    });
}

function setMobileNavBar() {
    header.classList.add("header-mobile");
    navigation.classList.add("no-visible");
    btnMobileMenu.classList.remove("display-none");
}