const btnMobileMenu=document.querySelector("#menu-mobile"),sidebar=document.querySelector(".sidebar");btnMobileMenu&&btnMobileMenu.addEventListener("click",function(){btnMobileMenu.classList.toggle("is-active"),sidebar.classList.contains("show")?(sidebar.classList.add("hide"),setTimeout(()=>{sidebar.classList.remove("show"),sidebar.classList.remove("hide")},500)):sidebar.classList.add("show")}),window.addEventListener("resize",function(){768<=document.body.clientWidth&&sidebar.classList.remove("show")});
//# sourceMappingURL=menuMobile.js.map
