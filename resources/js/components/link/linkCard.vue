<script setup lang="ts">
import { computed } from 'vue';

interface ILinkItem {
    id: number;
    name: string;
    url: string;
    link_id: number;
    created_at: string;
    updated_at: string;
}

interface ILink {
    id: number;
    title: string;
    description: string;
    logo: string;
    color: string;
    text_color: string;
    link_name: string;
    user_id: number;
    created_at: string;
    updated_at: string;
    link_items: ILinkItem[];
}

const props = defineProps<{ link: ILink }>()

const linkBtnColor = computed(() => {
    const linkColor = props.link.color || '#fff'
    const linkColorText = props.link.text_color || '#000'
    console.log(linkColor, linkColorText)
    return `background-color: ${linkColor}; color: ${linkColorText}`
})

</script>

<template>
    <div class="w-96 bg-slate-500 rounded-md p-4 flex flex-col justify-center items-center drop-shadow-2xl">
        <img :src="link.logo" class="w-40 h-40 rounded-full shadow-xl">
        <div class="flex flex-col justify-center items-center text-center mt-4">
            <h3 class="font-bold text-xl mb-2">{{ link.title }}</h3>
            <p>{{ link.description }}</p>
        </div>
        <div class="flex flex-col justify-center items-center gap-2 mt-8 w-full">
            <a
                v-for="link in link.link_items"
                :key="link.id"
                :href="link.url"
                :style="linkBtnColor"
                class="p-4 rounded-md w-full text-center hover:opacity-70"
            >{{ link.name }}</a>
        </div>
    </div>
</template>
