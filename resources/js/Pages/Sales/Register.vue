<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue'


</script>


<template>
    <Head title="Ventas"/>

    <AppLayout>

        <!-- Cabecera de la ventana -->
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Ventas
            </h2>
        </template>

        <div>
            <form
                action=""
                method="post">

                <!-- Seleccionar los productos a vender -->
                <div>
                    <label for="">
                        Productos
                    </label>

                    <!-- Para elegir los productos -->
                    <div class=" max-w-xs">
                        <input
                            class=" w-full rounded-2xl"
                            type="text"
                            name="product"
                            id="product">

                        <!-- Contenido de los productos -->
                        <div class=" pt-3" >
                            <ol
                                v-for="(item, index) in 10"
                                class=" odd:bg-gray-300 rounded-2xl max-w-full">
                                <li class=" hover:bg-gray-600 hover:text-white duration-300 rounded-2xl text-center"
                                    >{{index+1}} | ceveza | $13{{index+1}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </form>
        </div>

    </AppLayout>

</template>
