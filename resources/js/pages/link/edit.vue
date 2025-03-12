<template>
    <Head title="Link - Edit" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="grid grid-cols-3 h-full p-4">
            <div class="col-span-2">
                <LinkForm :link="linkInfo"/>
            </div>

            <div class="flex items-start justify-center grid-cols-subgrid bg-zinc-800 rounded-lg p-8">
                <LinkCard :link="linkInfo"/>
            </div>
        </div>

        <Button @click="handleSaveLink">Salvar</Button>
    </AppLayout>
</template>

<script setup lang="ts">
import LinkCard from '@/components/link/linkCard.vue';
import LinkForm from '@/components/link/linkForm.vue';
import Button from '@/components/ui/button/Button.vue';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { ILink } from '@/types/links';
import { Head } from '@inertiajs/vue3';
import { reactive } from 'vue';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Links/Edit',
        href: '/link',
    },
];

const props = defineProps<{ link: ILink }>()
const linkInfo = reactive(props.link);

const handleSaveLink = () => {
    console.log(linkInfo)
}
</script>
