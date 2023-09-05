document.querySelector("#btn-whatsapp").addEventListener("click", (e) => {
    e.preventDefault();
  
    const whatsappNumber = "529993102600";
  
    const url = `https://api.whatsapp.com/send/?phone=${whatsappNumber}&text=
      *_WHATSAPP KINUB_*%0A
      *Hola, solicito información sobre dispositivos*`;
    window.open(url);
  });