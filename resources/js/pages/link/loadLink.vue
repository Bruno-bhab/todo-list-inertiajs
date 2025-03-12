<script setup lang="ts">
import LinkCard from '@/components/link/linkCard.vue';
import { Head } from '@inertiajs/vue3';

defineProps(['link'])
</script>

<template>
    <Head :title="link.title" />
    <div class="w-screen h-screen bg-zinc-800 flex justify-center items-center">
        <LinkCard :link="link"/>
    </div>
</template>
