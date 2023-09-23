function displayAlert(){var e=document.querySelector("#alert-deletedcategory");e&&(e=JSON.parse(e.getAttribute("data-response")),Swal.fire({icon:e.type,title:e.title,text:e.message,confirmButtonColor:"#0174F6"}))}displayAlert();
//# sourceMappingURL=alert-deleteElement.js.map
