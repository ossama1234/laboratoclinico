console.log('maluquisimo');

const registrar = (e) => {

    e.preventDefault();
    const formuser = document.querySelector('#formuser');
    const name = document.querySelector('#name').value;
    const lastname = document.querySelector('#lastname').value;
    const address = document.querySelector('#address').value;
    const age = document.querySelector('#age').value;
    const email = document.querySelector('#email').value;
    const electrolitos = document.querySelector('#electrolitos').value;
    const glucosa = document.querySelector('#glucosa').value;
    const azucar = document.querySelector('#azucar').value;
    const proteina = document.querySelector('#proteina').value;

    if (!name || name.trim() == "" || name.trim().length <= 3) {

        alert("El nombre está vacio");

    } else if (!lastname || lastname.trim() == "" || lastname.trim().length <= 3) {
        alert("El apellido está vacio");


    } else if (!address || address.trim() == "" || address.trim().length <= 3) {
        alert("La dirección está vacia");


    } else if (!age || age.trim() == "" || age.trim().length <= 0 || age.trim().length >= 3) {
        alert("La edad está vacia o es invalida");


    } else if (!email || email.trim() == "" || email.trim().length <= 3) {
        alert("El correo electronico está vacio");


    } else
    if (!electrolitos || electrolitos.trim() == "" || electrolitos.trim().length <= 0) {
        alert("El resultado de electrolitos está vacio");


    } else if (!glucosa || glucosa.trim() == "" || glucosa.trim().length <= 0) {
        alert("El resultado de glucosa está vacio");


    } else if (!azucar || azucar.trim() == "" || azucar.trim().length <= 0) {
        alert("El resultado de azucar está vacio");


    } else if (!proteina || proteina.trim() == "" || proteina.trim().length <= 0) {
        alert("El resultado de las proteinas está vacio");


    } else {

        const xhr = new XMLHttpRequest();

        const userData = new FormData();

        userData.append('name', name);
        userData.append('lastname', lastname);
        userData.append('address', address);
        userData.append('age', age);
        userData.append('email', email);
        userData.append('electrolitos', electrolitos);
        userData.append('glucosa', glucosa);
        userData.append('azucar', azucar);
        userData.append('proteina', proteina);
        userData.append('action', 'registro');

        xhr.open('POST', './index-model.php', true);

        xhr.onload = function() {

            if (this.status === 200) {

                alert('Registro realizado correctamente, la información se envió al correo suministrado: ' + email);
                formuser.reset();

            } else {

                alert('Se ha producido un error');


            }

        }


        xhr.send(userData);

    }



}