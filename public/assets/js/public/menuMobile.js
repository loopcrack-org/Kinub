const btnMobileMenu=document.querySelector("#menu-mobile"),headerMobile=document.querySelector("#header-mobile"),sidebar=document.querySelector(".sidebar");btnMobileMenu&&btnMobileMenu.addEventListener("click",function(){headerMobile.classList.toggle("no-shadow"),btnMobileMenu.classList.toggle("is-active"),sidebar.classList.contains("show")?(sidebar.classList.add("hide"),setTimeout(()=>{sidebar.classList.remove("show"),sidebar.classList.remove("hide")},500)):sidebar.classList.add("show")}),window.addEventListener("resize",function(){768<=document.body.clientWidth&&(sidebar.classList.remove("show"),btnMobileMenu.classList.remove("is-active"))});
//# sourceMappingURL=menuMobile.js.map
