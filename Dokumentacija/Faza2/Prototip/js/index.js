//Autor: Dušan Stanivuković

function checkRegistration() {
    $(document).ready(function () {
        var firstName = $("#validationDefaultName").val();
        var lastName = $("#validationDefaultLastName").val();
        var username = $("#validationDefaultUsername").val();
        var password = $("#validationDefaultPassword").val();
        var passwordConfirm = $("#validationDefaultConfirmPassword").val();
        var email = $("#validationDefaultEmail").val();
        var phone = $("#validationDefaultPhone").val();

        var regexMail = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/;
        var regexTel = /^\d{3}\/\d{3}-\d{2}-\d{2}$/;

        if (firstName == "") {
            alert("Morate uneti ime");
        } else if (lastName == "") {
            alert("Morate uneti prezime");
        } else if (username == "") {
            alert("Morate uneti korisničko ime");
        } else if (password == "") {
            alert("Morate uneti password");
        } else if (passwordConfirm == "") {
            alert("Morate potvrditi password");
        } else if (email == "") {
            alert("Morate uneti e-mail");
        } else if (phone == "") {
            alert("Morate uneti telefon");
        } else {
            if (!regexMail.test(email)) {
                alert("Morate uneti validnu e-mail adresu");
            } else if (!regexTel.test(phone)) {
                alert("Morate uneti validan telefon");
            } else if (password.localeCompare(passwordConfirm) != 0) {
                alert("Lozinke se moraju podudarati");
            } else if (password.length < 4) {
                alert("Lozinka je previše kratka");
            }
            else {
                if (localStorage.getItem("username#" + username) != null) {
                    alert("Korisnik sa unetim korisničkim imenom već postoji");
                } else {
                    localStorage.setItem("username#" + username, password);
                    alert("Uspešno ste se registrovali!");
                }
            }
        }
    });
}

function checkLogin() {
    $(document).ready(function () {
        var username = $("#validationDefaultUsername").val();
        var password = $("#validationDefaultPassword").val();

        if ((username == "admin" && password == "admin") || (password == localStorage.getItem("username#" + username))) {
            alert("Uspešno ste se ulogovali");
        } else {
            alert("Korisničko ime i/ili lozinka nisu ispravni");
        }
    });
}

function sendPassword() {
    $(document).ready(function () {
        var username = $("#validationDefaultUsername").val();
        if (username == "") {
            alert("Morate uneti korisničko ime");
        } else if (localStorage.getItem("username#" + username) == null) {
            alert("Ne postoji nalog sa unetim korisničkim imenom");
        } else {
            alert("Lozinka Vam je poslata na e-mail");
        }
    });
}

function reserve() {
    $(document).ready(function () {
        var date = $("#validationDefaultDate").val();
        var time = $("#validationDefaultTime").val();

        if (date == "") {
            alert("Morate uneti datum");
        } else if (time == "") {
            alert("Morate uneti vreme");
        } else {
            alert("Uspešno ste rezervisali termin");
        }
    });
}

function order() {
    $(document).ready(function () {
        var place = $("#validationDefaultPlace").val();
        var street = $("#validationDefaultStreet").val();
        var number = $("#validationDefaultNumber").val();
        var quantity = $("#validationDefaultQuantity").val();

        if (place == "") {
            alert("Morate uneti mesto");
        } else if (street == "") {
            alert("Morate uneti ulicu");
        } else if (number == "" || number <= 0) {
            alert("Morate uneti broj");
        } else if (quantity == "" || quantity <= 0) {
            alert("Morate uneti kolicinu");
        } else {
            alert("Uspešno ste dodali proizvod u korpu");
        }
    });
}

function input(par1, par2, par3) {
    $(document).ready(function () {
        var a1 = $("#" + par1).val();
        var a2 = $("#" + par2).val();
        var a3 = $("#" + par3).val();
        var img = $("#imageFile").val();

        if (a1 == "" || a2 == "" || a3 == "" || img == "") {
            alert("Morate uneti sve podatke");
        } else {
            alert("Uspešno ste uneli proizvod");
        }
    });
}