<script setup>
import { Head, Link, router, useForm, usePage } from "@inertiajs/vue3";
import AppLayout from "../../Layouts/AppLayout.vue";
import InputError from "@/Components/InputError.vue";
import { successHttp } from "@/Helpers/alert";
import Swal from "sweetalert2";
import Pagination from "@/Components/Pagination.vue";


const page = usePage();

const props = defineProps({
    categories:{
        type: Object,
        required: true
    }
})


// Datos del formulario
const form = useForm({
    code:"",
    name: "",
    description:"",
    update: false
});

// Formulario de busqueda
const formSearch = useForm({
    search:""
});


// Elimianr la categoria seleccionada
const destroy = (item) => {
    Swal.fire({
        title: "Esta seguro?",
        html: `<p>Desea eliminar la Categoria : <strong> ${item.name}</strong> , los cambios realizados son irreversible!</P>`,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancelar",
        confirmButtonText: "Si, eliminar!"
    }).then((result) => {
        if (result.isConfirmed) {

            router.patch(route('category.destroy', item.code),{},{
                onSuccess:()=>{
                    // Mensaje de exito
                    successHttp('Registro eliminado correctamente');
                },
                preserveScroll: true,
                preserveState: true
            });
        }
});
}



// Funcion para enviar
const submit = () => {

    if(form.update)
    {
        form.patch(route("category.update", form.code),{
            onSuccess:()=>{
                // Mensaje de exito
                successHttp("Registro actualizado correctamente");

                // Limpiar los datos
                form.reset();
            }
        })
    }else{

        // Enviar los datos
        form.post(route("category.store"),{
            onSuccess:()=>{
                // Mensaje de exito
                successHttp("Registro creado correctamente");
                // Limpiar los datos
                form.reset();

            }
        });
    }
}

// Edotar los datos
const edit = (item) => {
    form.code = item.code;
    form.name = item.name;
    form.description = item.description;
    form.update = true;
}


// Datos de busqueda
const search = () => {
    // Buscar los datos en la busqueda
    formSearch.get(route("category.index"),{
        preserveScroll: true,
        preserveState: true
    });
}

// Limpiar el formulario
const formClear = () => {
    // Limpiar los datos del formulario
    form.reset();
}





</script>


<template>
    <Head title="Categorias"/>
    <AppLayout>
        <!-- Cabecera de todo -->
        <template #header>
            <h2>
                Categrias
            </h2>
        </template>

        <!-- Contenido de la ventana -->
        <div>

            <!-- Formulario de los datos -->
            <form
                @submit.prevent="submit"
                class=" form"
                >

                <!-- Titulo del formulario -->
                <h3
                    class=" titulo">
                    Registro de Categoria
                </h3>


                <!-- Nombre  -->
                <div>
                    <label
                        class="block"
                        for="name">
                        Nombre
                    </label>
                    <input
                        v-model="form.name"
                        class="input w-full"
                        placeholder="Snack"
                        id="name"
                        type="text">
                    <!-- Error del nombre -->
                    <InputError :message="form.errors.name" />
                </div>

                <!-- Description  -->
                <div class="mt-3" >
                    <label
                        class=" block"
                        for="name">
                        Descripcion
                    </label>
                    <input
                        v-model="form.description"
                        class="input w-full"
                        id="name"
                        placeholder="Snack para picadera "
                        type="text">
                    <!-- Error de la decription -->
                    <InputError :message="form.errors.description" />
                </div>


                <!-- Botones para enviar los datos -->
                <div class=" pt-5 space-x-5 text-right">
                    <!-- Limpiar los datos -->
                    <button
                        @click="formClear"
                        class="btn-reset"
                        type="reset">
                        Limpiar
                    </button>
                    <!-- Registrar los datos -->
                    <button
                        class="btn-send"
                        type="submit">
                        Registrar
                    </button>
                </div>

            </form>

            <div class="my-7">
                <hr>
            </div>
            <!-- Tabla del contenido de los datos -->
            <div class="mt-5  bg-white mx-5 p-5 rounded-2xl shadow-2xl">
                <h3 class="titulo" >
                    Tabla de categoria
                </h3>

                <!-- Formulario para busqueda -->
                <form
                    @submit.prevent="search"
                    class=" lg:max-w-md" >
                    <div>
                        <label
                            class="block"
                            for="name">
                            Buscar
                        </label>
                        <div class=" relative flex items-center">
                            <input
                                class="input w-full pr-10"
                                placeholder="Busqueda"
                                type="text"
                                v-model="formSearch.search">
                            <!-- Boton para la busqueda -->
                            <i
                                @click="search"
                                class="fa-solid fa-magnifying-glass text-2xl absolute inset-y-0 right-0 py-1 px-3 "></i>
                        </div>
                    </div>
                </form>

                <!-- Tabla de los datos -->
                <table class=" table-auto w-full">
                    <!-- Cabecera de la ventana -->
                    <thead class=" text-left">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th
                                v-if="page.props.auth.user.role === '1'"
                                >Act
                            </th>
                        </tr>
                    </thead>

                    <!-- Contenido de la cabeza -->
                     <tbody>
                        <tr
                            class=" odd:bg-gray-300 rounded-2xl"
                            v-for="(item, index) in categories.data" >
                            <td class=" px-2">{{item.code}}</td>
                            <td class=" px-2">{{item.name}}</td>
                            <td class=" px-2 max-w-[300px] truncate">{{item.description}}</td>
                            <td
                                v-if="page.props.auth.user.role === '1'"
                                class=" px-2 space-x-5 text-xl" >
                                <!-- Editar -->
                                <i
                                    @click="edit(item)"
                                    class="fa-regular fa-pen-to-square hover:scale-125 duration-300"></i>
                                <!-- Eliminar -->
                                <i
                                    @click="destroy(item)"
                                    class="fa-solid fa-trash-can hover:scale-125 duration-300"></i>
                            </td>
                        </tr>
                     </tbody>
                </table>

                <!-- Linea divisora -->
                <hr>
                <Pagination
                    :page="categories.current_page"
                    :total="categories.to"
                    :prev="categories.prev_page_url"
                    :next="categories.next_page_url"
                    />
            </div>
        </div>

    </AppLayout>

</template>
