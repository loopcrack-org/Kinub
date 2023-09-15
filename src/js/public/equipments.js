const equipmentsGrid = this.document.querySelector(".equipments__grid");
const equipments = document.querySelectorAll(".equipment");
const lastEquipment = equipments[equipments.length-1];
const displayWidth = document.body.clientWidth;

const dektopSize = 1007;

if (displayWidth >= dektopSize) {
    centerLastEquipment();
}

window.addEventListener("resize", function(){
    const displayWidth = document.body.clientWidth;
    if (displayWidth >= dektopSize) {
        centerLastEquipment();
    } else {
        if (lastEquipment.classList.contains("equipment--center")) {
            lastEquipment.classList.remove("equipment--center");
        }
    }
})

function centerLastEquipment(){
    if(equipments.length === 1 || equipments.length === 4 || equipments.length === 7){
        if (!lastEquipment.classList.contains("equipment--center")) {
            lastEquipment.classList.add("equipment--center");
        }
    }
}