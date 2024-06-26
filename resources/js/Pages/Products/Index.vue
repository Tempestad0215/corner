<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import { reactive, ref } from 'vue';
import axios from 'axios';
import Pagination from '@/Components/Pagination.vue';
import InputError from '@/Components/InputError.vue';
import { successHttp } from '@/Helpers/alert';
import Swal from 'sweetalert2';


// Propiedad de la ventana
const props = defineProps({
    products: {
        type: Object,
        required: true
    }
})

const categories = ref([])

// Para ver vetaana
const showCategory = ref(false);


// Formulario
const form = useForm({
    name: "",
    description: "",
    category_id: 0,
    category_name: "",
    stock: "",
    price: "",
    cost: ""
});

// Formulario de busqueda
const formSearch = useForm({
    search:""
})

const config = reactive({
    masked: false,

});



// Funciones

// conseguir la categoria
const getCategory = () => {

    // Para activar y descativar todo
    if(form.category_name.length < 1)
    {
        showCategory.value = false;
    }else{
        // PAra activar la ventana
        showCategory.value = true;

        // Hacer la peticion para buscar la categorias
        axios.get(`/category/get?search=${form.category_name}`)
            .then((res) =>{

                categories.value = res.data;
            });
    }
}

// seleccionar la categoria
const selectCategory = (item) => {
    form.category_name = item.name;
    form.category_id = item.id;

    // Cerrar la ventana
    showCategory.value = false;
}

// enviar los datos del formulario
const submit = () => {
    form.post(route('product.store'),{
        onSuccess:()=>{
            successHttp('Datos registrados correctamente');
        }
    })
}

// Para la busqueda
const search = () => {
    // Hacer la busqueda
    formSearch.get(route('product.index'),{
        preserveScroll: true,
        preserveState: true
    });
}

// Editar las ordenes
const edit = (item) => {
    Swal.fire({
        title: `Desea editar el producto : ${item.name} ?`,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Si, editar!",
        cancelButtonText: "Cancelar"
        }).then((result) => {
        if (result.isConfirmed) {

            // Pasar los datos
            form.name = item.name;
            form.description = item.description;
            form.category_id = item.category.id;
            form.category_name = item.category.name;
            form.price = item.price;
            form.quantity = item.stock;
            form.cost = item.cost

        }
    });
}


</script>

<!-- Contenido de la ventana -->
 <template>
    <Head title="Productos"/>
    <AppLayout>
        <!-- Cabecera de todo -->
        <template #header>
            <h2>
                Productos
            </h2>
        </template>

        <!-- Contenido de la ventana -->
        <div>
            <form
                class="form"
                @submit.prevent="submit" >

                <!-- Titulo -->
                <h3 class=" text-2xl font-bold text-center">
                    Registro de Productos
                </h3>

                <!-- Nombre -->
                <div>
                    <label
                        for="name"
                        class="label">
                        Nombre
                    </label>
                    <input
                        v-model="form.name"
                        type="text"
                        placeholder="Nombre"
                        class="input w-full">

                    <!-- Error -->
                    <InputError :message="form.errors.name"/>
                </div>

                <!-- Nombre -->
                <div>
                    <label
                        for="description"
                        class="label">
                        Descripción
                    </label>
                    <input
                        v-model="form.description"
                        name="description"
                        type="text"
                        placeholder="Detalle del producto"
                        class="input w-full">

                    <!-- Error -->
                    <InputError :message="form.errors.description"/>

                </div>





                <!-- Categoria de producto -->
                <div>
                    <label
                        for="category"
                        class="label">
                        Categoria
                    </label>
                    <div class="relative" >
                        <input
                            @click=" showCategory = !showCategory"
                            @input="getCategory()"
                            v-model="form.category_name"
                            type="text"
                            placeholder="-- Busque y seleccione la categoria --"
                            class="input w-full">

                        <!-- Contenido de las categorias -->
                        <div
                            v-if="showCategory"
                            class=" absolute w-full bg-gray-200 rounded-2xl mt-1">
                            <ol v-for="(item, index) in categories" :key="index">
                                <p
                                    @click="selectCategory(item)"
                                    class=" grid grid-cols-3 border-b-2 border-gray-500 rounded-2xl px-5 py-1">
                                    <span>
                                        {{ item.code }}
                                    </span>
                                    <span>
                                        {{ item.name }}
                                    </span>
                                    <span class=" max-w-[200px] truncate">
                                        {{ item.description }}
                                    </span>
                                </p>
                            </ol>
                        </div>

                        <!-- Error -->
                        <InputError :message="form.errors.category_id"/>
                    </div>
                </div>

                <!-- Junto -->
                <div class=" grid grid-cols-3 gap-3">

                    <!-- Precio -->
                    <div>
                        <label
                            for="precio"
                            class="label">
                            Precio
                        </label>
                        <money3
                            class="input w-full"
                            v-model="form.price "
                            v-bind="config">
                        </money3>

                        <!-- Error -->
                        <InputError :message="form.errors.price"/>
                    </div>

                    <!-- Cantidad -->
                    <div>
                        <label
                            for="stock"
                            class="label">
                            Cantidad
                        </label>
                        <money3
                            class="input w-full"
                            v-model="form.stock "
                            v-bind="config">
                        </money3>

                        <!-- Error -->
                        <InputError :message="form.errors.stock"/>
                    </div>

                    <!-- Costo -->
                    <div>
                        <label
                            for="cost"
                            class="label">
                            Costo
                        </label>
                        <money3
                            class="input w-full"
                            v-model="form.cost  "
                            v-bind="config">
                        </money3>

                        <!-- Error -->
                        <InputError :message="form.errors.cost"/>
                    </div>
                </div>

                <!-- Botones -->
                <div class="mt-5 space-x-5 text-right">
                    <!-- Limpiar los datos -->
                    <button
                        class="btn-reset"
                        type="reset">
                        Limpiar
                    </button>

                    <!-- Enviar los datos -->
                     <button
                        class="btn-send"
                        type="submit">
                        Registrar
                    </button>
                </div>

            </form>


            <!-- Datos de la tabla -->
            <div class="my-7">
                <hr>
            </div>
            <!-- Tabla del contenido de los datos -->
            <div class="mt-5  bg-white mx-5 p-5 rounded-2xl shadow-2xl">
                <h3 class="titulo" >
                    Tabla de Productos
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
                        <!-- Error -->
                        <InputError :message="formSearch.errors.search"/>
                    </div>
                </form>

                <!-- Tabla de los datos -->
                <table class=" table-auto w-full">
                    <!-- Cabecera de la ventana -->
                    <thead class=" text-left">
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Categoria</th>
                            <th>Disponible</th>
                            <th>Act</th>
                        </tr>
                    </thead>

                    <!-- Contenido de la cabeza -->
                     <tbody>
                        <tr
                            class=" odd:bg-gray-300 rounded-2xl"
                            v-for="(item, index) in products.data" >
                            <td class=" px-2">{{item.code}}</td>
                            <td class=" px-2">{{item.name}}</td>
                            <td class=" px-2">{{item.category.name}}</td>
                            <td class=" px-2">{{(item.stock).toFixed(2)}}</td>
                            <td class=" px-2 space-x-5 text-xl" >
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
                <Pagination :data="categories" />
            </div>
        </div>
    </AppLayout>

 </template>
