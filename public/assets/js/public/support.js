document.addEventListener("DOMContentLoaded",function(){const t=document.querySelector("#support-form"),r=document.querySelectorAll(".support-progress__name"),o=document.querySelectorAll(".support-progress__bullet");let s=1;const n=document.querySelectorAll(".support-form__fieldset");n.forEach(e=>{e.classList.remove("support-form__fieldset--active")}),n[s-1].classList.add("support-form__fieldset--active");var e={required:"campo obligatorio",email:"correo inválido",phone:"teléfono inválido"};function i(e){r[e-1].classList.add("support-progress__name--active"),o[e-1].classList.add("support-progress__bullet--active")}var a={add:function(e,t,r){c(e,t,r)},remove:function(e,t){c(e,"",t)}},l={container:"#support-form",button:"#btn-submit",validationBy:"onclick",messages:{required:e.required},customViewErrors:a,onFormSubmit:function(e){i(s),document.querySelector("#support-form").submit()}};new VanillaValidator({container:".support-form__step",button:".next-step",validationBy:"onclick",selectors:{error:"is-invalid",messageError:"invalid-feedback"},messages:e,customViewErrors:a,onContainerSuccess:function(e){s++,t.style.transform=`translateX(-${100*(s-1)}%)`,n[s-1].classList.add("support-form__fieldset--active"),i(s-1)}}),new VanillaValidator(l);function c(e,t,r){var o,e=e.getAttribute("data-errors-id");e&&(e=document.getElementById(e))&&(o=Boolean(t),e=e,r=r,t=t,o?(e.classList.add("support-form__error--active",r),e.innerHTML=t):(e.classList.remove("support-form__error--active",r),e.innerHTML=""))}document.querySelectorAll(".prev-step").forEach(e=>{e.addEventListener("click",function(){1<s&&(s--,t.style.transform=`translateX(-${100*(s-1)}%)`,r[s-1].classList.remove("support-progress__name--active"),o[s-1].classList.remove("support-progress__bullet--active"))})}),(e=document.querySelector("#alert-response"))&&(e=JSON.parse(e.getAttribute("data-response")),Swal.fire({icon:e.type,title:e.title,text:e.message,confirmButtonColor:"#0174F6"}))});
//# sourceMappingURL=support.js.map
