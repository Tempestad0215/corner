<script setup>
import { Head, useForm } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';
import { reactive, ref } from 'vue';
import axios from 'axios';



const categories = ref([])

// Para ver vetaana
const showCategory = ref(false);


// Formulario
const form = useForm({
    name:"",
    description:"",
    category_id:0,
    category_name:"",
    stock:"",
    price:"",
    cost:""
});

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
                action="">

                <!-- Titulo -->
                <h3 class=" text-2xl font-bold text-center">
                    Registro de productos
                </h3>

                <!-- Nombre -->
                <div>
                    <label
                        for="name"
                        class="label">
                        Nombre
                    </label>
                    <input
                        type="text"
                        class="input w-full">
                </div>

                <!-- Nombre -->
                <div>
                    <label
                        for="description"
                        class="label">
                        Descripción
                    </label>
                    <input
                        name="description"
                        type="text"
                        class="input w-full">
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
                            class="input w-full">

                        <!-- Contenido de las categorias -->
                        <div
                            v-if="showCategory"
                            class=" absolute w-full bg-gray-200 rounded-2xl mt-1">
                            <ol v-for="(item, index) in categories" :key="index">
                                <p class=" grid grid-cols-3 border-b-2 border-gray-500 rounded-2xl px-5 py-1">
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
        </div>
    </AppLayout>

 </template>
