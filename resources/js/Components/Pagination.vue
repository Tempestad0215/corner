<script setup>
import { Link } from '@inertiajs/vue3';


const props = defineProps({
    data: {
        type: Object,
        required: true
    }
})

</script>


<!-- Contenido -->
<template>
    <!-- Paginacion e informacion de la tabla -->
    <div class="mt-5  flex justify-between" >
        <!-- Informacion -->
        <div>
            <span>
                Página : {{ props.data.current_page }}
            </span>
            <span>
                Total : {{ props.data.to }}
            </span>
        </div>

        <!-- Botones -->
        <div class="text-2xl space-x-5">
            <!-- Anterior -->
            <Link
                class=""
                :href="props.data.prev_page_ur ? props.data.prev_page_ur : '' " >
                <i class="fa-solid fa-circle-arrow-left hover:scale-125 duration-300"></i>
            </Link>

            <!-- Siguiente -->
            <Link
                :href="props.data.next_page_url ? props.data.next_page_url : '' " >
                <i class="fa-solid fa-circle-arrow-right hover:scale-125 duration-300"></i>
            </Link>
        </div>
    </div>

</template>
