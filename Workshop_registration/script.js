
document.addEventListener("DOMContentLoaded", function () {

    fetch("get_workshops.php")
        .then(response => response.json())
        .then(data => {

            let workshopSelect =
                document.getElementById("workshop");

            workshopSelect.innerHTML =
                '<option value="">Select Workshop</option>';

            data.forEach(function (workshop) {

                let option = document.createElement("option");

                option.value = workshop.id;

                option.textContent =
                    workshop.workshop_name +
                    " - " +
                    workshop.workshop_date +
                    " (" +
                    workshop.available_seats +
                    " seats)";

                workshopSelect.appendChild(option);
            });

        })
        .catch(function () {

            document.getElementById("workshop").innerHTML =
                '<option value="">Unable to load workshops</option>';
        });

});



document.getElementById("registrationForm")
    .addEventListener("submit", function (event) {

        event.preventDefault();

        let form = this;

        let formData = new FormData(form);

        // Add remember option
        if (document.getElementById("remember").checked) {
            formData.append("remember", "yes");
        }

        fetch("register.php", {
            method: "POST",
            body: formData
        })

        .then(response => response.json())

        .then(data => {

            let message =
                document.getElementById("message");

            if (data.success) {

                message.className = "success";
                message.innerHTML = data.message;

                // Clear form
                form.reset();

                // Keep registration available in session
                setTimeout(function () {
                    window.location.href =
                        "my_registration.php";
                }, 1000);

            } else {

                message.className = "error";
                message.innerHTML = data.message;
            }

        })

        .catch(function () {

            document.getElementById("message").innerHTML =
                "Something went wrong.";

            document.getElementById("message")
                .className = "error";
        });

});