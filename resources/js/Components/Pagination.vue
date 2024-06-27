<script setup>
import { Link } from '@inertiajs/vue3';


const props = defineProps({
    page: {
        type: Number,
        required: true
    },
    total: {
        type: Number,
        required: true
    },
    next:{
        type: [String, null],
    },
    prev:{
        type: [String, null],
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
                Página : {{ props.page }}
            </span>
            <span>
                Total : {{ props.total }}
            </span>
        </div>

        <!-- Botones -->
        <div class="text-2xl space-x-5">
            <!-- Anterior -->
            <Link
                class=""
                :href="props.prev ? props.prev : '' " >
                <i class="fa-solid fa-circle-arrow-left hover:scale-125 duration-300"></i>
            </Link>

            <!-- Siguiente -->
            <Link
                :href="props.next ? props.next : '' " >
                <i class="fa-solid fa-circle-arrow-right hover:scale-125 duration-300"></i>
            </Link>
        </div>
    </div>

</template>
