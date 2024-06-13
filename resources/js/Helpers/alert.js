import Swal from "sweetalert2";

export const successHttp = (msj) => {
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Exito',
        text: msj,
        showConfirmButton: false,
        timer: 1500
      });
}

export const errorHttp = (msj) => {
    Swal.fire({
        position: 'center',
        title: 'Error',
        icon: 'error',
        text: msj
    });
}


