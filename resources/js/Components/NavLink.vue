<script setup>
import { computed } from 'vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    href: String,
    active: Boolean,
});

</script>

<template>
    <Link :href="href">
    <slot />
    </Link>
</template>
