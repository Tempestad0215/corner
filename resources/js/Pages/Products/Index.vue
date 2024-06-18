<script setup>
import { Head } from '@inertiajs/vue3';
import AppLayout from '../../Layouts/AppLayout.vue';


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

                <!-- Junto -->
                <div class=" grid grid-cols-3 gap-3">

                    <!-- Precio -->
                    <div>
                        <label
                            for="precio"
                            class="label">
                            Precio
                        </label>
                        <input
                            name="precio"
                            type="text"
                            class="input w-full">
                    </div>

                    <!-- Cantidad -->
                    <div>
                        <label
                            for="stock"
                            class="label">
                            Cantidad
                        </label>
                        <input
                            name="stock"
                            type="text"
                            class="input w-full">
                    </div>

                    <!-- Costo -->
                    <div>
                        <label
                            for="cost"
                            class="label">
                            Costo
                        </label>
                        <input
                            name="cost"
                            type="text"
                            class="input w-full">
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
