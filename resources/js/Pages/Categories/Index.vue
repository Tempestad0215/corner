<script setup>
import { Head, router, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import InputError from '@/Components/InputError.vue';


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



// Funcion para enviar
const submit = () => {

    // Enviar los datos
    form.post(route('category.store'),{
        onSuccess:()=>{
            // Limpiar los datos
            form.reset();

        }
    })
}

// Edotar los datos
const edit = (item) => {
    form.code = item.code;
    form.name = item.name;
    form.description = item.description;
    form.update = true;
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
            <div class="mt-5">
                <h3 class="titulo" >
                    Tabla de categoria
                </h3>

                <!-- Tabla de los datos -->
                <table class=" table-auto w-full">
                    <!-- Cabecera de la ventana -->
                    <thead class=" text-left">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Act</th>
                        </tr>
                    </thead>

                    <!-- Contenido de la cabeza -->
                     <tbody>
                        <tr
                            class=" odd:bg-gray-300"
                            v-for="(item, index) in categories.data" >
                            <td>{{item.code}}</td>
                            <td>{{item.name}}</td>
                            <td>{{item.description}}</td>
                            <td class=" space-x-5" >
                                <!-- Editar -->
                                <i
                                    @click="edit(item)"
                                    class="fa-regular fa-pen-to-square"></i>
                                <!-- Eliminar -->
                                <i
                                    @click="destroy(item.code)"
                                    class="fa-solid fa-trash-can"></i>
                            </td>
                        </tr>
                     </tbody>
                </table>
            </div>
        </div>

    </AppLayout>

</template>
