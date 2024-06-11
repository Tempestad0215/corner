<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';


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
            <form action="">
                <!-- Nombre  -->
                <div>
                    <label for="name">
                        Nombre
                    </label>
                    <input
                        id="name"
                        type="text">
                </div>

                <!-- Description  -->
                <div>
                    <label for="name">
                        Descripcion
                    </label>
                    <input
                        id="name"
                        type="text">
                </div>

            </form>


            <!-- Tabla del contenido de los datos -->
        </div>

    </AppLayout>

</template>
