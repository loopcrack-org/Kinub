displayAlert();
function displayAlert() {
    const alertResponse = document.querySelector("#alert-deletedcategory");

    if (alertResponse) {
        const responseData = JSON.parse(
            alertResponse.getAttribute("data-response")
        );

        Swal.fire({
            icon: responseData.type,
            title: responseData.title,
            text: responseData.message,
            confirmButtonColor: "#0174F6",
        });
    }
}
