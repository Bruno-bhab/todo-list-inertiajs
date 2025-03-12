<template>
    <Head title="Link - Edit" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid grid-cols-3 h-full p-4">
            <div class="col-span-2">
                <LinkForm :link="link"/>
            </div>

            <div class="flex items-start justify-center grid-cols-subgrid bg-zinc-800 rounded-lg p-8">
                <LinkCard :link="link"/>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import LinkCard from '@/components/link/linkCard.vue';
import LinkForm from '@/components/link/linkForm.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ILink } from '@/types/links';
import { Head } from '@inertiajs/vue3';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Links/Edit',
        href: '/link',
    },
];

defineProps<{ link: ILink }>()

</script>
